<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pemeliharaan Panel Listrik - SISPAK</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 p-6 font-sans">
    <div class="max-w-4xl mx-auto bg-white rounded shadow-md overflow-hidden">
        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700">Form Pemeliharaan Panel Listrik</h3>
            <a href="{{ route('panel-listrik.index') }}" class="text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</a>
        </div>

        <form action="{{ route('panel-listrik.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kode Panel</label>
                    <input type="text" name="kode_panel" class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Panel</label>
                    <input type="text" name="nama_panel" required class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Lokasi Unit</label>
                    <select name="lokasi_unit_id" class="w-full bg-white border border-gray-300 rounded px-3 py-2 text-sm">
                        <option value="">Pilih</option>
                        @foreach($units as $u)
                            <option value="{{ $u->id }}">{{ $u->nama_unit }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Ruang</label>
                    <select name="ruang_id" class="w-full bg-white border border-gray-300 rounded px-3 py-2 text-sm">
                        <option value="">Pilih</option>
                        @foreach($ruangs as $r)
                            <option value="{{ $r->id }}">{{ $r->nama_ruang }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Pemeliharaan</label>
                    <input type="date" name="tanggal_pemeliharaan" required class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jadwal Pemeliharaan Berikutnya</label>
                    <input type="date" name="jadwal_berikutnya" class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Petugas</label>
                    <input type="text" name="petugas" required class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kondisi</label>
                    <select name="kondisi_id" class="w-full bg-white border border-gray-300 rounded px-3 py-2 text-sm">
                        <option value="">Pilih</option>
                        @foreach($kondisis as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kondisi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Keterangan / Catatan Pekerjaan</label>
                <textarea name="keterangan" rows="3" class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm"></textarea>
            </div>
            <div class="border-t border-gray-200 pt-4 flex justify-end">
                <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-medium text-sm px-5 py-2.5 rounded shadow">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</body>
</html>