<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Les rôles dans la base de données sont: 'admin', 'teacher', 'student'
        // Pas besoin de mapping, on utilise directement les rôles
        
        // Vérifier si l'utilisateur a le bon rôle
        if ($user->role !== $role) {
            // Rediriger vers son propre dashboard selon son rôle
            $userRole = $user->role;
            
            $dashboardRoutes = [
                'admin' => 'admin.dashboard',
                'teacher' => 'enseignant.dashboard',
                'student' => 'etudiant.dashboard'
            ];
            
            if (isset($dashboardRoutes[$userRole])) {
                return redirect()->route($dashboardRoutes[$userRole])
                    ->with('error', 'Vous n\'avez pas accès à cette section.');
            }
            
            abort(403, 'Accès non autorisé. Vous n\'avez pas les permissions nécessaires.');
        }

        return $next($request);
    }
}