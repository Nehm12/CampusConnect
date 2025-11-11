<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Room;
use App\Models\Material;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        // Statistiques pour le dashboard enseignant
        $stats = [
            'my_announcements' => Announcement::where('user_id', Auth::id())->count(),
            'my_reservations' => Reservation::where('user_id', Auth::id())->count(),
            'available_rooms' => Room::count(),
            'available_materials' => Material::sum('quantity_total'),
            'pending_reservations' => Reservation::where('user_id', Auth::id())
                                               ->where('status', 'pending')
                                               ->count(),
        ];

        // Dernières annonces créées par l'enseignant
        $myAnnouncements = Announcement::where('user_id', Auth::id())
                                     ->with('user')
                                     ->latest()
                                     ->take(3)
                                     ->get();

        // Dernières réservations de l'enseignant
        $myReservations = Reservation::where('user_id', Auth::id())
                                   ->with(['room', 'materials'])
                                   ->latest()
                                   ->take(3)
                                   ->get();

        return view('dashboard.enseignant.index', compact('stats', 'myAnnouncements', 'myReservations'));
    }

    public function rooms()
    {
        // Salles disponibles
        $rooms = Room::all();
        $materials = Material::where('quantity_total', '>', 0)->get();

        $availableRooms = $rooms->count();
        $availableMaterials = $materials->count();
        
        // Compter les réservations de l'utilisateur actuel
        $myReservationsCount = Reservation::where('user_id', Auth::id())->count();

        return view('dashboard.enseignant.rooms', compact('rooms', 'materials', 'availableRooms', 'availableMaterials', 'myReservationsCount'));
    }

    public function reservations()
    {
        // Réservations de l'enseignant
        $reservations = Reservation::where('user_id', Auth::id())
                                 ->with(['room', 'materials'])
                                 ->latest()
                                 ->paginate(10);

        $stats = [
            'total' => Reservation::where('user_id', Auth::id())->count(),
            'pending' => Reservation::where('user_id', Auth::id())->where('status', 'pending')->count(),
            'approved' => Reservation::where('user_id', Auth::id())->where('status', 'approved')->count(),
            'rejected' => Reservation::where('user_id', Auth::id())->where('status', 'rejected')->count(),
        ];

        return view('dashboard.enseignant.reservations', compact('reservations', 'stats'));
    }

    public function announcements()
    {
        // Annonces de l'enseignant
        $announcements = Announcement::where('user_id', Auth::id())
                                   ->with('user')
                                   ->latest()
                                   ->paginate(10);

        return view('dashboard.enseignant.announcements', compact('announcements'));
    }

    public function profil()
    {
        $user = Auth::user();
        return view('dashboard.enseignant.profil', compact('user'));
    }

    public function editProfil()
    {
        $user = Auth::user();
        return view('dashboard.enseignant.profil-edit', compact('user'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'telephone' => ['nullable', 'string', 'max:20'],
        ]);

        $user = User::find(Auth::id());
        
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->save();

        return redirect()->route('enseignant.profil')->with('success', 'Profil mis à jour avec succès !');
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

        return redirect()->route('enseignant.profil')->with('success', 'Mot de passe mis à jour avec succès !');
    }
}