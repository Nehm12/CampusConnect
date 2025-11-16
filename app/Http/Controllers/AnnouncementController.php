<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Liste des annonces
     */
    public function index(Request $request)
    {
        $query = Announcement::with(['user', 'category'])->published();

        // Filtrer par catégorie
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filtrer par auteur
        if ($request->filled('author')) {
            $query->where('user_id', $request->author);
        }

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $announcements = $query->orderByPinned()->paginate(15);
        $categories = AnnouncementCategory::all();

        return view('announcements.index', compact('announcements', 'categories'));
    }


     /**
     * Formulaire de création
     */
    public function create()
    {
        $this->authorize('create', Announcement::class);
        
        $categories = AnnouncementCategory::all();
        return view('announcements.create', compact('categories'));
    }


    /**
     * Enregistrer une nouvelle annonce
     */
    public function store(Request $request)
    {
        $this->authorize('create', Announcement::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:announcement_categories,id',
            'description' => 'required|string',
            'is_pinned' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['user_id'] = request()->user()->id;
        
        // Si published_at est coché, définir maintenant
        if ($request->has('publish_now')) {
            $validated['published_at'] = now();
        }

        $announcement = Announcement::create($validated);

        return redirect()
            ->route('announcements.show', $announcement)
            ->with('success', 'Annonce créée avec succès');
    }

    /**
     * Afficher une annonce
     */
    public function show(Announcement $announcement)
    {
        // Vérifier si publiée (sauf pour l'auteur et les admins)
        if (!$announcement->is_published && 
            request()->user()->id !== $announcement->user_id && 
            !request()->user()->isAdmin()) {
            abort(403);
        }

        $announcement->load(['user', 'category']);
        
        return view('announcements.show', compact('announcement'));
    }

    /**
     * Formulaire d'édition
     */
    public function edit(Announcement $announcement)
    {
        $this->authorize('update', $announcement);
        
        $categories = AnnouncementCategory::all();
        return view('announcements.edit', compact('announcement', 'categories'));
    }

    /**
     * Mettre à jour une annonce
     */
    public function update(Request $request, Announcement $announcement)
    {
        $this->authorize('update', $announcement);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:announcement_categories,id',
            'description' => 'required|string',
            'is_pinned' => 'boolean',
        ]);

        // Gérer la publication
        if ($request->has('publish_now') && !$announcement->published_at) {
            $validated['published_at'] = now();
        }

        $announcement->update($validated);

        return redirect()
            ->route('announcements.show', $announcement)
            ->with('success', 'Annonce mise à jour');
    }

    /**
     * Supprimer une annonce
     */
    public function destroy(Announcement $announcement)
    {
        $this->authorize('delete', $announcement);

        $announcement->delete();

        return redirect()
            ->route('announcements.index')
            ->with('success', 'Annonce supprimée');
    }
}