<?php
use App\Models\User;
use App\Models\Kost;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Users:\n";
foreach (User::all() as $user) {
    echo "ID: {$user->id}, Name: {$user->name}, Email: {$user->email}, Role: {$user->role}\n";
}

echo "\nKosts:\n";
foreach (Kost::all() as $kost) {
    echo "ID: {$kost->id}, Name: {$kost->nama_kost}, Owner ID: {$kost->user_id}\n";
}
