<?php

namespace App\Http\Controllers\Pemeliharaan;

use App\Http\Controllers\Controller;
use App\Models\PemeliharaanApar;
use App\Models\Unit;
use App\Models\Ruang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AparController extends Controller
{
    public function index(Request $request)
    {
        $query = PemeliharaanApar::with(['unit', 'ruang']);

        if ($request->filled('search')) {
            $query->where('kode_apar', 'like', '%' . $request->search . '%')
                  ->orWhere('jenis_apar', 'like', '%' . $request->search . '%');
        }

        $apars = $query->paginate(10);

        // Hitung APAR yang sudah jatuh tempo / perlu diperiksa ulang
        $today = Carbon::today();
        $warningCount = PemeliharaanApar::whereDate('jadwal_berikutnya', '<=', $today)->count();

        return view('pemeliharaan.apar.index', compact('apars', 'warningCount', 'today'));
    }

    public function create()
    {
        $units = Unit::all();
        $ruangs = Ruang::all();
        return view('pemeliharaan.apar.create', compact('units', 'ruangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_apar' => 'required',
            'kapasitas' => 'required',
            'tanggal_pemeriksaan' => 'required|date',
            'jadwal_berikutnya' => 'required|date',
            'petugas' => 'required',
        ]);

        PemeliharaanApar::create($request->all());

        return redirect()->route('apar.index')->with('success', 'Catatan pemeliharaan APAR berhasil disimpan!');
    }
}