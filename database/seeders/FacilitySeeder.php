<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    public function run()
    {
        $facilities = [
            [
                'nama_fasilitas' => 'AC',
                'icon' => 'fa-snowflake', // Example icon class
            ],
            [
                'nama_fasilitas' => 'Kamar Mandi Dalam',
                'icon' => 'fa-bath', // Example icon class
            ],
            [
                'nama_fasilitas' => 'WiFi',
                'icon' => 'fa-wifi',
            ],
            [
                'nama_fasilitas' => 'Kasur',
                'icon' => 'fa-bed',
            ],
            [
                'nama_fasilitas' => 'Lemari',
                'icon' => 'fa-door-closed',
            ],
        ];

        foreach ($facilities as $facility) {
            Facility::create($facility);
        }
    }
}
