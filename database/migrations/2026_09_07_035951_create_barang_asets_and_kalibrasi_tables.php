<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang_asets', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_aset', ['alkes', 'non_alkes'])->default('alkes');
            $table->string('kode_barang')->nullable();
            $table->string('nama_barang');
            $table->string('merk')->nullable();
            $table->string('tipe')->nullable();
            $table->string('no_seri')->nullable();
            $table->year('tahun_pembelian')->nullable();
            $table->string('no_izin_edar')->nullable();
            $table->year('tahun_pengadaan')->nullable();
            
            $table->decimal('harga_beli', 15, 2)->nullable();
            $table->string('distributor')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('gambar')->nullable();

            // Foreign Keys
            $table->foreignId('kondisi_id')->nullable()->constrained('kondisis')->nullOnDelete();
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->foreignId('ruang_id')->nullable()->constrained('ruangs')->nullOnDelete();
            $table->foreignId('status_produk_id')->nullable()->constrained('status_produks')->nullOnDelete();
            $table->foreignId('sumber_dana_id')->nullable()->constrained('sumber_danas')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('kalibrasi_alkes');
        Schema::dropIfExists('barang_asets');
    }
};