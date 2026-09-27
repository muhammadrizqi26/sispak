<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pemeliharaan APAR - SISPAK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex">
    <main class="flex-1 p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Pemeliharaan - APAR</h2>
            <a href="{{ route('apar.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-semibold">+ Tambah Pengecekan APAR</a>
        </div>

        @if($warningCount > 0)
        <div class="bg-rose-500 text-white p-4 rounded-lg shadow-md mb-6 flex items-center justify-between animate-pulse">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-fire-extinguisher text-2xl"></i>
                <div>
                    <h4 class="font-bold text-sm">Peringatan Inspeksi APAR!</h4>
                    <p class="text-xs mt-0.5">Terdapat <strong>{{ $warningCount }} tabung APAR</strong> yang sudah jatuh tempo jadwal pengisian/inspeksinya.</p>
                </div>
            </div>
            <span class="bg-rose-700 text-white text-xs font-bold px-3 py-1 rounded-full uppercase">Perlu Inspeksi</span>
        </div>
        @endif

        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-100 border-b text-gray-700 font-bold uppercase">
                        <th class="p-3">NO</th>
                        <th class="p-3">KODE APAR</th>
                        <th class="p-3">JENIS</th>
                        <th class="p-3">KAPASITAS</th>
                        <th class="p-3">LOKASI UNIT</th>
                        <th class="p-3">RUANG</th>
                        <th class="p-3">TGL INSPEKSI</th>
                        <th class="p-3">JADWAL NEXT</th>
                        <th class="p-3">TEKANAN</th>
                        <th class="p-3">PETUGAS</th>
                        <th class="p-3">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($apars as $index => $a)
                    @php
                        $isOverdue = $a->jadwal_berikutnya && \Carbon\Carbon::parse($a->jadwal_berikutnya)->isPast();
                    @endphp
                    <tr class="border-b transition {{ $isOverdue ? 'bg-red-100 border-red-200 hover:bg-red-200' : 'hover:bg-gray-50' }}">
                        <td class="p-3">{{ $apars->firstItem() + $index }}</td>
                        <td class="p-3 font-mono font-bold">{{ $a->kode_apar ?? '-' }}</td>
                        <td class="p-3 font-semibold text-gray-800">{{ $a->jenis_apar }}</td>
                        <td class="p-3">{{ $a->kapasitas }}</td>
                        <td class="p-3 font-bold {{ $isOverdue ? 'text-red-700' : 'text-gray-700' }}">{{ $a->unit->nama_unit ?? '-' }}</td>
                        <td class="p-3">{{ $a->ruang->nama_ruang ?? '-' }}</td>
                        <td class="p-3">{{ $a->tanggal_pemeriksaan }}</td>
                        <td class="p-3 font-bold {{ $isOverdue ? 'text-red-600' : 'text-blue-600' }}">{{ $a->jadwal_berikutnya }}</td>
                        <td class="p-3">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $a->tekanan == 'Normal' ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ $a->tekanan }}
                            </span>
                        </td>
                        <td class="p-3">{{ $a->petugas }}</td>
                        <td class="p-3">
                            @if($isOverdue)
                                <span class="px-2 py-1 bg-red-600 text-white rounded font-bold text-[10px] uppercase shadow">Belum Inspeksi</span>
                            @else
                                <span class="px-2 py-1 bg-emerald-100 text-emerald-800 rounded font-semibold text-[10px] uppercase">Aman</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="p-4 text-center text-gray-500">Belum ada catatan pemeliharaan APAR.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $apars->links() }}</div>
    </main>
</body>
</html>