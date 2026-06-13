<?php

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== USERS ===\n";
$users = \App\Models\User::all();
foreach ($users as $u) {
    echo $u->id . ' | ' . $u->name . ' | ' . $u->email . ' | ' . $u->role . ' | company_id: ' . ($u->company?->id ?? '-') . "\n";
}

echo "\n=== COMPANIES ===\n";
$companies = \App\Models\Company::all();
foreach ($companies as $c) {
    echo $c->id . ' | ' . $c->nama_perusahaan . ' | user_id: ' . $c->user_id . "\n";
}

echo "\n=== SPONSORSHIPS ===\n";
$sps = \App\Models\Sponsorship::all();
foreach ($sps as $sp) {
    echo $sp->id . ' | event_id: ' . $sp->event_id . ' | company_id: ' . $sp->company_id . ' | status: ' . $sp->status . "\n";
}
