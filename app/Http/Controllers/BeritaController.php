<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $categories = NewsCategory::all();

        $newsList = News::with('category')
            ->where('status', 'published')
            ->when($request->category_id, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('public.berita.index', compact('newsList', 'categories'));
    }

    public function show($slug)
    {
        $news = News::with('category')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('public.berita.show', compact('news'));
    }
}
