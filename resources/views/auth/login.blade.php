<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - SISPAK RS Condong Catur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-900 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-sky-600 tracking-wider">SISPAK</h1>
            <p class="text-gray-500 text-xs mt-1">Sistem Informasi Peralatan Kesehatan RS Condong Catur</p>
        </div>

        <!-- Pesan Error -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-xs mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Nomor HP Aktif</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa-solid fa-phone text-xs"></i>
                    </span>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890" required
                           class="w-full pl-9 pr-3 py-2 bg-gray-50 border border-gray-300 rounded text-sm focus:outline-none focus:border-sky-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Password (Tanggal Lahir)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa-solid fa-calendar text-xs"></i>
                    </span>
                    <input type="password" name="password" placeholder="Contoh: 25081995" required
                           class="w-full pl-9 pr-3 py-2 bg-gray-50 border border-gray-300 rounded text-sm focus:outline-none focus:border-sky-500">
                </div>
                <span class="text-[10px] text-gray-400 mt-1 block">Format: DDMMYYYY (misal: 25081995)</span>
            </div>

            <button type="submit" class="w-full bg-sky-600 hover:bg-sky-700 text-white font-semibold py-2.5 rounded text-sm shadow transition">
                Masuk Sistem
            </button>
        </form>
        <!-- Pesan Sukses Registrasi -->
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded text-xs mb-4">
        {{ session('success') }}
    </div>
@endif

<!-- Di bawah tombol Masuk Sistem -->
<div class="mt-4 text-center">
    <a href="{{ route('register') }}" class="text-xs text-sky-600 hover:underline">Belum punya akun? Registrasi akun pegawai</a>
</div>
    </div>

</body>
</html>