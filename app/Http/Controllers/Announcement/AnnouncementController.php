<?php
namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::with('category', 'user')
            ->published()
            ->orderByDesc('is_pinned')
            ->orderByDesc('published_at')
            ->paginate(10);

        return view('announcements.index', compact('announcements'));
    }

    public function create()
    {
        $categories = AnnouncementCategory::all();
        return view('announcements.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'nullable|exists:announcement_categories,id',
            'is_pinned' => 'boolean',
        ]);

        Announcement::create([
            ...$validated,
            'user_id' => Auth::user()->id,
            'published_at' => now(),
        ]);

        return redirect()->route('announcements.index')->with('success', 'Annonce publiée avec succès.');
    }
}
