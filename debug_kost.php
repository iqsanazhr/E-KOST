<?php
$k = App\Models\Kost::where('nama_kost', 'like', '%Bayu%')->first();
if ($k) {
    echo "Found Kost: " . $k->nama_kost . " (ID: " . $k->id . ")\n";
    echo "Alamat: " . ($k->alamat ?? 'NULL') . "\n";
    echo "Facilities Count: " . $k->facilities()->count() . "\n";
    foreach ($k->facilities as $f) {
        echo "- " . $f->nama_fasilitas . "\n";
    }
} else {
    echo "Kost Bayu NOT FOUND.\n";
    echo "Total Kosts: " . App\Models\Kost::count() . "\n";
    foreach (App\Models\Kost::all() as $allK) {
        echo "- " . $allK->nama_kost . "\n";
    }
}
