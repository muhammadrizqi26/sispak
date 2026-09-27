<?php

namespace App\Http\Controllers\Pemeliharaan;

use App\Http\Controllers\Controller;
use App\Models\PanelListrik;
use App\Models\Unit;
use App\Models\Ruang;
use Carbon\Carbon;
use App\Models\Kondisi;
use Illuminate\Http\Request;

class PanelListrikController extends Controller
{
    public function index(Request $request)
    {
        $query = PanelListrik::with(['unit', 'ruang', 'kondisi']);

        if ($request->filled('search')) {
            $query->where('nama_panel', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_panel', 'like', '%' . $request->search . '%');
        }

        $panels = $query->paginate(10);

        // 2. Tambahkan logika penghitungan jadwal jatuh tempo
        $today = Carbon::today();
        
        // Menghitung berapa panel yang jadwal_berikutnya kurang dari atau sama dengan hari ini
        $warningCount = PanelListrik::whereDate('jadwal_berikutnya', '<=', $today)->count();

        // 3. Kirim variabel $warningCount dan $today ke View
        return view('pemeliharaan.panel_listrik.index', compact('panels', 'warningCount', 'today'));
    }

    public function create()
    {
        $units = Unit::all();
        $ruangs = Ruang::all();
        $kondisis = Kondisi::all();

        return view('pemeliharaan.panel_listrik.create', compact('units', 'ruangs', 'kondisis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_panel' => 'required',
            'tanggal_pemeliharaan' => 'required|date',
            'petugas' => 'required',
        ]);

        PanelListrik::create($request->all());

        return redirect()->route('panel-listrik.index')->with('success', 'Data Pemeliharaan Panel Listrik berhasil ditambahkan!');
    }
}