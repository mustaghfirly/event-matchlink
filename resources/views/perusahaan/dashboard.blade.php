<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Perusahaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h1 class="mb-4">Dashboard Perusahaan</h1>

    <div class="row">

        @forelse($events as $event)

            <div class="col-md-4 mb-4">

                <div class="card">

                    <div class="card-body">

                        <h5>{{ $event->nama_event }}</h5>

                        <p>
                            <b>Kategori:</b>
                            {{ $event->kategori }}
                        </p>

                        <p>
                            <b>Target Dana:</b>
                            Rp {{ number_format($event->target_dana,0,',','.') }}
                        </p>

                        <p>
                            <b>Lokasi:</b>
                            {{ $event->lokasi }}
                        </p>

                        <p>
                            <b>Status:</b>
                            {{ $event->status }}
                        </p>

                    </div>

                </div>

            </div>

        @empty

            <p>Belum ada event.</p>

        @endforelse

    </div>

</div>


    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-danger">
        Logout
    </button>

</body>
</html>