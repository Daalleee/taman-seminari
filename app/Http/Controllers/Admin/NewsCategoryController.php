<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsCategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = NewsCategory::query()
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('admin.kategori-berita.index', compact('categories'));
    }

    public function create()
    {
        $categories = NewsCategory::paginate(10);

        return view('admin.kategori-berita.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        NewsCategory::create($validated);

        return redirect()->route('admin.kategori-berita.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(NewsCategory $newsCategory)
    {
        $categories = NewsCategory::paginate(10);

        return view('admin.kategori-berita.index', compact('newsCategory', 'categories'));
    }

    public function update(Request $request, NewsCategory $newsCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $newsCategory->update($validated);

        return redirect()->route('admin.kategori-berita.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(NewsCategory $newsCategory)
    {
        $newsCategory->delete();

        return redirect()->route('admin.kategori-berita.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
