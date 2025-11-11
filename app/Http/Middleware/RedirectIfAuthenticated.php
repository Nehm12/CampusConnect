<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Récupérer le rôle de l'utilisateur connecté
                $role = Auth::user()->role;
                
                // Rediriger vers le dashboard approprié selon le rôle
                return match($role) {
                    'admin' => redirect()->route('admin.dashboard'),
                    'enseignant' => redirect()->route('enseignant.dashboard'),
                    'etudiant' => redirect()->route('etudiant.dashboard'),
                    default => redirect()->route('dashboard'),
                };
            }
        }

        return $next($request);
    }
}