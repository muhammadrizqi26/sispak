<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangAset extends Model
{
    protected $guarded = ['id'];

    public function unit() { return $this->belongsTo(Unit::class); }
    public function ruang() { return $this->belongsTo(Ruang::class); }
    public function sumberDana() { return $this->belongsTo(SumberDana::class); }
    public function statusProduk() { return $this->belongsTo(StatusProduk::class); }
    public function kondisi() { return $this->belongsTo(Kondisi::class); }
    public function creator() { return $this->belongsTo(User::class, 'created_by'); }
    public function kalibrasi() { return $this->hasMany(KalibrasiAlkes::class); }
}