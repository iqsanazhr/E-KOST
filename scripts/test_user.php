<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

try {
    $user = App\Models\User::first();
    if ($user) {
        echo "User ID: " . $user->id . "\n";
        echo "Class: " . get_class($user) . "\n";
        echo "Role: " . ($user->role ?? 'UNDEFINED') . "\n";

        // Check if role is in attributes
        $attributes = $user->getAttributes();
        if (array_key_exists('role', $attributes)) {
            echo "Role in attributes: YES (" . $attributes['role'] . ")\n";
        } else {
            echo "Role in attributes: NO\n";
        }
    } else {
        echo "No users found.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
