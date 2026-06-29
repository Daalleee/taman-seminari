<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActivityCategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = ActivityCategory::query()
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('admin.kategori-kegiatan.index', compact('categories'));
    }

    public function create()
    {
        $categories = ActivityCategory::paginate(10);

        return view('admin.kategori-kegiatan.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        ActivityCategory::create($validated);

        return redirect()->route('admin.kategori-kegiatan.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(ActivityCategory $activityCategory)
    {
        $categories = ActivityCategory::paginate(10);

        return view('admin.kategori-kegiatan.index', compact('activityCategory', 'categories'));
    }

    public function update(Request $request, ActivityCategory $activityCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $activityCategory->update($validated);

        return redirect()->route('admin.kategori-kegiatan.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(ActivityCategory $activityCategory)
    {
        $activityCategory->delete();

        return redirect()->route('admin.kategori-kegiatan.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
