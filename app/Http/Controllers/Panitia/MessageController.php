<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Sponsorship;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return view('panitia.messages.index', [
                'sponsorships' => collect(),
                'unreadCount' => 0,
            ]);
        }

        $sponsorships = Sponsorship::whereHas('event', function ($q) {
            $q->where('user_id', Auth::id());
        })
        ->where('status', 'accepted')
        ->with(['event', 'company'])
        ->latest()
        ->get();

        $unreadCount = Message::whereIn('sponsorship_id', $sponsorships->pluck('id'))
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return view('panitia.messages.index', compact('sponsorships', 'unreadCount'));
    }

    public function show(Sponsorship $sponsorship)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if ($sponsorship->event->user_id !== Auth::id()) {
            abort(403);
        }

        if ($sponsorship->status !== 'accepted') {
            return redirect()->route('panitia.messages.index')
                ->with('error', 'Sponsorship belum diterima');
        }

        Message::where('sponsorship_id', $sponsorship->id)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = Message::where('sponsorship_id', $sponsorship->id)
            ->with('sender')
            ->oldest()
            ->get();

        return view('panitia.messages.show', compact('sponsorship', 'messages'));
    }

    public function store(Request $request, Sponsorship $sponsorship)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if ($sponsorship->event->user_id !== Auth::id()) {
            abort(403);
        }

        if ($sponsorship->status !== 'accepted') {
            return redirect()->route('panitia.messages.index')
                ->with('error', 'Sponsorship belum diterima');
        }

        $request->validate([
            'message' => 'required',
        ]);

        $receiverId = $sponsorship->company->user_id;

        Message::create([
            'sponsorship_id' => $sponsorship->id,
            'sender_id'      => Auth::id(),
            'receiver_id'    => $receiverId,
            'message'        => $request->message,
            'is_read'        => false,
        ]);

        return redirect()
            ->route('panitia.messages.show', $sponsorship)
            ->with('success', 'Pesan terkirim');
    }
}
