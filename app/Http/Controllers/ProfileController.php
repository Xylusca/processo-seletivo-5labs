<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function edit()
    {
        // Recupere os dados do perfil do usuário logado
        $user = Auth::user();

        return view('page.perfil', compact('user'));
    }
    public function update(Request $request)
    {
        $customMessages = [
            'required' => 'O campo :attribute é obrigatório.',
            'unique' => 'O :attribute já está em uso.',
            'in' => 'O :attribute selecionado é inválido.',
            'new_password.required_if' => 'Digite sua nova senha.',
            'new_password.min' => 'A nova senha deve ter no mínimo :min caracteres.',
            'new_password.confirmed' => 'A confirmação da nova senha não coincide.',
        ];

        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'name' => 'required',
            'birthdate' => 'required',
            'state' => 'required',
            'city' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'new_password' => 'nullable|min:8',
        ], $customMessages);

        // Obtenha o usuário autenticado
        $user = Auth::user();

        // Verifique se o usuário existe
        if (!$user) {
            return redirect()->route('profile.edit')->with('error', 'Usuário não encontrado.');
        }

        // Atualize os dados do perfil do usuário logado
        $user->name = $validatedData['name'];
        $user->birthdate = $validatedData['birthdate'];
        $user->state = $validatedData['state'];
        $user->city = $validatedData['city'];
        $user->email = $validatedData['email'];

        // Atualize a senha, se fornecida
        if ($request->filled('new_password')) {
            $user->password = bcrypt($validatedData['new_password']);
        }

        // Salve as alterações no perfil do usuário
        $user->save();

        // Redirecione de volta à página de perfil com uma mensagem de sucesso
        return redirect()->route('profile.edit')->with('success', 'Perfil atualizado com sucesso.');
    }
}
