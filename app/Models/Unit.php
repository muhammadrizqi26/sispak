<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $guarded = ['id'];

    // Tambahkan relasi ini
    public function barangAsets()
    {
        return $this->hasMany(BarangAset::class, 'unit_id');
    }
}