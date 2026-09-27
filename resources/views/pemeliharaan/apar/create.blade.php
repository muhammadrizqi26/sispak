<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pengecekan APAR - SISPAK</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 p-6 font-sans">
    <div class="max-w-4xl mx-auto bg-white rounded shadow-md overflow-hidden">
        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700">Form Pengecekan APAR</h3>
            <a href="{{ route('apar.index') }}" class="text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</a>
        </div>

        <form action="{{ route('apar.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kode / No. Tabung APAR</label>
                    <input type="text" name="kode_apar" class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis APAR</label>
                    <select name="jenis_apar" class="w-full bg-white border border-gray-300 rounded px-3 py-2 text-sm">
                        <option value="Powder">Powder</option>
                        <option value="CO2">CO2</option>
                        <option value="Foam">Foam</option>
                        <option value="Clean Agent">Clean Agent</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kapasitas (Kg)</label>
                    <input type="text" name="kapasitas" placeholder="Contoh: 3 Kg" required class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Lokasi Unit</label>
                    <select name="lokasi_unit_id" class="w-full bg-white border border-gray-300 rounded px-3 py-2 text-sm">
                        <option value="">Pilih Unit</option>
                        @foreach($units as $u)
                            <option value="{{ $u->id }}">{{ $u->nama_unit }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Ruang</label>
                    <select name="ruang_id" class="w-full bg-white border border-gray-300 rounded px-3 py-2 text-sm">
                        <option value="">Pilih Ruang</option>
                        @foreach($ruangs as $r)
                            <option value="{{ $r->id }}">{{ $r->nama_ruang }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Indikator Tekanan</label>
                    <select name="tekanan" class="w-full bg-white border border-gray-300 rounded px-3 py-2 text-sm">
                        <option value="Normal">Normal (Hijau)</option>
                        <option value="Red (Low)">Low (Merah/Habis)</option>
                        <option value="Over">Over Pressure</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Pemeriksaan</label>
                    <input type="date" name="tanggal_pemeriksaan" required class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jadwal Pemeriksaan Berikutnya</label>
                    <input type="date" name="jadwal_berikutnya" required class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Petugas Inspeksi</label>
                    <input type="text" name="petugas" required class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kondisi fisik Tabung</label>
                    <select name="kondisi_tabung" class="w-full bg-white border border-gray-300 rounded px-3 py-2 text-sm">
                        <option value="Baik">Baik</option>
                        <option value="Cacat/Karat">Cacat / Karat</option>
                        <option value="Rusak">Rusak / Segel Putus</option>
                    </select>
                </div>
            </div>
            <div class="border-t border-gray-200 pt-4 flex justify-end">
                <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-medium text-sm px-5 py-2.5 rounded shadow">Simpan Data APAR</button>
            </div>
        </form>
    </div>
</body>
</html>