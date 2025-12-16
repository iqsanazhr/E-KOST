<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kost;
use App\Models\Facility;

class PatchDataSeeder extends Seeder
{
    public function run()
    {
        // 1. Ensure Facilities exist
        if (Facility::count() == 0) {
            $this->call(FacilitySeeder::class);
        }

        // 2. Fix the first Kost
        $kost = Kost::first();
        if ($kost) {
            $kost->update([
                'alamat' => 'Jl. Merdeka No. 45, Purwokerto',
                'deskripsi' => $kost->deskripsi ?? 'Deskripsi kost yang nyaman dan aman.',
            ]);

            // Attach facilities if not attached
            if ($kost->facilities()->count() == 0) {
                $facilities = Facility::limit(3)->pluck('id');
                $kost->facilities()->syncWithoutDetaching($facilities);
            }
        }
    }
}
