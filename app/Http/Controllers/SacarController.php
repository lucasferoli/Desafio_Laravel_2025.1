<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SacarController extends Controller
{
    public function sacar(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0|max:' . Auth::user()->balance,
        ]);

        $user = Auth::user();
        $user->balance -= $request->amount;
        $user->save();

        return redirect()->back()->with('success', 'Saque realizado com sucesso!');
    }
}
