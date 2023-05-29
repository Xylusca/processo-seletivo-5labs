<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function resetPassword()
    {
        return view('page/reset');
    }
    public function sendResetLinkEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'O e-mail fornecido não corresponde a nenhum usuário.');
        }

        $token = Str::random(64);
        $user->remember_token = $token;
        $user->save();

        // Envie o e-mail para o usuário com o link de redefinição de senha
        Mail::to($user->email)->send(new EmailVerification($user, $token, true));

        return redirect()->back()->with('success', 'Um link de redefinição de senha foi enviado para o seu e-mail.');
    }
}
