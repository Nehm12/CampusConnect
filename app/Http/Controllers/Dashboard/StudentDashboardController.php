<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Room;
use App\Models\Material;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;

class StudentDashboardController extends Controller
{
    public function index()
    {
        // Statistiques pour l'étudiant
        $stats = [
            'recent_announcements' => Announcement::where('created_at', '>=', now()->subDays(7))->count(),
            'available_rooms' => Room::count(),
            'available_materials' => Material::count(),
            'my_reservations' => Reservation::where('user_id', Auth::id())->count(),
        ];

        // Dernières annonces (3 plus récentes)
        $announcements = Announcement::with('user')
            ->latest()
            ->take(3)
            ->get();

        // Salles (5 plus récentes)
        $rooms = Room::latest()
            ->take(5)
            ->get();

        // Matériels (5 plus récents)
        $materials = Material::latest()
            ->take(5)
            ->get();

        return view('dashboard.etudiant.index', compact(
            'stats',
            'announcements',
            'rooms',
            'materials'
        ));
    }

    public function profil()
    {
        return view('dashboard.etudiant.profil');
    }

    public function editProfil()
    {
        return view('dashboard.etudiant.edit-profil');
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
        ]);

        // Utilisez User::find() au lieu de Auth::user()
        $user = User::find(Auth::id());
        
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('etudiant.profil')->with('success', 'Profil mis à jour avec succès !');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::find(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Le mot de passe actuel est incorrect.'
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('etudiant.profil')->with('success', 'Mot de passe mis à jour avec succès !');
    }

    public function announcements(Request $request)
    {
        $query = Announcement::with('user')->latest();

        // Recherche par titre ou contenu seulement (pas de filtrage par catégorie)
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $announcements = $query->paginate(10);

        // Statistiques simplifiées (sans catégories)
        $totalAnnouncements = Announcement::count();
        $todayAnnouncements = Announcement::whereDate('created_at', today())->count();
        $weekAnnouncements = Announcement::where('created_at', '>=', now()->subDays(7))->count();
        
        // Pas d'annonces urgentes ni épinglées (colonnes inexistantes)
        $urgentAnnouncements = 0;
        $pinnedAnnouncements = collect(); // Collection vide

        return view('dashboard.etudiant.announcements', compact(
            'announcements',
            'totalAnnouncements',
            'todayAnnouncements',
            'urgentAnnouncements',
            'weekAnnouncements',
            'pinnedAnnouncements'
        ));
    }

    public function rooms()
    {
        // Récupérer toutes les salles
        $rooms = Room::latest()->get();
        
        // Récupérer tous les matériels
        $materials = Material::latest()->get();

        // Statistiques basées sur les vraies colonnes
        $availableRooms = Room::count();
        $availableMaterials = Material::count();
        $myReservations = Reservation::where('user_id', Auth::id())->count();

        return view('dashboard.etudiant.rooms', compact(
            'rooms',
            'materials',
            'availableRooms',
            'availableMaterials',
            'myReservations'
        ));
    }
}