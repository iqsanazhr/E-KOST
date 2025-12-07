<?php
use App\Models\User;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Update Owner (User 6) to Tegar
$owner = User::find(6);
if ($owner) {
    $owner->name = 'Tegar';
    $owner->save();
    echo "User 6 renamed to Tegar.\n";
} else {
    echo "User 6 not found.\n";
}

// Update User 3 (Mahasiswa) to Fadel
$user = User::find(3);
if ($user) {
    $user->name = 'Fadel';
    $user->save();
    echo "User 3 renamed to Fadel.\n";
} else {
    echo "User 3 not found.\n";
}
