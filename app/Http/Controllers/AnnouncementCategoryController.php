<?php

namespace App\Http\Controllers;

use App\Models\AnnouncementCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnnouncementCategoryController extends Controller
{
    /**
     * Liste des catégories (Admin)
     */
    public function index()
    {
        $this->authorize('viewAny', AnnouncementCategory::class);
        
        $categories = AnnouncementCategory::withCount('announcements')
            ->orderBy('name')
            ->paginate(20);

        return view('categories.index', compact('categories'));
    }

    /**
     * Formulaire de création (Admin)
     */
    public function create()
    {
        $this->authorize('create', AnnouncementCategory::class);
        
        return view('categories.create');
    }

    /**
     * Enregistrer une nouvelle catégorie (Admin)
     */
    public function store(Request $request)
    {
        $this->authorize('create', AnnouncementCategory::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:announcement_categories,name',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category = AnnouncementCategory::create($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Formulaire d'édition (Admin)
     */
    public function edit(AnnouncementCategory $category)
    {
        $this->authorize('update', $category);
        
        return view('categories.edit', compact('category'));
    }

    /**
     * Mettre à jour une catégorie (Admin)
     */
    public function update(Request $request, AnnouncementCategory $category)
    {
        $this->authorize('update', $category);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:announcement_categories,name,' . $category->id,
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie mise à jour');
    }

    /**
     * Supprimer une catégorie (Admin)
     */
    public function destroy(AnnouncementCategory $category)
    {
        $this->authorize('delete', $category);

        if ($category->announcements()->exists()) {
            return back()->withErrors(['error' => 'Impossible de supprimer une catégorie contenant des annonces']);
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie supprimée');
    }
}