<?php
$k = App\Models\Kost::where('nama_kost', 'like', '%Bayu%')->first();
if ($k) {
    $k->alamat = 'Jl. Stadion Mini Purwokerto No. 10';
    $k->save();

    // Attach facilities if empty
    if ($k->facilities()->count() == 0) {
        $facilities = App\Models\Facility::all();
        if ($facilities->count() > 0) {
            $k->facilities()->attach($facilities->random(min(3, $facilities->count()))->pluck('id'));
        }
    }
    echo "Fixed Kost Bayu.\n";
} else {
    echo "Kost Bayu NOT FOUND for fixing.\n";
}
