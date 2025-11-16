<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $query = Material::query();

        // Recherche
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filtrer par disponibilité
        if ($request->filled('in_stock')) {
            $query->inStock();
        }

        $materials = $query->orderBy('name')->paginate(20);

        return view('materials.index', compact('materials'));
    }

    /**
     * Formulaire de création (Admin)
     */
    public function create()
    {
        $this->authorize('create', Material::class);
        
        return view('materials.create');
    }

    /**
     * Enregistrer un nouveau matériel (Admin)
     */
    public function store(Request $request)
    {
        $this->authorize('create', Material::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:materials,code',
            'quantity_total' => 'required|integer|min:0',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $material = Material::create($validated);

        return redirect()
            ->route('materials.show', $material)
            ->with('success', 'Matériel créé avec succès');
    }

    /**
     * Afficher un matériel
     */
    public function show(Material $material)
    {
        // Réservations à venir pour ce matériel
        $upcomingReservations = $material->reservations()
            ->with('user')
            ->approved()
            ->upcoming()
            ->orderBy('start_time')
            ->get();

        return view('materials.show', compact('material', 'upcomingReservations'));
    }

    /**
     * Formulaire d'édition (Admin)
     */
    public function edit(Material $material)
    {
        $this->authorize('update', $material);
        
        return view('materials.edit', compact('material'));
    }

    /**
     * Mettre à jour un matériel (Admin)
     */
    public function update(Request $request, Material $material)
    {
        $this->authorize('update', $material);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:materials,code,' . $material->id,
            'quantity_total' => 'required|integer|min:0',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $material->update($validated);

        return redirect()
            ->route('materials.show', $material)
            ->with('success', 'Matériel mis à jour');
    }

    /**
     * Supprimer un matériel (Admin)
     */
    public function destroy(Material $material)
    {
        $this->authorize('delete', $material);

        // Vérifier s'il y a des réservations à venir
        $hasUpcomingReservations = $material->reservations()
            ->approved()
            ->upcoming()
            ->exists();

        if ($hasUpcomingReservations) {
            return back()->withErrors(['error' => 'Impossible de supprimer un matériel avec des réservations à venir']);
        }

        $material->delete();

        return redirect()
            ->route('materials.index')
            ->with('success', 'Matériel supprimé');
    }
}