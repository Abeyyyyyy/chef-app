<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatSession;
use App\Models\Pantry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ChatController extends Controller
{
    /**
     * Show the chat page (optionally loading an existing session).
     */
    public function index(Request $request): View
    {
        $sessionId = $request->query('session');
        $session = null;
        $messages = [];

        if ($sessionId) {
            $session = ChatSession::where('id', $sessionId)
                ->where('user_id', Auth::id())
                ->first();

            if ($session) {
                $messages = $session->messages()->orderBy('created_at')->get();
            }
        }

        return view('chat', [
            'existingSession' => $session,
            'existingMessages' => $messages,
        ]);
    }

    /**
     * Get pantry items for the current user (AJAX).
     */
    public function pantryItems(): JsonResponse
    {
        $items = Pantry::where('user_id', Auth::id())
            ->orderBy('category')
            ->orderBy('name')
            ->get(['id', 'name', 'category', 'quantity', 'unit', 'status']);

        return response()->json($items);
    }

    /**
     * Create a new chat session.
     */
    public function createSession(Request $request): JsonResponse
    {
        $pantryContext = $request->input('pantry_context', null);

        $session = ChatSession::create([
            'id' => Str::uuid()->toString(),
            'user_id' => Auth::id(),
            'title' => 'Sesi Baru',
            'pantry_context' => $pantryContext,
            'last_active_at' => now(),
        ]);

        return response()->json([
            'id' => $session->id,
            'title' => $session->title,
        ]);
    }

    /**
     * Send a message and get AI response.
     */
    public function sendMessage(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'session_id' => 'required|uuid',
            'message' => 'required|string|max:2000',
            'pantry_items' => 'nullable|array',
        ]);

        // Verify session belongs to user
        $session = ChatSession::where('id', $validated['session_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Save user message
        ChatMessage::create([
            'session_id' => $session->id,
            'sender_role' => 'user',
            'content' => $validated['message'],
        ]);

        // Build AI prompt with pantry context
        $pantryContext = '';
        if (!empty($validated['pantry_items'])) {
            $pantryList = collect($validated['pantry_items'])
                ->map(fn($item) => "{$item['name']} ({$item['quantity']} {$item['unit']})")
                ->join(', ');
            $pantryContext = "\n\nBahan yang tersedia di dapur user saat ini: {$pantryList}.";
        } elseif ($session->pantry_context) {
            $pantryContext = "\n\nBahan yang tersedia di dapur user: {$session->pantry_context}";
        }

        // Load conversation history for context (last 10 messages)
        $history = $session->messages()
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get()
            ->reverse()
            ->map(fn($msg) => [
                'role' => $msg->sender_role === 'assistant' ? 'assistant' : 'user',
                'content' => $msg->content,
            ])
            ->values()
            ->toArray();

        $systemPrompt = "Kamu adalah Chef AI profesional bernama 'Chef Atelier'. Kamu adalah ahli kuliner yang sangat berdedikasi. "
            . "TUGAS UTAMA: Kamu HANYA boleh menjawab pertanyaan yang berkaitan dengan dunia memasak, resep, teknik kuliner, bahan makanan, nutrisi, dan tips dapur. "
            . "PENOLAKAN TOPIK: Jika user bertanya tentang hal di luar dunia kuliner (seperti politik, teknologi non-dapur, sejarah umum, matematika non-resep, atau topik lainnya), kamu WAJIB menolak dengan sangat sopan. "
            . "Contoh penolakan: 'Maaf Chef, sebagai asisten dapur Anda, saya hanya dibekali keahlian untuk membantu hal-hal seputar masak-memasak. Mari kita kembali fokus membuat hidangan yang lezat!' "
            . "FORMAT JAWABAN: "
            . "1. Jika user memberikan bahan atau meminta resep, berikan resep mewah dalam format JSON valid (TANPA teks tambahan). "
            . "2. Jika user bertanya seputar tips masak, jawab dengan teks rapi dalam Bahasa Indonesia. "
            . "Format JSON Resep: {"
            . "\"description\": \"Penjelasan singkat menggugah selera\", "
            . "\"title\": \"Nama Hidangan Mewah\", "
            . "\"waktu\": \"Durasi\", \"porsi\": \"Jumlah\", \"level\": \"Tingkat\", "
            . "\"ingredients\": [\"bahan dengan takaran\"], \"steps\": [\"langkah detail\"], "
            . "\"image_keyword\": \"kata kunci gambar Unsplash\""
            . "} "
            . $pantryContext;

        $messages = array_merge(
            [['role' => 'system', 'content' => $systemPrompt]],
            $history
        );

        try {
            $apiKey = env('OPENROUTER_API_KEY');
            $model = env('OPENROUTER_MODEL', 'google/gemini-2.0-flash-lite-preview-02-05:free');

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => config('app.url', 'http://localhost'),
                'X-Title' => config('app.name', 'Chef Simulator'),
            ])->timeout(120) // Dinaikkan ke 120 detik
              ->connectTimeout(30) // Batas waktu koneksi awal
              ->post("https://openrouter.ai/api/v1/chat/completions", [
                'model' => $model,
                'messages' => $messages,
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $rawText = $result['choices'][0]['message']['content'] ?? '';

                // Try to parse recipe JSON from response
                $recipeData = null;
                $firstBracket = strpos($rawText, '{');
                $lastBracket = strrpos($rawText, '}');

                if ($firstBracket !== false && $lastBracket !== false) {
                    $jsonString = substr($rawText, $firstBracket, ($lastBracket - $firstBracket) + 1);
                    $parsed = json_decode($jsonString, true);
                    if (json_last_error() === JSON_ERROR_NONE && isset($parsed['title']) && isset($parsed['steps'])) {
                        $recipeData = $parsed;
                    }
                }

                // Save AI response
                $aiMessage = ChatMessage::create([
                    'session_id' => $session->id,
                    'sender_role' => 'assistant',
                    'content' => $rawText,
                    'recipe_data' => $recipeData,
                ]);

                // Auto-generate title from first user message if still default
                if ($session->title === 'Sesi Baru') {
                    $firstMsg = $validated['message'];
                    $title = Str::limit($firstMsg, 50);
                    $session->update(['title' => $title]);
                }

                $session->update(['last_active_at' => now()]);

                return response()->json([
                    'content' => $rawText,
                    'recipe_data' => $recipeData,
                    'session_title' => $session->fresh()->title,
                ]);
            }

            return response()->json(['error' => 'AI Service Error: ' . $response->status()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Toggle bookmark on a session.
     */
    public function toggleBookmark(string $sessionId): JsonResponse
    {
        $session = ChatSession::where('id', $sessionId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $session->update(['is_bookmarked' => !$session->is_bookmarked]);

        return response()->json([
            'is_bookmarked' => $session->fresh()->is_bookmarked,
        ]);
    }

    /**
     * Delete a chat session.
     */
    public function deleteSession(string $sessionId): JsonResponse
    {
        $session = ChatSession::where('id', $sessionId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $session->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Get chat history for the History page.
     */
    public function history(): View
    {
        $sessions = ChatSession::where('user_id', Auth::id())
            ->with('latestMessage')
            ->orderBy('last_active_at', 'desc')
            ->get();

        // Group by date
        $grouped = $sessions->groupBy(function ($session) {
            $date = $session->last_active_at;
            if ($date->isToday()) return 'Hari Ini';
            if ($date->isYesterday()) return 'Kemarin';
            if ($date->isCurrentWeek()) return 'Minggu Ini';
            return $date->translatedFormat('d F Y');
        });

        return view('history', compact('grouped'));
    }

    /**
     * Get bookmarked sessions for the Bookmarks page.
     */
    public function bookmarks(): View
    {
        $bookmarkedSessions = ChatSession::where('user_id', Auth::id())
            ->where('is_bookmarked', true)
            ->with('latestMessage')
            ->withCount('messages')
            ->orderBy('last_active_at', 'desc')
            ->get();

        return view('bookmarks', compact('bookmarkedSessions'));
    }
}
