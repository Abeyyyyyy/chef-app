<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecipeController extends Controller
{
    public function generate(Request $request)
    {
        $apiKey = env('OPENROUTER_API_KEY');
        $model = env('OPENROUTER_MODEL');
        $ingredients = $request->ingredients;

        $prompt = "Kamu adalah Chef profesional. Berikan 1 resep mewah dari bahan: $ingredients. 
        WAJIB berikan hasil HANYA dalam format JSON murni tanpa kata-kata lain. 
        Struktur JSON: 
        {
          \"title\": \"nama masakan\",
          \"waktu\": \"durasi\",
          \"porsi\": \"jumlah orang\",
          \"level\": \"tingkat kesulitan\",
          \"ingredients\": [\"item 1\", \"item 2\"],
          \"steps\": [\"langkah 1\", \"langkah 2\"]
        }";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => config('app.url'), // Opsional: Tambahan untuk OpenRouter
            ])->post("https://openrouter.ai/api/v1/chat/completions", [
                'model' => $model,
                'messages' => [
                    ['role' => 'user', 'content' => $prompt]
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $rawText = $result['choices'][0]['message']['content'] ?? '';
                
                // 1. Ekstraksi String di antara kurung kurawal pertama dan terakhir
                $firstBracket = strpos($rawText, '{');
                $lastBracket = strrpos($rawText, '}');
                
                if ($firstBracket !== false && $lastBracket !== false) {
                    $jsonString = substr($rawText, $firstBracket, ($lastBracket - $firstBracket) + 1);
                    
                    // 2. Decode JSON yang sudah diekstrak
                    $data = json_decode($jsonString, true);
                    
                    if (json_last_error() === JSON_ERROR_NONE) {
                        return response()->json($data);
                    }
                }
                
                // Jika proses ekstraksi atau decoding gagal
                return response()->json([
                    'error' => 'Format JSON bermasalah',
                    'raw_output' => $rawText // Membantu debugging jika perlu
                ], 500);
            }

            return response()->json(['error' => 'OpenRouter Error: ' . $response->status()], 500);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}