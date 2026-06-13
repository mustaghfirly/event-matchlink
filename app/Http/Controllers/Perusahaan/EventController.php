<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    public function show(Event $event)
    {
        return view('perusahaan.events.show', compact('event'));
    }
}
