<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SacarController extends Controller
{
    public function sacar(Request $request)
    {
        // Validate the request
        $request->validate([
            'amount' => 'required|numeric|min:0|max:' . Auth::user()->balance,
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Deduct the amount from the user's balance
        $user->balance -= $request->amount;

        // Save the updated balance to the database
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Saque realizado com sucesso!');
    }
}