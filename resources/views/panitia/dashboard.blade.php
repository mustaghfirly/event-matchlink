<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Panitia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h1 class="mb-4">Dashboard Panitia</h1>

    <div class="row mb-4">

        <div class="col-md-6">
            <a href="/events/create" class="btn btn-primary w-100 p-3">
                + Tambah Event
            </a>
        </div>

        <div class="col-md-6">
            <a href="/events" class="btn btn-success w-100 p-3">
                Kelola Event
            </a>
        </div>

    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Total Event</h5>
                    <h2>0</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Pending</h5>
                    <h2>0</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Disetujui</h5>
                    <h2>0</h2>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>