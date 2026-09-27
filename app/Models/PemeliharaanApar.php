<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemeliharaanApar extends Model
{
    protected $guarded = ['id'];

    public function unit() { return $this->belongsTo(Unit::class, 'lokasi_unit_id'); }
    public function ruang() { return $this->belongsTo(Ruang::class); }
}