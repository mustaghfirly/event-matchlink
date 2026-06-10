<!DOCTYPE html>
<html>
<head>
    <title>Daftar Event</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Daftar Event</h2>

    <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">
        + Tambah Event
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>No</th>
                <th>Nama Event</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        @forelse($events as $event)

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $event->nama_event }}</td>
                <td>{{ $event->kategori }}</td>
                <td>{{ $event->tanggal_event }}</td>
                <td>{{ $event->lokasi }}</td>
                <td>{{ $event->status }}</td>
                <td>
                    <a href="{{ route('events.edit', $event->id) }}"
                        class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('events.destroy', $event->id) }}"
                         method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')

                    <button type="submit"
                     class="btn btn-danger btn-sm"
                     onclick="return confirm('Yakin hapus event ini?')">
                     Hapus
                    </button>
                    </form>
            </td>
            </tr>

        @empty

            <tr>
                <td colspan="6" class="text-center">
                    Belum ada event
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

</body>
</html>