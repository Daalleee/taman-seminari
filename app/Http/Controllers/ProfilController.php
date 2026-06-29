<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Vision;
use App\Models\Mission;

class ProfilController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $visions = Vision::all();
        $missions = Mission::all();

        return view('public.profil.index', compact('profile', 'visions', 'missions'));
    }
}
