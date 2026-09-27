<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('panel_listriks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_panel')->nullable();
            $table->string('nama_panel');
            $table->foreignId('lokasi_unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->foreignId('ruang_id')->nullable()->constrained('ruangs')->nullOnDelete();
            $table->date('tanggal_pemeliharaan');
            $table->date('jadwal_berikutnya')->nullable();
            $table->string('petugas');
            $table->foreignId('kondisi_id')->nullable()->constrained('kondisis')->nullOnDelete();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('panel_listriks');
    }
};