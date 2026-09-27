<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Non Alkes - SISPAK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
</head>
<body class="bg-gray-100 flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-slate-800 min-h-screen text-white p-4">
        <h1 class="text-xl font-bold mb-6 text-center">SISPAK</h1>
        <nav class="space-y-2">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-slate-700 rounded">Beranda</a>
            <a href="{{ route('alkes.index') }}" class="block px-4 py-2 hover:bg-slate-700 rounded">Daftar Alkes</a>
            <a href="{{ route('non-alkes.index') }}" class="block px-4 py-2 bg-blue-600 rounded">Daftar Non Alkes</a>
        </nav>
    </aside>

    <!-- Main Content -->
     
    <main class="flex-1 p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Daftar Non Alkes</h2>
            <div class="flex gap-2">
                <a href="{{ route('non-alkes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm font-semibold hover:bg-blue-700">+ Tambah Alat</a>
            </div>
        </div>

        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('non-alkes.index') }}" class="mb-4 flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketikkan Nama Alat atau Kode..." class="border p-2 rounded w-1/3 bg-gray-50 text-sm">
            <button type="submit" class="bg-sky-500 text-white px-4 py-2 rounded text-sm font-semibold hover:bg-sky-600">Cari</button>
        </form>

        <!-- Tabel Data -->
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-gray-100 border-b text-gray-700 font-bold uppercase">
                        <th class="p-3">NO</th>
                        <th class="p-3">GAMBAR</th>
                        <th class="p-3">KODE ALAT</th>
                        <th class="p-3">NAMA ALAT</th>
                        <th class="p-3">MERK</th>
                        <th class="p-3">TIPE</th>
                        <th class="p-3">NO SERI</th>
                        <th class="p-3">KONDISI</th>
                        <th class="p-3">UNIT</th>
                        <th class="p-3">RUANG</th>
                        <th class="p-3">DIINPUT OLEH</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($nonAlkes as $index => $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $nonAlkes->firstItem() + $index }}</td>
                        <td class="p-3">
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" class="w-12 h-12 object-cover rounded">
                            @else
                                <span class="text-gray-400">No Image</span>
                            @endif
                        </td>
                        <td class="p-3 font-mono">{{ $item->kode_barang ?? '-' }}</td>
                        <td class="p-3 font-semibold text-gray-800">{{ $item->nama_barang }}</td>
                        <td class="p-3">{{ $item->merk ?? '-' }}</td>
                        <td class="p-3">{{ $item->tipe ?? '-' }}</td>
                        <td class="p-3">{{ $item->no_seri ?? '-' }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded font-semibold">
                                {{ $item->kondisi->nama_kondisi ?? '-' }}
                            </span>
                        </td>
                        <td class="p-3">{{ $item->unit->nama_unit ?? '-' }}</td>
                        <td class="p-3">{{ $item->ruang->nama_ruang ?? '-' }}</td>
                        <td class="p-3 font-medium text-gray-600">{{ $item->creator->name ?? 'Admin' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="p-4 text-center text-gray-500">Belum ada data Non-Alkes.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $nonAlkes->links() }}
        </div>
    </main>
</body>
</html>