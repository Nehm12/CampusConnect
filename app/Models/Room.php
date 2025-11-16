<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'capacity',
        'location',
        'notes',
    ];

    protected $casts = [
        'capacity' => 'integer',
    ];


    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Vérifier si une salle est disponible

    public function isAvailable($startTime, $endTime, $excludeReservationId = null)
    {
        $query = $this->reservations()
            ->where('status', 'approved')
            ->where(function ($q) use ($startTime, $endTime) {
                $q->whereBetween('start_time', [$startTime, $endTime])
                  ->orWhereBetween('end_time', [$startTime, $endTime])
                  ->orWhere(function ($q2) use ($startTime, $endTime) {
                      $q2->where('start_time', '<=', $startTime)
                         ->where('end_time', '>=', $endTime);
                  });
            });

        if ($excludeReservationId) {
            $query->where('id', '!=', $excludeReservationId);
        }

        return $query->count() === 0;
    }

    // Obtenir les réservations pour une période donnée
    public function getReservationsForPeriod($startDate, $endDate)
    {
        return $this->reservations()
            ->where('status', 'approved')
            ->whereBetween('start_time', [$startDate, $endDate])
            ->orderBy('start_time')
            ->get();
    }

    // Obtenir les créneaux disponibles pour une journée
    public function getAvailableSlots($date)
    {

        // On récupère d'abord les réservations concernants la journée
        $reservations = $this->reservations()
            ->where('status', 'approved')
            ->whereDate('start_time', $date)
            ->orderBy('start_time')
            ->get(['start_time', 'end_time']);


        // On définit maintenant les créneaux possibles
        $allSlots = [];
        $startHour = 9; // 9h
        $endHour = 19;  // 18h
        
        for ($hour = $startHour; $hour < $endHour; $hour++) {
            $slotStart = "{$hour}:00";
            $slotEnd = ($hour + 1) . ":00";
            $allSlots[] = [
                'start' => $slotStart,
                'end' => $slotEnd,
                'available' => true
            ];
        }

        foreach ($reservations as $reservation) {
        $reservationStart = Carbon::parse($reservation->start_time)->format('H:i');
        $reservationEnd = Carbon::parse($reservation->end_time)->format('H:i');
            
            // On vérifie si les horaires se chevauchent
            foreach ($allSlots as &$slot) {
                if ($this->timeOverlaps($slot['start'], $slot['end'], $reservationStart, $reservationEnd)) {
                    $slot['available'] = false;
                }
            }
        }

        // On retourne uniquement les créneaux disponibles
        return array_filter($allSlots, function($slot) {
            return $slot['available'];
        });
    }

    private function timeOverlaps($slotStart, $slotEnd, $reservationStart, $reservationEnd)
    {
        return !($slotEnd <= $reservationStart || $slotStart >= $reservationEnd);
    }

}