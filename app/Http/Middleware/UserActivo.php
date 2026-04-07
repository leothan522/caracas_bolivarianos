<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserActivo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()){
            if (!Auth::user()->activo && !Auth::user()->is_root){
                Auth::logout();
                session()->flush();
                sweetAlert2([
                    'icon' => 'warning',
                    'text' => 'Usuario Inactivo',
                    'timer' => null,
                    'showCloseButton' => true
                ]);
                return redirect()->route('web.index');
            }
        }
        return $next($request);
    }
}
