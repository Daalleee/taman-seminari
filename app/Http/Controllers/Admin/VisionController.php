<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vision;
use Illuminate\Http\Request;

class VisionController extends Controller
{
    public function index()
    {
        $visions = Vision::all();
        $missions = \App\Models\Mission::all();

        return view('admin.visi-misi.index', compact('visions', 'missions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vision' => 'required|string',
        ]);

        Vision::create($validated);

        return redirect()->route('admin.visi-misi')->with('success', 'Visi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'vision' => 'required|string',
        ]);

        Vision::findOrFail($id)->update($validated);

        return redirect()->route('admin.visi-misi')->with('success', 'Visi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Vision::findOrFail($id)->delete();

        return redirect()->route('admin.visi-misi')->with('success', 'Visi berhasil dihapus.');
    }
}
