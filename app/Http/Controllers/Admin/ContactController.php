<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::first();

        if (!$contact) {
            $contact = Contact::create([
                'address' => '',
                'phone' => '',
                'email' => '',
                'maps' => '',
                'facebook' => '',
                'instagram' => '',
                'youtube' => '',
            ]);
        }

        $kontak = $contact;
        return view('admin.kontak.index', compact('kontak'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'maps' => 'nullable|string',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
        ]);

        $contact = Contact::first();

        if ($contact) {
            $contact->update($validated);
        } else {
            Contact::create($validated);
        }

        return redirect()->route('admin.kontak')->with('success', 'Kontak berhasil diperbarui.');
    }
}
