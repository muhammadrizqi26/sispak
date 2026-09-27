<?php

namespace App\Http\Controllers;

use App\Models\BarangAset;
use App\Models\Unit;
use App\Models\Ruang;
use App\Models\SumberDana;
use App\Models\StatusProduk;
use App\Models\Kondisi;
use Illuminate\Http\Request;

class BarangAsetController extends Controller
{
    public function index(Request $request)
    {
        $query = BarangAset::with(['unit', 'ruang', 'kondisi'])->where('jenis_aset', 'alkes');

        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
        }

        $alkes = $query->paginate(10);
        return view('alkes.index', compact('alkes'));
    }

            public function create()
        {
            $kondisis = Kondisi::all();
            $units = Unit::all();
            $ruangs = Ruang::all();
            $statusProduks = StatusProduk::all();
            $sumberDanas = SumberDana::all();

            return view('alkes.create', compact('kondisis', 'units', 'ruangs', 'statusProduks', 'sumberDanas'));
        }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kondisi_id' => 'required',
        ]);

        $data = $request->all();
        $data['jenis_aset'] = 'alkes';
        $data['created_by'] = auth()->id() ?? 1; // Fallback ke user ID 1 jika belum pakai auth

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('alkes', 'public');
        }

        BarangAset::create($data);

        return redirect()->route('alkes.index')->with('success', 'Data Alkes berhasil ditambahkan!');
    }

    public function export()
{
    $fileName = 'data-alkes-' . date('Y-m-d') . '.csv';
    $alkes = BarangAset::with(['unit', 'ruang', 'kondisi', 'sumberDana', 'statusProduk'])
        ->where('jenis_aset', 'alkes')
        ->get();

    $headers = [
        "Content-type"        => "text/csv; charset=UTF-8",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    ];

    $columns = ['Kode Alkes', 'Nama Alkes', 'Merk', 'Tipe', 'No Seri', 'Tahun Pembelian', 'Kondisi', 'Unit', 'Ruang', 'Status Produk', 'Sumber Dana', 'Harga Beli', 'Distributor', 'Keterangan'];

    $callback = function() use($alkes, $columns) {
        $file = fopen('php://output', 'w');
        // Tambahkan BOM agar karakter terbaca sempurna di Microsoft Excel
        fputs($file, "\xEF\xBB\xBF");
        fputcsv($file, $columns);

        foreach ($alkes as $item) {
            fputcsv($file, [
                $item->kode_barang ?? '-',
                $item->nama_barang,
                $item->merk ?? '-',
                $item->tipe ?? '-',
                $item->no_seri ?? '-',
                $item->tahun_pembelian ?? '-',
                $item->kondisi->nama_kondisi ?? '-',
                $item->unit->nama_unit ?? '-',
                $item->ruang->nama_ruang ?? '-',
                $item->statusProduk->nama_status_produk ?? '-',
                $item->sumberDana->nama_sumber_dana ?? '-',
                $item->harga_beli ?? 0,
                $item->distributor ?? '-',
                $item->keterangan ?? '-'
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
}