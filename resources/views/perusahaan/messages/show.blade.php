@extends('layouts.tailwind')
@section('title', 'Pesan')
@section('page', 'Pesan - ' . $sponsorship->event->nama_event)

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 flex flex-col h-[600px]"
         x-data="chat(@js($messages), {{ auth()->id() }}, '{{ route("perusahaan.messages.poll", $sponsorship) }}')">

        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-gray-900">{{ $sponsorship->event->nama_event }}</h2>
                <p class="text-xs text-gray-400">{{ $sponsorship->event->user->name }}</p>
            </div>
            <a href="{{ route('perusahaan.messages.index') }}" class="text-sm text-gray-500 hover:text-gray-700 transition">Kembali</a>
        </div>

        <div x-ref="messages" class="flex-1 overflow-y-auto px-6 py-4 space-y-4">
            <template x-for="msg in messages" :key="msg.id">
                <div :class="msg.sender_id === userId ? 'flex justify-end' : 'flex justify-start'">
                    <div :class="msg.sender_id === userId
                        ? 'max-w-[75%] bg-indigo-600 text-white rounded-2xl rounded-br-md'
                        : 'max-w-[75%] bg-gray-100 text-gray-900 rounded-2xl rounded-bl-md'"
                         class="px-4 py-2.5">
                        <p class="text-sm" x-text="msg.message"></p>
                        <p class="text-xs mt-1"
                           :class="msg.sender_id === userId ? 'text-indigo-200' : 'text-gray-400'"
                           x-text="new Date(msg.created_at).toLocaleString('id-ID', { hour: '2-digit', minute: '2-digit', day: 'numeric', month: 'short' })">
                        </p>
                    </div>
                </div>
            </template>
            <div x-show="messages.length === 0" class="text-center py-8 text-gray-400 text-sm">Belum ada pesan.</div>
        </div>

        @auth
        <div class="px-6 py-4 border-t border-gray-100">
            <form method="POST" action="{{ route('perusahaan.messages.store', $sponsorship) }}">
                @csrf
                <div class="flex gap-2">
                    <input type="text" name="message" placeholder="Tulis pesan..." required
                           class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        Kirim
                    </button>
                </div>
            </form>
        </div>
        @endauth
    </div>
</div>

<script>
    function chat(initialMessages, userId, pollUrl) {
        return {
            messages: initialMessages,
            userId: userId,
            pollUrl: pollUrl,
            init() {
                this.$nextTick(() => this.scrollDown());
                setInterval(() => {
                    fetch(this.pollUrl)
                        .then(r => r.json())
                        .then(data => {
                            if (data.length !== this.messages.length) {
                                this.messages = data;
                                this.$nextTick(() => this.scrollDown());
                            }
                        });
                }, 3000);
            },
            scrollDown() {
                const el = this.$refs.messages;
                if (el) el.scrollTop = el.scrollHeight;
            }
        }
    }
</script>
@endsection
