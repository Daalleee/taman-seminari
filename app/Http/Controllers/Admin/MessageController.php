<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('subject', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.pesan.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);

        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        $messages = Message::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.pesan.index', compact('messages', 'message'));
    }

    public function destroy($id)
    {
        Message::findOrFail($id)->delete();

        return redirect()->route('admin.pesan.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
