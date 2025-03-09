<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:15'],
            'birth_date' => ['required', 'date'],
            'cpf' => ['required', 'string', 'max:14', 'unique:'.User::class],
            'balance' => ['required', 'numeric'],
            'photo' => ['nullable', 'image', 'max:1024'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'telephone' => $request->telephone,
            'birth_date' => $request->birth_date,
            'cpf' => $request->cpf,
            'balance' => $request->balance,
            'photo' => $request->file('photo') ? $request->file('photo')->store('photos', 'public') : null,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard', [], false);
    }
}
