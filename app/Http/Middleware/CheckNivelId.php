<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckNivelId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $nivelId)
    {
        $user = $request->user();

        // Verificar se o usuário está autenticado e possui nivel_id igual ao parâmetro fornecido
        if ($user && $user->nivel_id >= $nivelId) {
            return $next($request);
        }

        abort(403, 'Acesso não autorizado.');
    }
}
