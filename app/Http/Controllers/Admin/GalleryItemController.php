<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\GalleryItem;
use Illuminate\Http\Request;

class GalleryItemController extends Controller
{
    public function index(Request $request)
    {
        $galleries = GalleryItem::with('album')
            ->when($request->search, function ($query, $search) {
                $query->where('caption', 'like', "%{$search}%");
            })
            ->when($request->album_id, function ($query, $albumId) {
                $query->where('album_id', $albumId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $albums = Album::all();

        return view('admin.galeri.index', compact('galleries', 'albums'));
    }

    public function create()
    {
        return redirect()->route('admin.galeri.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'album_id' => 'required|exists:albums,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        GalleryItem::create($validated);

        return redirect()->route('admin.galeri.index')->with('success', 'Gambar berhasil ditambahkan.');
    }

    public function edit(GalleryItem $galleryItem)
    {
        return redirect()->route('admin.galeri.index');
    }

    public function update(Request $request, GalleryItem $galleryItem)
    {
        $validated = $request->validate([
            'album_id' => 'required|exists:albums,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        } else {
            unset($validated['image']);
        }

        $galleryItem->update($validated);

        return redirect()->route('admin.galeri.index')->with('success', 'Gambar berhasil diperbarui.');
    }

    public function destroy(GalleryItem $galleryItem)
    {
        $galleryItem->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Gambar berhasil dihapus.');
    }
}
