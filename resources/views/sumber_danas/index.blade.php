<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Master Data Sumber Dana - SISPAK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex">
    <main class="flex-1 p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Master Data Sumber Dana</h2>
            <span class="bg-sky-100 text-sky-800 text-xs font-bold px-3 py-1.5 rounded-full">
                Total: {{ $sumberDanas->total() }} Data
            </span>
        </div>

        <div class="bg-white rounded shadow overflow-hidden">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-100 border-b text-gray-700 font-bold uppercase text-xs">
                        <th class="p-3 w-16">NO</th>
                        <th class="p-3">NAMA SUMBER DANA</th>
                        <th class="p-3 text-center w-32">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sumberDanas as $index => $sd)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3 text-gray-500">{{ $sumberDanas->firstItem() + $index }}</td>
                        <td class="p-3 font-medium text-gray-800">{{ $sd->nama_sumber_dana }}</td>
                        <td class="p-3 text-center">
                            <button class="text-blue-600 hover:text-blue-800 mr-2"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="text-red-600 hover:text-red-800"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">Belum ada data sumber dana.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $sumberDanas->links() }}</div>
    </main>
</body>
</html>