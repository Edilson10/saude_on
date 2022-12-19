<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkSession
{
    public function handle(Request $request, Closure $next)
    {
        //verificar se usuario esta logado
        if (!session()->has('usuario')) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
