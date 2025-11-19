<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Affiche la page d'inscription.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Traite la requête d'inscription.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation des champs
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'telephone' => ['nullable', 'string', 'max:20'],
            'role' => ['required', 'in:student,teacher'], // on évite d’attribuer "admin" ici
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Création du nouvel utilisateur
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        //  Événement d’inscription
        event(new Registered($user));

        // Connexion automatique après inscription
        Auth::login($user);

        // Redirection selon le rôle
        return redirect($this->redirectToByRole($user));
    }

    /**
     * Redirection selon le rôle de l’utilisateur.
     */
    protected function redirectToByRole(User $user): string
    {
        return match ($user->role) {
            'admin' => route('admin.dashboard'),
            'teacher' => route('teacher.dashboard'),
            'student' => route('student.dashboard'),
            default => route('dashboard'),
        };
    }
}
