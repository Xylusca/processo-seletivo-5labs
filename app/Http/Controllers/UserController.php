<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Nivel;
use App\Models\User;
use Carbon\Carbon;




class UserController extends Controller
{
    public function login()
    {
        return view('page/login');
    }
    public function logar(Request $request)
    {
        $customMessages = [
            'required' => 'O campo :attribute é obrigatório.',
        ];
        // Valide a solicitação de login
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], $customMessages);

        // Attempt autenticar o usuário
        if (Auth::attempt($validatedData)) {
            // success
            return redirect()->route('home');
        } else {
            // Error
            return redirect()->back()->with('error', 'E-mail ou senha inválidos.');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        // Limpa a sessão atual do usuário
        $request->session()->invalidate();

        // Regenera o token de sessão
        $request->session()->regenerateToken();

        return redirect()->route('login');
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
        ], $customMessages);

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
        $user->status = 'pendente';
        $user->nivel_id = $validatedData['users'];

        $user->save();

        return redirect()->back()->with('success', 'Usuário cadastrado com sucesso!');
    }
    public function consulta(Request $request)
    {
        $status = $request->query('status', '');
        $order = $request->query('order', '');
        $tipo = $request->query('tipo', '');
        $searchQuery = $request->input('q');

        // Consulta os usuários com base nos filtros
        $users = User::query();

        if ($status) {
            $users->where('status', $status);
        }

        if ($tipo) {
            $users->where('nivel_id', $tipo);
        }

        if ($searchQuery) {
            $users->where('name', 'LIKE', "%{$searchQuery}%");
        }

        if ($order === 'maior-credito') {
            $users->orderBy('credits', 'desc');
        } elseif ($order === 'menor-credito') {
            $users->orderBy('credits', 'asc');
        }


        // Execute a consulta final
        $users = $users->get();

        // Obtenha os nomes dos níveis disponíveis
        $nivelNames = Nivel::pluck('name', 'id')->toArray();

        // Retorne os usuários encontrados para a view ou execute outras ações
        return view('page.usuarios', compact('users', 'status', 'order', 'tipo', 'nivelNames'));
    }
    public function atualizarStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = $request->input('status');
        $user->save();

        return redirect()->back()->with('success', 'Status atualizado com sucesso.');
    }
}
