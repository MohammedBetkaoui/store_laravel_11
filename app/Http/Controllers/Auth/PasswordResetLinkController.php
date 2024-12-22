<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable\Address;
use Illuminate\Mail\Mailable\Envelope;
use App\Mail\forgetPassword;
use Illuminate\View\View;
use App\Models\User;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Envoi du lien de réinitialisation
        $status = Password::sendResetLink(
            $request->only('email')

        );
                     $check = User::where('email', $request->email)->first();
        if ($status === Password::RESET_LINK_SENT) {
            
             Mail::to($check->email)->send(new forgetPassword(route('password.reset', ['token' => $check->id])));
        }

        return response()->json(['message' => __($status)], 400);
    }
}
