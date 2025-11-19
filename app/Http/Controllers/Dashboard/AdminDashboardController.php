<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Announcement;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminDashboardController extends Controller
{
    // ==================== TABLEAU DE BORD ====================
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_students' => User::where('role', 'student')->count(),
            'total_teachers' => User::where('role', 'teacher')->count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_announcements' => Announcement::count(),
            'total_rooms' => Room::count(),
            'total_materials' => Material::count(),
            'pending_reservations' => Reservation::where('status', 'en_attente')->count(),
            'approved_reservations' => Reservation::where('status', 'approuvee')->count(),
            'rejected_reservations' => Reservation::where('status', 'rejetee')->count(),
        ];

        $recentAnnouncements = Announcement::with('user')->latest()->take(5)->get();
        $pendingReservations = Reservation::with(['user', 'room', 'material'])
            ->where('status', 'en_attente')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.admin.index', compact('stats', 'recentAnnouncements', 'pendingReservations'));
    }

    // ==================== PROFIL ====================
    public function profil()
    {
        $user = auth()->user();
        return view('dashboard.admin.profil', compact('user'));
    }

    public function updateProfil(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->only(['firstname', 'lastname', 'email']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return back()->with('success', 'Profil mis à jour avec succès !');
    }

   
// ==================== UTILISATEURS ====================
public function users(Request $request)
{
    $query = User::query();

    // Filtre par rôle (synchronisé avec la vue)
    if ($request->filled('role')) {
        $query->where('role', $request->role);
    }

    // Recherche par nom, prénom ou email
    if ($request->filled('search')) {
        $query->where(function($q) use ($request) {
            $q->where('firstname', 'like', '%' . $request->search . '%')
              ->orWhere('lastname', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%');
        });
    }

    $users = $query->latest()->paginate(15)->withQueryString();
    return view('dashboard.admin.users', compact('users'));
}

public function storeUser(Request $request)
{
    // Validation avec messages en français
    $validated = $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'role' => 'required|in:admin,teacher,student', // ✅ Valeurs en anglais
    ], [
        'firstname.required' => 'Le prénom est obligatoire',
        'lastname.required' => 'Le nom est obligatoire',
        'email.required' => "L'email est obligatoire",
        'email.email' => "L'email doit être valide",
        'email.unique' => 'Cet email est déjà utilisé',
        'password.required' => 'Le mot de passe est obligatoire',
        'password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
        'role.required' => 'Le rôle est obligatoire',
        'role.in' => 'Le rôle sélectionné est invalide',
    ]);

    try {
        User::create([
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'], // ✅ admin, teacher ou student
        ]);

        return back()->with('success', 'Utilisateur créé avec succès !');
    } catch (\Exception $e) {
        return back()->with('error', '❌ Erreur : ' . $e->getMessage())->withInput();
    }
}

public function updateUser(Request $request, $id)
{
    $user = User::findOrFail($id);
    
    // Validation
    $validated = $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'role' => 'required|in:admin,teacher,student', // 
    ], [
        'firstname.required' => 'Le prénom est obligatoire',
        'lastname.required' => 'Le nom est obligatoire',
        'email.required' => "L'email est obligatoire",
        'email.email' => "L'email doit être valide",
        'email.unique' => 'Cet email est déjà utilisé par un autre utilisateur',
        'role.required' => 'Le rôle est obligatoire',
        'role.in' => 'Le rôle sélectionné est invalide',
    ]);

    try {
        $user->update([
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'email' => $validated['email'],
            'role' => $validated['role'], // ✅ admin, teacher ou student
        ]);

        return back()->with('success', '✅ Utilisateur modifié avec succès !');
    } catch (\Exception $e) {
        return back()->with('error', '❌ Erreur : ' . $e->getMessage());
    }
}

public function destroyUser($id)
{
    $user = User::findOrFail($id);
    
    // Empêcher la suppression de son propre compte
    if ($user->id === auth()->id()) {
        return back()->with('error', '❌ Vous ne pouvez pas supprimer votre propre compte !');
    }

    try {
        $user->delete();
        return back()->with('success', '✅ Utilisateur supprimé avec succès !');
    } catch (\Exception $e) {
        return back()->with('error', '❌ Erreur : ' . $e->getMessage());
    }
}

// ==================== ANNONCES ====================
public function announcements(Request $request)
{
    $query = Announcement::with('user');

    // Recherche par titre
    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    $announcements = $query->latest()->paginate(10)->withQueryString();
    return view('dashboard.admin.announcements', compact('announcements'));
}

public function storeAnnouncement(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'category_id' => 'required|exists:announcement_categories,id',
        'published_at' => 'nullable|date',
        'is_pinned' => 'nullable|boolean',
    ], [
        'title.required' => 'Le titre est obligatoire',
        'description.required' => 'La description est obligatoire',
        'category_id.required' => 'La catégorie est obligatoire',
        'category_id.exists' => 'La catégorie sélectionnée est invalide',
    ]);

    try {
        Announcement::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'user_id' => auth()->id(),
            'published_at' => $validated['published_at'] ?? now(),
            'is_pinned' => $request->has('is_pinned'),
        ]);

        return back()->with('success', '✅ Annonce publiée avec succès !');
    } catch (\Exception $e) {
        return back()->with('error', '❌ Erreur : ' . $e->getMessage())->withInput();
    }
}

public function updateAnnouncement(Request $request, $id)
{
    $announcement = Announcement::findOrFail($id);
    
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'category_id' => 'required|exists:announcement_categories,id',
        'published_at' => 'nullable|date',
        'is_pinned' => 'nullable|boolean',
    ]);

    try {
        $announcement->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'published_at' => $validated['published_at'] ?? $announcement->published_at,
            'is_pinned' => $request->has('is_pinned'),
        ]);

        return back()->with('success', '✅ Annonce modifiée avec succès !');
    } catch (\Exception $e) {
        return back()->with('error', '❌ Erreur : ' . $e->getMessage());
    }
}

public function destroyAnnouncement($id)
{
    $announcement = Announcement::findOrFail($id);
    
    try {
        $announcement->delete();
        return back()->with('success', '✅ Annonce supprimée avec succès !');
    } catch (\Exception $e) {
        return back()->with('error', '❌ Erreur : ' . $e->getMessage());
    }
}

// ==================== RÉSERVATIONS ====================

public function reservations(Request $request)
    {
        // ✅ Charger avec 'materials' (pluriel)
        $query = Reservation::with(['user', 'room', 'materials']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reservations = $query->latest()->paginate(15)->withQueryString();
        return view('dashboard.admin.reservation', compact('reservations'));
    }

    public function approveReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        
        if ($reservation->status !== 'pending') {
            return back()->with('error', '❌ Seules les réservations en attente peuvent être approuvées !');
        }

        $reservation->update([
            'status' => 'approved',
            'admin_id' => auth()->id()
        ]);
        
        return back()->with('success', '✅ Réservation approuvée avec succès !');
    }

    public function rejectReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        
        if ($reservation->status !== 'pending') {
            return back()->with('error', '❌ Seules les réservations en attente peuvent être rejetées !');
        }

        $reservation->update([
            'status' => 'rejected',
            'admin_id' => auth()->id()
        ]);
        
        return back()->with('success', '✅ Réservation rejetée avec succès !');
    }

    public function destroyReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return back()->with('success', '✅ Réservation supprimée avec succès !');
    }


// ==================== SALLES ====================
public function ressources()
{
    $rooms = Room::latest()->paginate(12, ['*'], 'rooms_page');
    $materials = Material::latest()->paginate(12, ['*'], 'materials_page');
    return view('dashboard.admin.ressources', compact('rooms', 'materials'));
}

public function storeRoom(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'nullable|string|max:50|unique:rooms,code',
        'capacity' => 'required|integer|min:1',
        'location' => 'nullable|string|max:255',
        'notes' => 'nullable|string',
    ]);

    Room::create($validated);
    return back()->with('success', '✅ Salle créée avec succès !');
}

public function updateRoom(Request $request, $id)
{
    $room = Room::findOrFail($id);
    
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'nullable|string|max:50|unique:rooms,code,' . $id,
        'capacity' => 'required|integer|min:1',
        'location' => 'nullable|string|max:255',
        'notes' => 'nullable|string',
    ]);

    $room->update($validated);
    return back()->with('success', '✅ Salle mise à jour avec succès !');
}

public function destroyRoom($id)
{
    $room = Room::findOrFail($id);
    $room->delete();
    return back()->with('success', '✅ Salle supprimée avec succès !');
}

// ==================== MATÉRIELS ====================
public function storeMaterial(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'nullable|string|max:50|unique:materials,code',
        'quantity_total' => 'required|integer|min:1',
        'location' => 'nullable|string|max:255',
        'notes' => 'nullable|string',
    ]);

    Material::create($validated);
    return back()->with('success', '✅ Matériel créé avec succès !');
}

public function updateMaterial(Request $request, $id)
{
    $material = Material::findOrFail($id);
    
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'nullable|string|max:50|unique:materials,code,' . $id,
        'quantity_total' => 'required|integer|min:1',
        'location' => 'nullable|string|max:255',
        'notes' => 'nullable|string',
    ]);

    $material->update($validated);
    return back()->with('success', '✅ Matériel mis à jour avec succès !');
}

public function destroyMaterial($id)
{
    $material = Material::findOrFail($id);
    $material->delete();
    return back()->with('success', '✅ Matériel supprimé avec succès !');
}

    // ==================== STATISTIQUES ====================
    public function stats()
    {
        $stats = [
            'total_users' => User::count(),
            'total_students' => User::where('role', 'etudiant')->count(),
            'total_teachers' => User::where('role', 'enseignant')->count(),
            'total_announcements' => Announcement::count(),
            'total_rooms' => Room::count(),
            'total_materials' => Material::sum('quantity_total'),
            'total_reservations' => Reservation::count(),
            'pending_reservations' => Reservation::where('status', 'pending')->count(),
            'approved_reservations' => Reservation::where('status', 'approved')->count(),
            'rejected_reservations' => Reservation::where('status', 'rejected')->count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        
        // ✅ Charger avec 'materials' (pluriel)
        $recentReservations = Reservation::with(['user', 'room', 'materials'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.admin.stats', compact('stats', 'recentUsers', 'recentReservations'));
    }
}