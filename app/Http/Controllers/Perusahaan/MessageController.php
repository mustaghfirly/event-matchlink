<?php

namespace App\Http\Controllers\Perusahaan;

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
            return view('perusahaan.messages.index', [
                'sponsorships' => collect(),
                'unreadCount' => 0,
            ]);
        }

        $company = Auth::user()->company;

        if (!$company) {
            return redirect()->route('perusahaan.company.create');
        }

        $sponsorshipIds = Sponsorship::where('company_id', $company->id)
            ->where('status', 'accepted')
            ->pluck('id');

        $unreadCount = Message::whereIn('sponsorship_id', $sponsorshipIds)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->count();

        $sponsorships = Sponsorship::whereIn('id', $sponsorshipIds)
            ->with(['event', 'company'])
            ->latest()
            ->paginate(10);

        $unreadCount = Message::whereIn('sponsorship_id', $sponsorships->pluck('id'))
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return view('perusahaan.messages.index', compact('sponsorships', 'unreadCount'));
    }

    public function show(Sponsorship $sponsorship)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $company = Auth::user()->company;

        if (!$company || $sponsorship->company_id !== $company->id) {
            abort(403);
        }

        if ($sponsorship->status !== 'accepted') {
            return redirect()->route('perusahaan.messages.index')
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

        return view('perusahaan.messages.show', compact('sponsorship', 'messages'));
    }

    public function poll(Sponsorship $sponsorship)
    {
        if (!Auth::check()) {
            abort(403);
        }

        $company = Auth::user()->company;
        if (!$company || $sponsorship->company_id !== $company->id) {
            abort(403);
        }

        $messages = Message::where('sponsorship_id', $sponsorship->id)
            ->with('sender:id,name')
            ->oldest()
            ->get();

        return response()->json($messages);
    }

    public function store(Request $request, Sponsorship $sponsorship)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $company = Auth::user()->company;

        if (!$company || $sponsorship->company_id !== $company->id) {
            abort(403);
        }

        if ($sponsorship->status !== 'accepted') {
            return redirect()->route('perusahaan.messages.index')
                ->with('error', 'Sponsorship belum diterima');
        }

        $request->validate([
            'message' => 'required',
        ]);

        $receiverId = $sponsorship->event->user_id;

        Message::create([
            'sponsorship_id' => $sponsorship->id,
            'sender_id'      => Auth::id(),
            'receiver_id'    => $receiverId,
            'message'        => $request->message,
            'is_read'        => false,
        ]);

        return redirect()
            ->route('perusahaan.messages.show', $sponsorship)
            ->with('success', 'Pesan terkirim');
    }
}
