<?php

namespace Database\Seeders;

use App\Models\Kost;
use App\Models\User;
use App\Models\Facility;
use Illuminate\Database\Seeder;

class KostSeeder extends Seeder
{
    public function run()
    {
        // Ensure we have an owner
        $owner = User::firstOrCreate(
            ['email' => 'owner@example.com'],
            [
                'name' => 'Owner Demo',
                'password' => bcrypt('password'),
                'role' => 'pemilik',
                'phone' => '081234567890',
            ]
        );

        $facilities = Facility::all();

        $kosts = [
            [
                'nama_kost' => 'Kost Bahagia',
                'tipe' => 'campur',
                'harga_per_bulan' => 1500000,
                'deskripsi' => 'Kost nyaman di pusat kota, dekat dengan kampus dan mall.',
                'alamat' => 'Jl. Kebahagiaan No. 123, Jakarta Selatan',
                'status_verifikasi' => 'approved',
            ],
            [
                'nama_kost' => 'Kost Sejahtera',
                'tipe' => 'putra',
                'harga_per_bulan' => 800000,
                'deskripsi' => 'Kost murah meriah untuk mahasiswa, fasilitas lengkap.',
                'alamat' => 'Jl. Kesejahteraan No. 45, Jakarta Barat',
                'status_verifikasi' => 'approved',
            ],
            [
                'nama_kost' => 'Kost Melati',
                'tipe' => 'putri',
                'harga_per_bulan' => 1200000,
                'deskripsi' => 'Kost khusus putri yang aman dan bersih.',
                'alamat' => 'Jl. Melati Indah No. 88, Jakarta Timur',
                'status_verifikasi' => 'approved',
            ],
            [
                'nama_kost' => 'Kost Bayu',
                'tipe' => 'putra',
                'harga_per_bulan' => 900000,
                'deskripsi' => 'Aman dan Nyaman',
                'alamat' => 'Jl. Stadion Mini Purwokerto No. 10',
                'status_verifikasi' => 'approved',
            ],
        ];

        foreach ($kosts as $data) {
            $kost = $owner->kosts()->create($data);

            // Attach random facilities (1 to 3 facilities)
            if ($facilities->count() > 0) {
                $kost->facilities()->attach(
                    $facilities->random(rand(1, min(3, $facilities->count())))->pluck('id')->toArray()
                );
            }

            // Add dummy image (optional, if you have a way to handle it, otherwise skip or use placeholder)
            /*
             $kost->images()->create([
                'path_foto' => 'kost-images/default.jpg', // Ensure this file exists or logic handles missing files
                'is_primary' => true,
            ]);
            */
        }
    }
}
