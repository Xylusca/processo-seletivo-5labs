<h2>Verificação de Email</h2>
<p>Olá {{ $user->name }},</p>
<p>Clique no link abaixo para verificar seu endereço de email:</p>
<p>
  <a href="{{ route('email.verify', ['id' => $user->id, 'hash' => $token]) }}">Verificar Email</a>
</p>
