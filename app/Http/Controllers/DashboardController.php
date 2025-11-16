<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Material;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = request()->user();

        // Statistiques communes
        $stats = [
            'total_users' => User::count(),
            'total_announcements' => Announcement::published()->count(),
            'total_rooms' => Room::count(),
            'total_materials' => Material::count(),
        ];

        // Données spécifiques selon le rôle
        if ($user->isAdmin()) {
            return $this->adminDashboard($stats);
        } elseif ($user->isTeacher()) {
            return $this->teacherDashboard($stats);
        } else {
            return $this->studentDashboard($stats);
        }
    }

     private function adminDashboard($stats)
    {
        $stats['pending_reservations'] = Reservation::pending()->count();
        $stats['today_reservations'] = Reservation::approved()
            ->whereDate('start_time', today())
            ->count();

        // Réservations en attente
        $pendingReservations = Reservation::with(['user', 'room'])
            ->pending()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Annonces récentes
        $recentAnnouncements = Announcement::with(['user', 'category'])
            ->published()
            ->orderByPinned()
            ->take(5)
            ->get();

        // Statistiques des réservations par statut
        $reservationStats = [
            'pending' => Reservation::pending()->count(),
            'approved' => Reservation::approved()->count(),
            'rejected' => Reservation::rejected()->count(),
        ];

        return view('dashboard.admin', compact(
            'stats',
            'pendingReservations',
            'recentAnnouncements',
            'reservationStats'
        ));
    }

    private function teacherDashboard($stats)
    {
        $user = request()->user();

        // Mes annonces
        $myAnnouncements = $user->announcements()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Mes réservations
        $myReservations = $user->reservations()
            ->with(['room', 'materials'])
            ->orderBy('start_time', 'desc')
            ->take(5)
            ->get();

        // Réservations à venir
        $upcomingReservations = $user->reservations()
            ->with(['room', 'materials'])
            ->approved()
            ->upcoming()
            ->orderBy('start_time')
            ->take(5)
            ->get();

        // Annonces récentes (tous)
        $recentAnnouncements = Announcement::with(['user', 'category'])
            ->published()
            ->orderByPinned()
            ->take(5)
            ->get();

        $stats['my_announcements'] = $user->announcements()->count();
        $stats['my_reservations'] = $user->reservations()->count();
        $stats['pending_reservations'] = $user->reservations()->pending()->count();

        return view('dashboard.teacher', compact(
            'stats',
            'myAnnouncements',
            'myReservations',
            'upcomingReservations',
            'recentAnnouncements'
        ));
    }

    private function studentDashboard($stats)
    {
        $user = request()->user();

        // Annonces récentes
        $recentAnnouncements = Announcement::with(['user', 'category'])
            ->published()
            ->orderByPinned()
            ->take(10)
            ->get();

        // Mes réservations
        $myReservations = $user->reservations()
            ->with(['room', 'materials'])
            ->orderBy('start_time', 'desc')
            ->take(5)
            ->get();

        // Réservations à venir
        $upcomingReservations = $user->reservations()
            ->with(['room', 'materials'])
            ->approved()
            ->upcoming()
            ->orderBy('start_time')
            ->take(5)
            ->get();

        // Salles disponibles aujourd'hui (exemple)
        $availableRooms = Room::take(5)->get();

        $stats['my_reservations'] = $user->reservations()->count();
        $stats['pending_reservations'] = $user->reservations()->pending()->count();

        return view('dashboard.student', compact(
            'stats',
            'recentAnnouncements',
            'myReservations',
            'upcomingReservations',
            'availableRooms'
        ));
    }
}