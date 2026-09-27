<?php

namespace App\Http\Controllers;

use App\Models\BarangAset;
use App\Models\Unit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data ringkasan widget
        $totalAlkes = BarangAset::where('jenis_aset', 'alkes')->count();
        
        $baik = BarangAset::where('jenis_aset', 'alkes')
            ->whereHas('kondisi', fn($q) => $q->where('nama_kondisi', 'Baik'))
            ->count();
            
        $rusak = BarangAset::where('jenis_aset', 'alkes')
            ->whereHas('kondisi', fn($q) => $q->where('nama_kondisi', 'Rusak'))
            ->count();
            
        $tidakBeroperasi = BarangAset::where('jenis_aset', 'alkes')
            ->whereHas('kondisi', fn($q) => $q->where('nama_kondisi', 'Tidak Beroperasi'))
            ->count();

        // 2. Ambil data untuk Grafik per Unit
        $units = Unit::withCount(['barangAsets' => fn($q) => $q->where('jenis_aset', 'alkes')])->get();
        $chartLabels = $units->pluck('nama_unit');
        $chartData = $units->pluck('barang_asets_count');

        // 3. Kirim data variabel ke view dashboard
        return view('dashboard', compact(
            'totalAlkes', 
            'baik', 
            'rusak', 
            'tidakBeroperasi', 
            'chartLabels', 
            'chartData'
        ));
    }
}