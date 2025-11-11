<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AnnouncementCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'category_id');
    }

    // Crée automatiquement le slug à partir du nom
    protected static function booted()
    {
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }
}
