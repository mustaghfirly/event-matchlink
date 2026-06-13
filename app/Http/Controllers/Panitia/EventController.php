<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return view('panitia.events.index', ['events' => collect()]);
        }

        $events = Event::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('panitia.events.index', compact('events'));
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        return view('panitia.events.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $request->validate([
            'nama_event'     => 'required',
            'kategori'       => 'required',
            'deskripsi'      => 'required',
            'target_dana'    => 'required|numeric',
            'tanggal_event'  => 'required|date',
            'lokasi'         => 'required',
            'proposal'       => 'nullable|mimes:pdf|max:5120',
        ]);

        $proposalPath = null;

        if ($request->hasFile('proposal')) {
            $proposalPath = $request->file('proposal')
                ->store('proposals', 'public');
        }

        Event::create([
            'user_id'        => Auth::id(),
            'nama_event'     => $request->nama_event,
            'kategori'       => $request->kategori,
            'deskripsi'      => $request->deskripsi,
            'proposal'       => $proposalPath,
            'target_dana'    => $request->target_dana,
            'tanggal_event'  => $request->tanggal_event,
            'lokasi'         => $request->lokasi,
            'status'         => 'pending',
        ]);

        return redirect()
            ->route('events.index')
            ->with('success', 'Event berhasil dibuat');
    }

    public function show(string $id)
    {
        $event = Event::findOrFail($id);

        return view('panitia.events.show', compact('event'));
    }

    public function edit(string $id)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $event = Event::findOrFail($id);

        return view('panitia.events.edit', compact('event'));
    }

    public function update(Request $request, string $id)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $event = Event::findOrFail($id);

        $request->validate([
            'nama_event'     => 'required',
            'kategori'       => 'required',
            'deskripsi'      => 'required',
            'target_dana'    => 'required|numeric',
            'tanggal_event'  => 'required|date',
            'lokasi'         => 'required',
            'proposal'       => 'nullable|mimes:pdf|max:5120',
        ]);

        $proposalPath = $event->proposal;

        if ($request->hasFile('proposal')) {
            $proposalPath = $request->file('proposal')
                ->store('proposals', 'public');
        }

        $event->update([
            'nama_event'     => $request->nama_event,
            'kategori'       => $request->kategori,
            'deskripsi'      => $request->deskripsi,
            'proposal'       => $proposalPath,
            'target_dana'    => $request->target_dana,
            'tanggal_event'  => $request->tanggal_event,
            'lokasi'         => $request->lokasi,
        ]);

        return redirect()
            ->route('events.index')
            ->with('success', 'Event berhasil diupdate');
    }

    public function destroy(string $id)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $event = Event::findOrFail($id);

        $event->delete();

        return redirect()
            ->route('events.index')
            ->with('success', 'Event berhasil dihapus');
    }
}
