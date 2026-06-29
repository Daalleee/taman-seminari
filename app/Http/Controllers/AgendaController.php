<?php

namespace App\Http\Controllers;

use App\Models\Event;

class AgendaController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('event_date', 'desc')->paginate(12);

        return view('public.agenda.index', compact('events'));
    }
}
