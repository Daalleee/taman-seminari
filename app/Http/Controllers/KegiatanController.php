<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityCategory;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $categories = ActivityCategory::all();

        $activities = Activity::with('category')
            ->where('status', 'published')
            ->when($request->category_id, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('public.kegiatan.index', compact('activities', 'categories'));
    }

    public function show($slug)
    {
        $activity = Activity::with('category')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('public.kegiatan.show', compact('activity'));
    }
}
