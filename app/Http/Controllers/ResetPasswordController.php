<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;



class ResetPasswordController extends Controller
{
    public function showResetForm($token, $email)
    {
        // Verifique se o token e o e-mail são válidos
        $user = User::where('email', $email)->where('remember_token', $token)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Link de redefinição de senha inválido.');
        }

        return view('page.reset-form', [
            'token' => $token,
            'email' => $email
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);


        $user = User::where('email', $request->email)->where('remember_token', $request->token)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'O token de redefinição de senha é inválido ou o e-mail não corresponde ao usuário.');
        }

        // Atualize a senha do usuário
        $user->password = bcrypt($request->password);
        $user->remember_token = null; // Remova o token de redefinição de senha
        $user->save();

        return redirect()->route('login')->with('success', 'Sua senha foi redefinida com sucesso. Faça o login com sua nova senha.');
    }
}
