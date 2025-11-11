<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'quantity_total',
        'location',
        'notes',
    ];

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_material')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
