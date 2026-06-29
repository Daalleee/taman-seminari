<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Album;
use App\Models\Message;
use App\Models\News;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalBerita   = News::count();
        $totalKegiatan = Activity::count();
        $totalAlbum    = Album::count();
        $totalPesan    = Message::count();

        return view('admin.dashboard.index', compact(
            'totalBerita',
            'totalKegiatan',
            'totalAlbum',
            'totalPesan',
        ));
    }
}
