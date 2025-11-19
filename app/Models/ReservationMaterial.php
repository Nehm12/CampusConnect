<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationMaterial extends Model
{
    use HasFactory;

    protected $table = 'reservation_material';

    protected $fillable = [
        'reservation_id',
        'material_id',
        'quantity',
    ];
}
