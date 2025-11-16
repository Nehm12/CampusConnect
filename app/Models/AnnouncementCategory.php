<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AnnouncementCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'category_id');
    }

     protected static function boot()
    {
        // Appelle les fonctions boot parentes
        parent::boot();

        // Génère le slud avant l'enregistrement dans la BD
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        // Maj du slug si le nom change
        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = Str::slug($category->name);
            }
        });
    }
}