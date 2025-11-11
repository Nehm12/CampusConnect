<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Room;
use App\Models\Material;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques générales
        $stats = [
            'total_users' => User::count(),
            'total_students' => User::where('role', 'student')->count(),
            'total_teachers' => User::where('role', 'teacher')->count(),
            'total_announcements' => Announcement::count(),
            'total_rooms' => Room::count(),
            'total_materials' => Material::count(),
            'pending_reservations' => Reservation::where('status', 'pending')->count(),
            'today_reservations' => Reservation::whereDate('created_at', today())->count(),
        ];

        // Dernières annonces
        $latestAnnouncements = Announcement::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Dernières réservations
        $latestReservations = Reservation::with(['user', 'room', 'material'])
            ->latest()
            ->take(5)
            ->get();

        // Utilisateurs récents
        $recentUsers = User::latest()
            ->take(5)
            ->get();

        // Activité récente (derniers 7 jours)
        $recentActivity = [
            'new_announcements' => Announcement::where('created_at', '>=', now()->subDays(7))->count(),
            'new_reservations' => Reservation::where('created_at', '>=', now()->subDays(7))->count(),
            'new_users' => User::where('created_at', '>=', now()->subDays(7))->count(),
        ];

        return view('dashboard.admin.index', compact(
            'stats',
            'latestAnnouncements',
            'latestReservations',
            'recentUsers',
            'recentActivity'
        ));
    }
}