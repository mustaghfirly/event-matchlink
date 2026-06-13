<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('user')->latest()->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    public function approve(Event $event)
    {
        $event->update(['status' => 'approved']);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil disetujui');
    }

    public function reject(Request $request, Event $event)
    {
        $event->update(['status' => 'rejected']);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event ditolak');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil dihapus');
    }
}
