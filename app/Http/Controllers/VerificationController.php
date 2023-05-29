<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;




class VerificationController extends Controller
{
    public function enviarEmailVerificacao(Request $request)
    {
        $user = Auth::user();

        // Verifica se o usuário já está com o email verificado
        if ($user->email_verified_at) {
            return redirect()->back()->with('message', 'Seu email já está verificado.');
        }

        // Gera um novo token de verificação de email
        $token = $user->generateEmailVerificationToken();

        // Envia o email de verificação
        Mail::to($user->email)->send(new EmailVerification($user, $token));

        return redirect()->back()->with('message', 'Um email de verificação foi enviado para o seu endereço de email. Por favor, verifique sua caixa de entrada.');
    }

    public function verify(Request $request, $id, $token)
    {
        $user = User::findOrFail($id);

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('profile.edit')->with('message', 'Seu e-mail já foi confirmado.');
        }

        if ($user->email_verification_token !== $token) {
            return redirect()->route('profile.edit')->with('error', 'O link de confirmação é inválido.');
        }

        if ($user->markEmailAsVerified()) {
            // Atribuir 10.000 créditos ao usuário confirmado
            $user->credits += 10000;
            $user->save();

            return redirect()->route('profile.edit')->with('message', 'Seu e-mail foi confirmado. Parabéns, você ganhou 10.000 créditos!');
        }

        return redirect()->route('profile.edit')->with('error', 'Não foi possível confirmar seu e-mail.');
    }
}
