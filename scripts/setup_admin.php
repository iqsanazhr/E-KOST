<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Admin User Setup ---\n";

// Cek apakah user admin default sudah ada
$admin = User::where('email', 'admin@test.com')->first();

if ($admin) {
    echo "User admin default ditemukan:\n";
    echo "Email: admin@test.com\n";
    echo "Password: password\n";
    echo "Role: " . $admin->role . "\n";
} else {
    echo "Membuat user admin default...\n";
    $admin = User::create([
        'name' => 'Admin E-Kost',
        'email' => 'admin@test.com',
        'password' => Hash::make('password'),
        'role' => 'admin',
    ]);
    echo "User admin berhasil dibuat!\n";
    echo "Email: admin@test.com\n";
    echo "Password: password\n";
}

echo "\n--- Opsi Lain ---\n";
echo "Jika Anda ingin mengubah user lain menjadi admin, silakan edit database atau gunakan tinker.\n";
