<h2>Redefinição de Senha</h2>
<p>Olá {{ $user->name }},</p>
<p>Clique no link abaixo para redefinir sua senha:</p>
<p>
    <a href="{{ route('reset.password', ['token' => $token, 'email' => $user->email]) }}">Redefinir Senha</a>
</p>
