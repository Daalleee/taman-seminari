<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function index()
    {
        $missions = Mission::all();
        $visions = \App\Models\Vision::all();

        return view('admin.visi-misi.index', compact('missions', 'visions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mission' => 'required|string',
        ]);

        Mission::create($validated);

        return redirect()->route('admin.visi-misi')->with('success', 'Misi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'mission' => 'required|string',
        ]);

        Mission::findOrFail($id)->update($validated);

        return redirect()->route('admin.visi-misi')->with('success', 'Misi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Mission::findOrFail($id)->delete();

        return redirect()->route('admin.visi-misi')->with('success', 'Misi berhasil dihapus.');
    }
}
