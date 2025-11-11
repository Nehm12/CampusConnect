<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

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
}
