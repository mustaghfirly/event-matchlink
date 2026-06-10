<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Tampilkan daftar event milik panitia.
     */
    public function index()
    {
        $events = Event::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('panitia.events.index', compact('events'));
    }

    /**
     * Form tambah event.
     */
    public function create()
    {
        return view('panitia.events.create');
    }

    /**
     * Simpan event baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_event' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'target_dana' => 'required|numeric',
            'tanggal_event' => 'required|date',
            'lokasi' => 'required',
        ]);

        Event::create([
            'user_id' => Auth::id(),
            'nama_event' => $request->nama_event,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'target_dana' => $request->target_dana,
            'tanggal_event' => $request->tanggal_event,
            'lokasi' => $request->lokasi,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('events.index')
            ->with('success', 'Event berhasil dibuat');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
           $event = Event::findOrFail($id);

    return view('panitia.events.edit', compact('event'));
    }

    public function update(Request $request, string $id)
    {
       $event = Event::findOrFail($id);

    $request->validate([
        'nama_event' => 'required',
        'kategori' => 'required',
        'deskripsi' => 'required',
        'target_dana' => 'required|numeric',
        'tanggal_event' => 'required|date',
        'lokasi' => 'required',
    ]);

    $event->update([
        'nama_event' => $request->nama_event,
        'kategori' => $request->kategori,
        'deskripsi' => $request->deskripsi,
        'target_dana' => $request->target_dana,
        'tanggal_event' => $request->tanggal_event,
        'lokasi' => $request->lokasi,
    ]);

    return redirect()
        ->route('events.index')
        ->with('success', 'Event berhasil diupdate');
    }

    public function destroy(string $id)
    {
         $event = Event::findOrFail($id);

    $event->delete();

    return redirect()
        ->route('events.index')
        ->with('success', 'Event berhasil dihapus');
    }
    
}