<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'description',
        'user_id',
        'published_at',
        'is_pinned',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_pinned' => 'boolean',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function category()
    {
        return $this->belongsTo(AnnouncementCategory::class, 'category_id');
    }

    // Utils

    // Annonces publiées
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    // Annonces non publiées
    public function scopeNotPublished($query)
    {
        return $query->whereNull('published_at');
    }

    // Annonces épinglées
    public function scopePinned($query)
    {
        return $query->where('is_pinned', true);
    }

     // Filtrer par catégorie
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    // Filtrer par auteur
    public function scopeByAuthor($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Publier l'annonce
    public function publish()
    {
        $this->update(['published_at' => now()]);
    }

    // Epingler l'annonce
    public function pin()
    {
        $this->update(['is_pinned' => true]);
    }

    // Désépingler l'annonce
    public function unpin()
    {
        $this->update(['is_pinned' => false]);
    }

}