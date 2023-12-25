<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::user()) {
            return redirect()->route('login');
        } 
        if($request->user()->isAdmin()) {
            return $next($request);
        }
        return abort(403, 'Acesso proibido: Você não tem permissão para acessar esse recurso.');
    }
}
