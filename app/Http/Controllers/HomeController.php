<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Profile;
use App\Models\Vision;
use App\Models\Mission;
use App\Models\Activity;
use App\Models\News;
use App\Models\Album;
use App\Models\Contact;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('is_active', true)->orderBy('order')->get();
        $profile = Profile::first();
        $visions = Vision::all();
        $missions = Mission::all();
        $activities = Activity::with('category')
            ->where('status', 'published')
            ->latest()
            ->take(4)
            ->get();
        $news = News::with('category')
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();
        $albums = Album::with('items')->get();
        $contact = Contact::first();

        return view('public.home.index', compact(
            'banners', 'profile', 'visions', 'missions',
            'activities', 'news', 'albums', 'contact'
        ));
    }
}
