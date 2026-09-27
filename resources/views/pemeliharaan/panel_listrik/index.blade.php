<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pemeliharaan Panel Listrik - SISPAK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex">
    <main class="flex-1 p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Pemeliharaan - Panel Listrik</h2>
            <a href="{{ route('panel-listrik.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-semibold">+ Tambah Catatan</a>
        </div>

        <!-- NOTIFIKASI PERINGATAN (JIKA ADA PANEL YANG BELUM DICEK / JATUH TEMPO) -->
        @if($warningCount > 0)
        <div class="bg-rose-500 text-white p-4 rounded-lg shadow-md mb-6 flex items-center justify-between animate-pulse">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-triangle-exclamation text-2xl"></i>
                <div>
                    <h4 class="font-bold text-sm">Peringatan Jadwal Pemeliharaan!</h4>
                    <p class="text-xs mt-0.5">Terdapat <strong>{{ $warningCount }} panel listrik</strong> yang sudah jatuh tempo dan belum dilakukan pengecekan ulang.</p>
                </div>
            </div>
            <span class="bg-rose-700 text-white text-xs font-bold px-3 py-1 rounded-full uppercase">Perlu Pengecekan</span>
        </div>
        @endif

        <!-- Tabel Data -->
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-100 border-b text-gray-700 font-bold uppercase">
                        <th class="p-3">NO</th>
                        <th class="p-3">KODE PANEL</th>
                        <th class="p-3">NAMA PANEL</th>
                        <th class="p-3">LOKASI UNIT</th>
                        <th class="p-3">RUANG</th>
                        <th class="p-3">TGL PEMELIHARAAN</th>
                        <th class="p-3">JADWAL NEXT</th>
                        <th class="p-3">PETUGAS</th>
                        <th class="p-3">STATUS CHECK</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($panels as $index => $p)
                    @php
                        // Cek apakah jadwal pemeliharaan berikutnya sudah lewat atau sama dengan hari ini
                        $isOverdue = $p->jadwal_berikutnya && \Carbon\Carbon::parse($p->jadwal_berikutnya)->isPast();
                    @endphp

                    <!-- Baris otomatis berwarna merah lembut jika $isOverdue bernilai true -->
                    <tr class="border-b transition {{ $isOverdue ? 'bg-red-100 border-red-200 hover:bg-red-200' : 'hover:bg-gray-50' }}">
                        <td class="p-3 font-medium">{{ $panels->firstItem() + $index }}</td>
                        <td class="p-3 font-mono">{{ $p->kode_panel ?? '-' }}</td>
                        <td class="p-3 font-semibold text-gray-800">{{ $p->nama_panel }}</td>
                        
                        <!-- Nama Unit Berwarna Merah Tebal jika Belum Dicek -->
                        <td class="p-3 font-bold {{ $isOverdue ? 'text-red-700' : 'text-gray-700' }}">
                            {{ $p->unit->nama_unit ?? '-' }}
                        </td>
                        
                        <td class="p-3">{{ $p->ruang->nama_ruang ?? '-' }}</td>
                        <td class="p-3">{{ $p->tanggal_pemeliharaan }}</td>
                        
                        <!-- Tgl Jadwal Next Merah Tebal jika Jatuh Tempo -->
                        <td class="p-3 font-bold {{ $isOverdue ? 'text-red-600' : 'text-blue-600' }}">
                            {{ $p->jadwal_berikutnya ?? '-' }}
                        </td>
                        
                        <td class="p-3">{{ $p->petugas }}</td>
                        
                        <!-- Lencana Status Merah -->
                        <td class="p-3">
                            @if($isOverdue)
                                <span class="px-2 py-1 bg-red-600 text-white rounded font-bold text-[10px] uppercase shadow">
                                    <i class="fa-solid fa-clock-rotate-left mr-1"></i> Belum Dicek
                                </span>
                            @else
                                <span class="px-2 py-1 bg-emerald-100 text-emerald-800 rounded font-semibold text-[10px] uppercase">
                                    Terjadwal Aman
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="p-4 text-center text-gray-500">Belum ada catatan pemeliharaan panel listrik.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $panels->links() }}</div>
    </main>
</body>
</html>