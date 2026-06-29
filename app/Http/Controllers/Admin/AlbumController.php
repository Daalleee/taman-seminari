<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index(Request $request)
    {
        $albums = Album::query()
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('admin.album.index', compact('albums'));
    }

    public function create()
    {
        $albums = Album::paginate(10);

        return view('admin.album.index', compact('albums'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('albums', 'public');
        }

        Album::create($validated);

        return redirect()->route('admin.album.index')->with('success', 'Album berhasil ditambahkan.');
    }

    public function edit(Album $album)
    {
        $albums = Album::paginate(10);

        return view('admin.album.index', compact('album', 'albums'));
    }

    public function update(Request $request, Album $album)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('albums', 'public');
        } else {
            unset($validated['cover']);
        }

        $album->update($validated);

        return redirect()->route('admin.album.index')->with('success', 'Album berhasil diperbarui.');
    }

    public function destroy(Album $album)
    {
        $album->delete();

        return redirect()->route('admin.album.index')->with('success', 'Album berhasil dihapus.');
    }
}
