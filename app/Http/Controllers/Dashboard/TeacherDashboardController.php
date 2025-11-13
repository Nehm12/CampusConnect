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
        $rooms = Room::all();
        $materials = Material::where('quantity_total', '>', 0)->get();
        $availableRooms = $rooms->count();
        $availableMaterials = $materials->count();
        $myReservationsCount = Reservation::where('user_id', Auth::id())->count();

        return view('dashboard.enseignant.rooms', compact('rooms', 'materials', 'availableRooms', 'availableMaterials', 'myReservationsCount'));
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

    /**
     * Mettre à jour une réservation
     */
    public function updateReservation(Request $request, $id)
    {
        $reservation = Reservation::where('id', $id)
                                 ->where('user_id', Auth::id())
                                 ->firstOrFail();

        // Vérifier si la réservation peut être modifiée
        if (!in_array($reservation->status, ['pending', 'approved'])) {
            return redirect()->route('enseignant.reservations')
                           ->with('error', 'Cette réservation ne peut plus être modifiée.');
        }

        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date|after_or_equal:now',
            'end_time' => 'required|date|after:start_time',
            'purpose' => 'required|string|max:500',
            'material_ids' => 'nullable|array',
            'material_ids.*' => 'exists:materials,id',
            'quantities' => 'nullable|array',
            'quantities.*' => 'integer|min:1'
        ]);

        // Vérifier les conflits (sauf cette réservation)
        $conflict = Reservation::where('room_id', $validated['room_id'])
            ->where('id', '!=', $id)
            ->where(function($query) use ($validated) {
                $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                      ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']])
                      ->orWhere(function($q) use ($validated) {
                          $q->where('start_time', '<=', $validated['start_time'])
                            ->where('end_time', '>=', $validated['end_time']);
                      });
            })
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($conflict) {
            return back()->withErrors(['room_id' => 'Cette salle est déjà réservée pour cette période.'])->withInput();
        }

        // Vérifier la disponibilité des matériels
        if (!empty($validated['material_ids'])) {
            foreach ($validated['material_ids'] as $index => $materialId) {
                $quantity = $validated['quantities'][$index] ?? 1;
                $material = Material::find($materialId);
                
                if (!$material || $material->quantity_total < $quantity) {
                    return back()->withErrors(['material_ids' => "Quantité insuffisante pour le matériel {$material->name}."])->withInput();
                }
            }
        }

        // Mettre à jour la réservation
        $reservation->update([
            'room_id' => $validated['room_id'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'purpose' => $validated['purpose'],
            'status' => 'pending' // Repasser en attente après modification
        ]);

        // Synchroniser les matériels
        if (!empty($validated['material_ids'])) {
            $syncData = [];
            foreach ($validated['material_ids'] as $index => $materialId) {
                $quantity = $validated['quantities'][$index] ?? 1;
                $syncData[$materialId] = ['quantity' => $quantity];
            }
            $reservation->materials()->sync($syncData);
        } else {
            $reservation->materials()->detach();
        }

        return redirect()->route('enseignant.reservations')
                        ->with('success', 'Réservation mise à jour avec succès !');
    }

    /**
     * Annuler une réservation
     */
    public function cancelReservation($id)
    {
        $reservation = Reservation::where('id', $id)
                                 ->where('user_id', Auth::id())
                                 ->firstOrFail();
        
        // Vérifier si la réservation peut être annulée
        if (!in_array($reservation->status, ['pending', 'approved'])) {
            return redirect()->route('enseignant.reservations')
                           ->with('error', 'Cette réservation ne peut pas être annulée.');
        }
        
        $reservation->update(['status' => 'cancelled']);
        
        return redirect()->route('enseignant.reservations')
                       ->with('success', 'Réservation annulée avec succès !');
    }

    /**
     * Afficher les détails d'une réservation
     */
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

    public function updateAnnouncement(Request $request, $id)
    {
        $announcement = Announcement::where('id', $id)
                                  ->where('user_id', Auth::id())
                                  ->firstOrFail();
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'nullable|exists:announcement_categories,id'
        ]);
        
        $announcement->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);
        
        return redirect()->route('enseignant.announcements')
                        ->with('success', 'Annonce mise à jour avec succès !');
    }

    public function destroyAnnouncement($id)
    {
        $announcement = Announcement::where('id', $id)
                                  ->where('user_id', Auth::id())
                                  ->firstOrFail();
        
        $announcement->delete();
        
        return redirect()->route('enseignant.announcements')
                        ->with('success', 'Annonce supprimée avec succès !');
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