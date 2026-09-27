<?php

namespace App\Http\Controllers;

use App\Models\BarangAset;
use App\Models\Unit;
use App\Models\Ruang;
use App\Models\SumberDana;
use App\Models\StatusProduk;
use App\Models\Kondisi;
use Illuminate\Http\Request;

class NonAlkesController extends Controller
{
    public function index(Request $request)
    {
        $query = BarangAset::with(['unit', 'ruang', 'kondisi', 'creator'])
            ->where('jenis_aset', 'non_alkes');

        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
        }

        $nonAlkes = $query->paginate(10);
        return view('non_alkes.index', compact('nonAlkes'));
    }

        public function create()
    {
        $kondisis = Kondisi::all();
        $units = Unit::all();
        $ruangs = Ruang::all();
        $statusProduks = StatusProduk::all();
        $sumberDanas = SumberDana::all();

        return view('non_alkes.create', compact('kondisis', 'units', 'ruangs', 'statusProduks', 'sumberDanas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kondisi_id' => 'required',
        ]);

        $data = $request->all();
        $data['jenis_aset'] = 'non_alkes'; // Pembeda jenis aset
        $data['created_by'] = auth()->id() ?? 1;

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('non_alkes', 'public');
        }

        BarangAset::create($data);

        return redirect()->route('non-alkes.index')->with('success', 'Data Non-Alkes berhasil ditambahkan!');
    }

    public function export()
{
    $fileName = 'data-non-alkes-' . date('Y-m-d') . '.csv';
    $nonAlkes = BarangAset::with(['unit', 'ruang', 'kondisi', 'sumberDana', 'statusProduk'])
        ->where('jenis_aset', 'non_alkes')
        ->get();

    $headers = [
        "Content-type"        => "text/csv; charset=UTF-8",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    ];

    $columns = ['Kode Alat', 'Nama Alat', 'Merk', 'Tipe', 'No Seri', 'Tahun Pengadaan', 'Kondisi', 'Unit', 'Ruang', 'Keterangan'];

    $callback = function() use($nonAlkes, $columns) {
        $file = fopen('php://output', 'w');
        fputs($file, "\xEF\xBB\xBF");
        fputcsv($file, $columns);

        foreach ($nonAlkes as $item) {
            fputcsv($file, [
                $item->kode_barang ?? '-',
                $item->nama_barang,
                $item->merk ?? '-',
                $item->tipe ?? '-',
                $item->no_seri ?? '-',
                $item->tahun_pengadaan ?? '-',
                $item->kondisi->nama_kondisi ?? '-',
                $item->unit->nama_unit ?? '-',
                $item->ruang->nama_ruang ?? '-',
                $item->keterangan ?? '-'
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
}