<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::first();

        if (!$profile) {
            $profile = Profile::create([
                'name' => '',
                'history' => '',
                'description' => '',
                'goal' => '',
                'motto' => '',
            ]);
        }

        $profil = $profile;
        return view('admin.profil.index', compact('profil'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'history' => 'nullable|string',
            'description' => 'nullable|string',
            'goal' => 'nullable|string',
            'motto' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $profile = Profile::first();

        if (!$profile) {
            $profile = Profile::create($validated);
        } else {
            if ($request->hasFile('logo')) {
                $validated['logo'] = $request->file('logo')->store('profile', 'public');
            } else {
                unset($validated['logo']);
            }

            if ($request->hasFile('cover')) {
                $validated['cover'] = $request->file('cover')->store('profile', 'public');
            } else {
                unset($validated['cover']);
            }

            $profile->update($validated);
        }

        return redirect()->route('admin.profil')->with('success', 'Profile berhasil diperbarui.');
    }
}
