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

    <table class="table table-bordered table-striped">

        <thead>
            <tr>
                <th>No</th>
                <th>Nama Event</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th>Proposal</th>
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

                <td>
                    @if($event->status == 'pending')
                        <span class="badge bg-warning text-dark">
                            Pending
                        </span>
                    @elseif($event->status == 'approved')
                        <span class="badge bg-success">
                            Approved
                        </span>
                    @else
                        <span class="badge bg-danger">
                            Rejected
                        </span>
                    @endif
                </td>

                <td>
                    @if($event->proposal)
                        <a href="{{ asset('storage/'.$event->proposal) }}"
                           target="_blank"
                           class="btn btn-info btn-sm">
                            Lihat PDF
                        </a>
                    @else
                        -
                    @endif
                </td>

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
                <td colspan="8" class="text-center">
                    Belum ada event
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

</body>
</html>