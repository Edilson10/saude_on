<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkSessionAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //verificar se usuario esta logado
        if (!session()->has('clinica')) {
            return redirect()->route('admin_login');
        }
        return $next($request);
    }
}
