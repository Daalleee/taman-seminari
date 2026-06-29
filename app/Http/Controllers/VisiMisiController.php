<?php

namespace App\Http\Controllers;

use App\Models\Vision;
use App\Models\Mission;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visions = Vision::all();
        $missions = Mission::all();

        return view('public.visi-misi.index', compact('visions', 'missions'));
    }
}
