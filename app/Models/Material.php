<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'quantity_total',
        'location',
        'notes',
    ];

    protected $casts = [
        'quantity_total' => 'integer',
    ];


    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_material')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }


    // Utils

    // Matériel en stock
    public function scopeInStock($query)
    {
        return $query->where('quantity_total', '>', 0);
    }

    // Calculer la quantité disponible pour une plage
    public function getAvailableQuantity($startTime, $endTime, $excludeReservationId = null)
    {
        $reservedQuery = $this->reservations()
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
            $reservedQuery->where('reservations.id', '!=', $excludeReservationId);
        }

        $reservedQuantity = $reservedQuery->sum('reservation_material.quantity');

        return $this->quantity_total - $reservedQuantity;
    }


    // Vérifier si une quantité est disponible pour une période
    public function isAvailable($quantity, $startTime, $endTime, $excludeReservationId = null)
    {
        $available = $this->getAvailableQuantity($startTime, $endTime, $excludeReservationId);
        return $available >= $quantity;
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
}