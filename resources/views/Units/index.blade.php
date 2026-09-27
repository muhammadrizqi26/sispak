<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Master Data Unit - SISPAK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-slate-800 min-h-screen text-white p-4">
        <h1 class="text-xl font-bold mb-6 text-center text-sky-400">SISPAK</h1>
        <nav class="space-y-1 text-sm">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-slate-700 rounded">Beranda</a>
            <a href="{{ route('units.index') }}" class="block px-4 py-2 bg-sky-600 rounded font-semibold">Master Unit</a>
            <a href="{{ route('alkes.index') }}" class="block px-4 py-2 hover:bg-slate-700 rounded">Daftar Alkes</a>
            <a href="{{ route('non-alkes.index') }}" class="block px-4 py-2 hover:bg-slate-700 rounded">Daftar Non Alkes</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Master Data Unit</h2>
            <span class="bg-sky-100 text-sky-800 text-xs font-bold px-3 py-1.5 rounded-full">
                Total: {{ $units->total() }} Unit
            </span>
        </div>

        <!-- Tabel Unit -->
        <div class="bg-white rounded shadow overflow-hidden">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-100 border-b text-gray-700 font-bold uppercase text-xs">
                        <th class="p-3 w-16">NO</th>
                        <th class="p-3">NAMA UNIT</th>
                        <th class="p-3 text-center w-32">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($units as $index => $u)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3 text-gray-500">{{ $units->firstItem() + $index }}</td>
                        <td class="p-3 font-medium text-gray-800">{{ $u->nama_unit }}</td>
                        <td class="p-3 text-center">
                            <button class="text-blue-600 hover:text-blue-800 mr-2"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="text-red-600 hover:text-red-800"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">Belum ada data unit.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $units->links() }}
        </div>
    </main>
</body>
</html>