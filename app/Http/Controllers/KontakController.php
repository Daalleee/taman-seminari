<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Message;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $contact = Contact::first();

        return view('public.kontak.index', compact('contact'));
    }

    public function kirim(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Message::create($validated);

        return redirect()->route('public.kontak')->with('success', 'Pesan berhasil dikirim. Kami akan menghubungi Anda segera.');
    }
}
