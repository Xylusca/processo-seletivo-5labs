<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;



class UserController extends Controller
{
    public function login()
    {
        return view('page/loginForm');
    }
    public function loginForm()
    {
        return view('page/loginForm');
    }
    public function register(Request $request)
    {
        $customMessages = [
            'required' => 'O campo :attribute é obrigatório.',
            'unique' => 'O :attribute já está em uso.',
            'in' => 'O :attribute selecionado é inválido.',

        ];

        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'name' => 'required',
            'cpf' => 'required|unique:users',
            'birthdate' => 'required',
            'state' => 'required',
            'city' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'users' => 'required|in:1,2',
        ],$customMessages);

        $birthdate = Carbon::createFromFormat('d/m/Y', $validatedData['birthdate'])->format('Y-m-d');

        // Criação do usuário
        $user = new User;
        $user->name = $validatedData['name'];
        $user->cpf = $validatedData['cpf'];
        $user->birthdate = $birthdate;
        $user->state = $validatedData['state'];
        $user->city = $validatedData['city'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->nivel_id = $validatedData['users'];

        $user->save();

        return redirect()->back()->with('success', 'Usuário cadastrado com sucesso!');
    }
}
