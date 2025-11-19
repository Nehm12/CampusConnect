<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use App\Models\User;
use App\Models\Room;
use App\Models\Material;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'my_announcements' => Announcement::where('user_id', Auth::id())->count(),
            'my_reservations' => Reservation::where('user_id', Auth::id())->count(),
            'available_rooms' => Room::count(),
            'available_materials' => Material::sum('quantity_total'),
            'pending_reservations' => Reservation::where('user_id', Auth::id())
                                               ->where('status', 'pending')
                                               ->count(),
        ];

        $myAnnouncements = Announcement::where('user_id', Auth::id())
                                     ->with('user', 'category')
                                     ->latest()
                                     ->take(3)
                                     ->get();

        $myReservations = Reservation::where('user_id', Auth::id())
                                   ->with('room', 'materials', 'user')
                                   ->latest()
                                   ->take(3)
                                   ->get();

        return view('dashboard.enseignant.index', compact('stats', 'myAnnouncements', 'myReservations'));
    }

    public function rooms()
    {
        // Récupérer toutes les salles avec leurs réservations
        $rooms = Room::withCount([
            'reservations as active_reservations_count' => function($query) {
                $query->whereIn('status', ['pending', 'approved'])
                      ->where('start_time', '<=', now())
                      ->where('end_time', '>=', now());
            }
        ])->get();
    
        // Calculer la disponibilité de chaque salle
        $rooms->each(function($room) {
            // Vérifier si la salle est actuellement réservée
            $currentReservation = Reservation::where('room_id', $room->id)
                ->whereIn('status', ['pending', 'approved'])
                ->where('start_time', '<=', now())
                ->where('end_time', '>=', now())
                ->first();
            
            $room->is_available = !$currentReservation;
            $room->current_reservation = $currentReservation;
    
            // Prochaine réservation
            $room->next_reservation = Reservation::where('room_id', $room->id)
                ->whereIn('status', ['pending', 'approved'])
                ->where('start_time', '>', now())
                ->orderBy('start_time')
                ->first();
    
            // Nombre total de réservations futures
            $room->future_reservations_count = Reservation::where('room_id', $room->id)
                ->whereIn('status', ['pending', 'approved'])
                ->where('start_time', '>', now())
                ->count();
        });
    
        // Récupérer tous les matériels avec disponibilité réelle
        $materials = Material::where('quantity_total', '>', 0)->get();
        
        $materials->each(function($material) {
            // Calculer la quantité actuellement réservée
            $reservedQuantity = $material->reservations()
                ->whereIn('status', ['pending', 'approved'])
                ->where('start_time', '<=', now())
                ->where('end_time', '>=', now())
                ->sum('reservation_material.quantity');
            
            $material->available_quantity = max(0, $material->quantity_total - $reservedQuantity);
            $material->reserved_quantity = $reservedQuantity;
            $material->is_available = $material->available_quantity > 0;
    
            // Prochaine réservation
            $material->next_reservation = $material->reservations()
                ->whereIn('status', ['pending', 'approved'])
                ->where('start_time', '>', now())
                ->orderBy('start_time')
                ->first();
        });
    
        // Statistiques mises à jour
        $availableRooms = $rooms->where('is_available', true)->count();
        $availableMaterials = $materials->where('is_available', true)->count();
        $myReservationsCount = Reservation::where('user_id', Auth::id())->count();
    
        $stats = [
            'available_rooms' => $availableRooms,
            'available_materials' => $availableMaterials,
            'my_reservations' => $myReservationsCount
        ];
    
        return view('dashboard.enseignant.rooms', compact('rooms', 'materials', 'stats'));
    }

    /**
     * Afficher toutes les réservations de l'enseignant
     */
    public function reservations()
    {
        $reservations = Reservation::where('user_id', Auth::id())
                                 ->with(['room', 'materials', 'user', 'admin'])
                                 ->latest()
                                 ->get();

        $stats = [
            'total' => $reservations->count(),
            'confirmed' => Reservation::where('user_id', Auth::id())->where('status', 'approved')->count(),
            'pending' => Reservation::where('user_id', Auth::id())->where('status', 'pending')->count(),
            'rejected' => Reservation::where('user_id', Auth::id())->where('status', 'rejected')->count(),
            'cancelled' => Reservation::where('user_id', Auth::id())->where('status', 'cancelled')->count(),
            'this_month' => Reservation::where('user_id', Auth::id())
                                     ->whereMonth('created_at', now()->month)
                                     ->count(),
        ];

        return view('dashboard.enseignant.reservations', compact('reservations', 'stats'));
    }

    /**
     * Créer une nouvelle réservation
     */
    public function storeReservation(Request $request)
    {
        // Validation adaptée au formulaire de rooms.blade.php
        $validated = $request->validate([
            'type' => 'required|in:room,material',
            'resource_id' => 'required|integer',
            'reservation_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'duration' => 'required|integer|min:1',
            'purpose' => 'required|string|max:500',
            'quantity' => 'nullable|integer|min:1'
        ]);
    
        // Construire les datetime complètes
        $startDateTime = $validated['reservation_date'] . ' ' . $validated['start_time'];
        $endDateTime = $validated['reservation_date'] . ' ' . $validated['end_time'];
    
        // Vérifier selon le type (room ou material)
        if ($validated['type'] === 'room') {
            // Vérifier que la salle existe
            $room = Room::findOrFail($validated['resource_id']);
    
            // Vérifier les conflits de réservation pour la salle
            $conflict = Reservation::where('room_id', $validated['resource_id'])
                ->where(function($query) use ($startDateTime, $endDateTime) {
                    $query->whereBetween('start_time', [$startDateTime, $endDateTime])
                          ->orWhereBetween('end_time', [$startDateTime, $endDateTime])
                          ->orWhere(function($q) use ($startDateTime, $endDateTime) {
                              $q->where('start_time', '<=', $startDateTime)
                                ->where('end_time', '>=', $endDateTime);
                          });
                })
                ->whereIn('status', ['pending', 'approved'])
                ->exists();
    
            if ($conflict) {
                return back()->withErrors(['resource_id' => 'Cette salle est déjà réservée pour cette période.'])->withInput();
            }
    
            // Générer une référence unique
            $reference = 'RES-' . strtoupper(Str::random(8));
    
            // Créer la réservation pour une SALLE
            $reservation = Reservation::create([
                'reference' => $reference,
                'user_id' => Auth::id(),
                'room_id' => $validated['resource_id'],
                'start_time' => $startDateTime,
                'end_time' => $endDateTime,
                'purpose' => $validated['purpose'],
                'status' => 'pending' // ✅ En attente de validation admin
            ]);
    
            return redirect()->route('enseignant.reservations')
                            ->with('success', '✅ Réservation de salle créée avec succès ! Elle sera examinée par un administrateur.');
    
        } else {
            // Type = material
            $material = Material::findOrFail($validated['resource_id']);
            $quantity = $validated['quantity'] ?? 1;
    
            // Vérifier la disponibilité du matériel
            if ($material->quantity_total < $quantity) {
                return back()->withErrors(['quantity' => "Quantité insuffisante pour le matériel {$material->name}. Disponible: {$material->quantity_total}"])->withInput();
            }
    
            // Générer une référence unique
            $reference = 'RES-' . strtoupper(Str::random(8));
    
            // Créer la réservation pour un MATÉRIEL
            $reservation = Reservation::create([
                'reference' => $reference,
                'user_id' => Auth::id(),
                'room_id' => null, // Pas de salle pour un matériel
                'start_time' => $startDateTime,
                'end_time' => $endDateTime,
                'purpose' => $validated['purpose'],
                'status' => 'pending' // ✅ En attente de validation admin
            ]);
    
            // Attacher le matériel avec la quantité
            $reservation->materials()->attach($validated['resource_id'], ['quantity' => $quantity]);
    
            return redirect()->route('enseignant.reservations')
                            ->with('success', '✅ Réservation de matériel créée avec succès ! Elle sera examinée par un administrateur.');
        }
    }
    /**
     * Afficher le formulaire d'édition
     */
    public function editReservation($id)
    {
        $reservation = Reservation::where('id', $id)
                                 ->where('user_id', Auth::id())
                                 ->with(['room', 'materials'])
                                 ->firstOrFail();

        // Vérifier si la réservation peut être modifiée
        if (!in_array($reservation->status, ['pending', 'approved'])) {
            return redirect()->route('enseignant.reservations')
                           ->with('error', 'Cette réservation ne peut plus être modifiée.');
        }

        $rooms = Room::all();
        $materials = Material::all();

        return view('dashboard.enseignant.reservations-edit', compact('reservation', 'rooms', 'materials'));
    }



    public function showReservation($id)
    {
        $reservation = Reservation::where('id', $id)
                                 ->where('user_id', Auth::id())
                                 ->with(['room', 'materials', 'user', 'admin'])
                                 ->firstOrFail();

        return view('dashboard.enseignant.reservations-show', compact('reservation'));
    }

    /**
     * Supprimer une réservation (soft delete)
     */
    public function destroyReservation($id)
    {
        $reservation = Reservation::where('id', $id)
                                 ->where('user_id', Auth::id())
                                 ->firstOrFail();
        
        // Seules les réservations rejetées ou annulées peuvent être supprimées
        if (!in_array($reservation->status, ['rejected', 'cancelled'])) {
            return redirect()->route('enseignant.reservations')
                           ->with('error', 'Cette réservation ne peut pas être supprimée.');
        }
        
        $reservation->delete(); // Soft delete
        
        return redirect()->route('enseignant.reservations')
                       ->with('success', 'Réservation supprimée avec succès !');
    }

    // ... Méthodes pour les annonces et profil (inchangées) ...

    public function announcements()
    {
        $announcements = Announcement::all();

        $categories = AnnouncementCategory::all();
        
        $stats = [
            'my_announcements' => $announcements->count(),
            'week_announcements' => Announcement::where('user_id', Auth::id())
                                                ->where('created_at', '>=', now()->startOfWeek())
                                                ->count(),
            'total_views' => 0,
            'avg_engagement' => 0
        ];

        return view('dashboard.enseignant.announcements', compact('announcements', 'categories', 'stats'));
    }

    public function storeAnnouncement(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'nullable|exists:announcement_categories,id'
        ]);
        
        Announcement::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
            'published_at' => now(),
            'is_pinned' => false
        ]);
        
        return redirect()->route('enseignant.announcements')
                        ->with('success', 'Annonce créée avec succès !');
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
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'telephone' => 'nullable|string|max:20'
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->firstname = $validated['firstname'];
        $user->lastname = $validated['lastname'];
        $user->email = $validated['email'];
        $user->telephone = $validated['telephone'];
        $user->save();

        return redirect()->route('enseignant.profil')
                        ->with('success', 'Profil mis à jour avec succès !');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors([
                'current_password' => 'Le mot de passe actuel est incorrect.'
            ])->withInput();
        }

        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->route('enseignant.profil')
                        ->with('success', 'Mot de passe mis à jour avec succès !');
    }
}