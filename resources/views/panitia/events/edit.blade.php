<!DOCTYPE html>
<html>
<head>
    <title>Edit Event</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Edit Event</h2>

    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Event</label>
            <input type="text"
                   name="nama_event"
                   class="form-control"
                   value="{{ $event->nama_event }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <input type="text"
                   name="kategori"
                   class="form-control"
                   value="{{ $event->kategori }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi"
                      class="form-control"
                      rows="4"
                      required>{{ $event->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label>Target Dana</label>
            <input type="number"
                   name="target_dana"
                   class="form-control"
                   value="{{ $event->target_dana }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Tanggal Event</label>
            <input type="date"
                   name="tanggal_event"
                   class="form-control"
                   value="{{ $event->tanggal_event }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text"
                   name="lokasi"
                   class="form-control"
                   value="{{ $event->lokasi }}"
                   required>
        </div>

        <button type="submit" class="btn btn-warning">
            Update Event
        </button>

        <a href="{{ route('events.index') }}" class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

</body>
</html>