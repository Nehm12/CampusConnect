<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'user_id',
        'room_id',
        'start_time',
        'end_time',
        'purpose',
        'status',
        'admin_id',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        // Générer automatiquement la référence lors de la création
        static::creating(function ($reservation) {
            if (empty($reservation->reference)) {
                $reservation->reference = 'RES-' . strtoupper(Str::random(8));
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'reservation_material')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
    
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeForRoom($query, $roomId)
    {
        return $query->where('room_id', $roomId);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeForPeriod($query, $startDate, $endDate)
    {
        return $query->whereBetween('start_time', [$startDate, $endDate]);
    }

    // Réservations en cours
    public function scopeCurrent($query)
    {
        $now = now();
        return $query->where('start_time', '<=', $now)
                     ->where('end_time', '>=', $now);
    }

    // Durée de réservation en heures
    public function getDurationAttribute()
    {
        return $this->start_time->diffInHours($this->end_time);
    }

    public function getIsPendingAttribute()
    {
        return $this->status === 'pending';
    }

    public function getIsApprovedAttribute()
    {
        return $this->status === 'approved';
    }

    public function getIsRejectedAttribute()
    {
        return $this->status === 'rejected';
    }

    // Mettre les status en français
    public function getStatusLabelAttribute()
    {
        return [
            'pending' => 'En attente',
            'approved' => 'Approuvée',
            'rejected' => 'Rejetée',
            'cancelled' => 'Annulée',
        ][$this->status] ?? $this->status;
    }

    public function approve($adminId)
    {
        $this->update([
            'status' => 'approved',
            'admin_id' => $adminId,
        ]);
    }

    public function reject($adminId)
    {
        $this->update([
            'status' => 'rejected',
            'admin_id' => $adminId,
        ]);
    }

    public function cancel()
    {
        $this->update(['status' => 'cancelled']);
    }
}