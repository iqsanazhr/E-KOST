<?php

namespace Database\Seeders;

use App\Models\Kost;
use App\Models\User;
use App\Models\Facility;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
                'no_hp' => '081234567890',
            ]
        );

        $facilities = Facility::all();

        $kosts = [
            [
                'nama_kost' => 'Kost Bahagia',
                'slug' => Str::slug('Kost Bahagia'),
                'tipe' => 'campur',
                'harga_per_bulan' => 1500000,
                'deskripsi' => 'Kost nyaman di pusat kota, dekat dengan kampus dan mall.',
                'alamat_lengkap' => 'Jl. Kebahagiaan No. 123, Jakarta Selatan',
                'kota' => 'Jakarta Selatan',
                'provinsi' => 'DKI Jakarta',
                'status_verifikasi' => 'approved',
            ],
            [
                'nama_kost' => 'Kost Sejahtera',
                'slug' => Str::slug('Kost Sejahtera'),
                'tipe' => 'putra',
                'harga_per_bulan' => 800000,
                'deskripsi' => 'Kost murah meriah untuk mahasiswa, fasilitas lengkap.',
                'alamat_lengkap' => 'Jl. Kesejahteraan No. 45, Jakarta Barat',
                'kota' => 'Jakarta Barat',
                'provinsi' => 'DKI Jakarta',
                'status_verifikasi' => 'approved',
            ],
            [
                'nama_kost' => 'Kost Melati',
                'slug' => Str::slug('Kost Melati'),
                'tipe' => 'putri',
                'harga_per_bulan' => 1200000,
                'deskripsi' => 'Kost khusus putri yang aman dan bersih.',
                'alamat_lengkap' => 'Jl. Melati Indah No. 88, Jakarta Timur',
                'kota' => 'Jakarta Timur',
                'provinsi' => 'DKI Jakarta',
                'status_verifikasi' => 'approved',
            ],
            [
                'nama_kost' => 'Kost Bayu',
                'slug' => Str::slug('Kost Bayu'),
                'tipe' => 'putra',
                'harga_per_bulan' => 900000,
                'deskripsi' => 'Aman dan Nyaman',
                'alamat_lengkap' => 'Jl. Stadion Mini Purwokerto No. 10',
                'kota' => 'Purwokerto',
                'provinsi' => 'Jawa Tengah',
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
            $kost->images()->create([
                'path_foto' => 'kost-images/default.jpg',
                'is_primary' => true,
            ]);
        }
    }
}
