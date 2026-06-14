<?php

namespace App\Http\Controllers;

use App\Models\Sponsorship;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function unread()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0, 'items' => []]);
        }

        $user = Auth::user();
        $count = 0;
        $items = [];

        if ($user->role === 'perusahaan') {
            $company = $user->company;
            if ($company) {
                $pending = Sponsorship::where('company_id', $company->id)
                    ->where('status', 'pending')
                    ->with('event.user')
                    ->latest()
                    ->get();

                foreach ($pending as $s) {
                    $items[] = [
                        'icon' => '💰',
                        'text' => "Pengajuan dari {$s->event->user->name} untuk {$s->event->nama_event}",
                        'url' => route('perusahaan.sponsorships.index'),
                        'time' => $s->created_at->diffForHumans(),
                    ];
                }
                $count += $pending->count();
            }
        }

        if ($user->role === 'panitia') {
            $responded = Sponsorship::whereHas('event', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->whereIn('status', ['accepted', 'rejected'])
                ->with('event', 'company')
                ->latest()
                ->take(10)
                ->get();

            foreach ($responded as $s) {
                $label = $s->status === 'accepted' ? 'Diterima' : 'Ditolak';
                $items[] = [
                    'icon' => $s->status === 'accepted' ? '✅' : '❌',
                    'text' => "Sponsorship {$s->event->nama_event} oleh {$s->company->nama_perusahaan} $label",
                    'url' => route('panitia.sponsorships.index'),
                    'time' => $s->updated_at->diffForHumans(),
                ];
            }
            $count += $responded->count();
        }

        $unread = Message::where('receiver_id', $user->id)
            ->where('is_read', false)
            ->count();
        if ($unread > 0) {
            $items[] = [
                'icon' => '💬',
                'text' => "$unread pesan belum dibaca",
                'url' => $user->role === 'panitia' ? route('panitia.messages.index') : route('perusahaan.messages.index'),
                'time' => 'Baru',
            ];
        }
        $count += $unread;

        return response()->json([
            'count' => $count,
            'items' => array_slice($items, 0, 10),
        ]);
    }
}
