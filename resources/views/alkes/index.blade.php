<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Alkes - SISPAK</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">
    <aside class="w-64 bg-slate-800 min-h-screen text-white p-4">
        <h1 class="text-xl font-bold mb-6 text-center">SISPAK</h1>
        <nav class="space-y-2">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-slate-700 rounded">Beranda</a>
            <a href="{{ route('alkes.index') }}" class="block px-4 py-2 bg-blue-600 rounded">Daftar Alkes</a>
        </nav>
    </aside>

    <main class="flex-1 p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Daftar Alkes</h2>
            <a href="{{ route('alkes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Alkes</a>
        </div>

        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('alkes.index') }}" class="mb-4 flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketikkan Nama Alkes..." class="border p-2 rounded w-1/3">
            <button type="submit" class="bg-sky-500 text-white px-4 py-2 rounded">Cari</button>
        </form>

        <!-- Tabel Data -->
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b text-sm">
                        <th class="p-3">NO</th>
                        <th class="p-3">NAMA ALKES</th>
                        <th class="p-3">MERK</th>
                        <th class="p-3">KONDISI</th>
                        <th class="p-3">UNIT</th>
                        <th class="p-3">RUANG</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alkes as $index => $item)
                    <tr class="border-b hover:bg-gray-50 text-sm">
                        <td class="p-3">{{ $alkes->firstItem() + $index }}</td>
                        <td class="p-3 font-semibold">{{ $item->nama_barang }}</td>
                        <td class="p-3">{{ $item->merk ?? '-' }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">
                                {{ $item->kondisi->nama_kondisi ?? '-' }}
                            </span>
                        </td>
                        <td class="p-3">{{ $item->unit->nama_unit ?? '-' }}</td>
                        <td class="p-3">{{ $item->ruang->nama_ruang ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-500">Belum ada data alkes.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $alkes->links() }}
        </div>
    </main>
</body>
</html>