<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Kosts Table
        Schema::create('kosts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pemilik
            $table->string('nama_kost');
            $table->enum('tipe', ['putra', 'putri', 'campur']);
            $table->decimal('harga_per_bulan', 12, 2);
            $table->text('deskripsi');
            $table->text('alamat');
            $table->enum('status_verifikasi', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });

        // Facilities Table
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('nama_fasilitas');
            $table->string('icon')->nullable(); // FontAwesome class or image path
            $table->timestamps();
        });

        // Pivot Table: Kost <-> Facility
        Schema::create('kost_facility', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kost_id')->constrained()->onDelete('cascade');
            $table->foreignId('facility_id')->constrained()->onDelete('cascade');
        });

        // Kost Images Table
        Schema::create('kost_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kost_id')->constrained()->onDelete('cascade');
            $table->string('path_foto');
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kost_images');
        Schema::dropIfExists('kost_facility');
        Schema::dropIfExists('facilities');
        Schema::dropIfExists('kosts');
    }
};
