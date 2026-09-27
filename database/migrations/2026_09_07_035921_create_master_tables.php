<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('nama_unit');
            $table->enum('is_active', ['Y', 'N'])->default('Y');
            $table->timestamps();
        });

        Schema::create('ruangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ruang');
            $table->enum('is_active', ['Y', 'N'])->default('Y');
            $table->timestamps();
        });

        Schema::create('sumber_danas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sumber_dana');
            $table->enum('is_active', ['Y', 'N'])->default('Y');
            $table->timestamps();
        });

        Schema::create('status_produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_status_produk');
            $table->enum('is_active', ['Y', 'N'])->default('Y');
            $table->timestamps();
        });

        Schema::create('kondisis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kondisi');
            $table->enum('is_active', ['Y', 'N'])->default('Y');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kondisis');
        Schema::dropIfExists('status_produks');
        Schema::dropIfExists('sumber_danas');
        Schema::dropIfExists('ruangs');
        Schema::dropIfExists('units');
    }
};