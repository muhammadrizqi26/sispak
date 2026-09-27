<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Tambah Non Alkes - SISPAK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-200 p-6 font-sans">

    <div class="max-w-6xl mx-auto bg-white rounded shadow-md overflow-hidden">
        <!-- Header Modal/Form -->
        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700">Form</h3>
            <a href="{{ route('non-alkes.index') }}" class="text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</a>
        </div>

        <!-- Form Body -->
        <form action="{{ route('non-alkes.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                
                <!-- KOLOM KIRI -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kode Alat</label>
                        <input type="text" name="kode_barang" class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm focus:bg-white focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Alat</label>
                        <input type="text" name="nama_barang" required class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm focus:bg-white focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Merk</label>
                        <input type="text" name="merk" class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm focus:bg-white focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tipe</label>
                        <input type="text" name="tipe" class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm focus:bg-white focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">No Seri</label>
                        <input type="text" name="no_seri" class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm focus:bg-white focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tahun Pembelian</label>
                        <input type="number" name="tahun_pembelian" value="2026" class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm focus:bg-white focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">No Izin Edar</label>
                        <input type="text" name="no_izin_edar" class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm focus:bg-white focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tahun Pengadaan</label>
                        <input type="number" name="tahun_pengadaan" value="2026" class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm focus:bg-white focus:outline-none focus:border-blue-500">
                    </div>
                </div>

                <!-- KOLOM KANAN -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kondisi</label>
                        <select name="kondisi_id" class="w-full bg-white border border-gray-300 rounded px-3 py-2 text-sm text-gray-600 focus:outline-none focus:border-blue-500">
                            <option value="">Pilih</option>
                            @foreach($kondisis as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kondisi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Unit</label>
                        <select name="unit_id" class="w-full bg-white border border-gray-300 rounded px-3 py-2 text-sm text-gray-600 focus:outline-none focus:border-blue-500">
                            <option value="">Pilih</option>
                            @foreach($units as $u)
                                <option value="{{ $u->id }}">{{ $u->nama_unit }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Ruang</label>
                        <select name="ruang_id" class="w-full bg-white border border-gray-300 rounded px-3 py-2 text-sm text-gray-600 focus:outline-none focus:border-blue-500">
                            <option value="">Pilih</option>
                            @foreach($ruangs as $r)
                                <option value="{{ $r->id }}">{{ $r->nama_ruang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Status Produk</label>
                        <select name="status_produk_id" class="w-full bg-white border border-gray-300 rounded px-3 py-2 text-sm text-gray-600 focus:outline-none focus:border-blue-500">
                            <option value="">Pilih</option>
                            @foreach($statusProduks as $sp)
                                <option value="{{ $sp->id }}">{{ $sp->nama_status_produk }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Sumber Dana</label>
                        <select name="sumber_dana_id" class="w-full bg-white border border-gray-300 rounded px-3 py-2 text-sm text-gray-600 focus:outline-none focus:border-blue-500">
                            <option value="">Pilih</option>
                            @foreach($sumberDanas as $sd)
                                <option value="{{ $sd->id }}">{{ $sd->nama_sumber_dana }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Harga Beli</label>
                        <input type="number" name="harga_beli" class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm focus:bg-white focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Distributor</label>
                        <input type="text" name="distributor" class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm focus:bg-white focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Keterangan</label>
                        <input type="text" name="keterangan" class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 text-sm focus:bg-white focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Gambar</label>
                        <div class="bg-gray-50 border border-gray-300 rounded p-1">
                            <input type="file" name="gambar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300">
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer / Button -->
            <div class="mt-8 border-t border-gray-200 pt-4 flex justify-end">
                <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-medium text-sm px-5 py-2.5 rounded flex items-center gap-2 shadow">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Data
                </button>
            </div>
        </form>
    </div>

</body>
</html>