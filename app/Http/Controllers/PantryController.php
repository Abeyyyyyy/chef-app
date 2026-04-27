<?php

namespace App\Http\Controllers;

use App\Models\Pantry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PantryController extends Controller
{
    /**
     * Display the pantry items.
     */
    public function index(Request $request): View
    {
        $query = Pantry::where('user_id', Auth::id());

        if ($request->has('category') && $request->category !== 'Semua') {
            $query->where('category', $request->category);
        }

        $pantryItems = $query->get();

        return view('pantry', compact('pantryItems'));
    }

    /**
     * Store a new pantry item.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string',
        ]);

        Pantry::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'category' => $validated['category'],
            'quantity' => $validated['quantity'],
            'unit' => $validated['unit'],
            'status' => $validated['quantity'] <= 5 ? 'Menipis' : 'Aman', // Example logic
        ]);

        return back()->with('success', 'Ingredient added to pantry!');
    }
}
