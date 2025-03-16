<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Try sending the reset link for the 'users' broker
        $status = Password::broker('users')->sendResetLink($request->only('email'));

        // If the reset link was sent successfully for 'users', return with success message
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        // If the 'users' broker failed, try sending the reset link for the 'admins' broker
        $status = Password::broker('admins')->sendResetLink($request->only('email'));

        // If the reset link was sent successfully for 'admins', return with success message
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        // If both brokers failed, return with an error message
        return back()->withInput($request->only('email'))
                    ->withErrors(['email' => __($status)]);
    }
}