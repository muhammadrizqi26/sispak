<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kondisi extends Model
{
    protected $guarded = ['id'];

    public function barangAsets()
    {
        return $this->hasMany(BarangAset::class, 'kondisi_id');
    }
}