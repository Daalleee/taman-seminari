<?php

namespace App\Http\Controllers;

use App\Models\Album;

class GaleriController extends Controller
{
    public function index()
    {
        $albums = Album::with('items')->orderBy('created_at', 'desc')->get();

        return view('public.galeri.index', compact('albums'));
    }
}
