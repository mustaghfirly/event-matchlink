<!DOCTYPE html>
<html>
<head>
    <title>Tambah Event</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Tambah Event</h2>

    <form action="{{ route('events.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Event</label>
            <input type="text" name="nama_event" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label>Target Dana</label>
            <input type="number" name="target_dana" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Event</label>
            <input type="date" name="tanggal_event" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan Event
        </button>

        <a href="/events" class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

</body>
</html>