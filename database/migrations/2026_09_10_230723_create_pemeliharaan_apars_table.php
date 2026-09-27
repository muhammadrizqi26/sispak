<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemeliharaan_apars', function (Blueprint $table) {
            $table->id();
            $table->string('kode_apar')->nullable();
            $table->enum('jenis_apar', ['Powder', 'CO2', 'Foam', 'Clean Agent'])->default('Powder');
            $table->string('kapasitas'); // Contoh: 3 Kg, 6 Kg
            $table->foreignId('lokasi_unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->foreignId('ruang_id')->nullable()->constrained('ruangs')->nullOnDelete();
            $table->date('tanggal_pemeriksaan');
            $table->date('jadwal_berikutnya');
            $table->enum('tekanan', ['Normal', 'Red (Low)', 'Over'])->default('Normal');
            $table->enum('kondisi_tabung', ['Baik', 'Cacat/Karat', 'Rusak'])->default('Baik');
            $table->string('petugas');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemeliharaan_apars');
    }
};