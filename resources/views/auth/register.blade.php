<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Akun - SISPAK RS Condong Catur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-900 flex items-center justify-center min-h-screen py-10">

    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-sky-600 tracking-wider">SISPAK</h1>
            <p class="text-gray-500 text-xs mt-1">Pendaftaran Akun Pegawai Baru</p>
        </div>

        <!-- Pesan Error -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-xs mb-4">
                <ul class="list-disc pl-4 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf
            
            <!-- Nama Lengkap -->
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" required
                       class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded text-sm focus:outline-none focus:border-sky-500">
            </div>

            <!-- Nomor HP -->
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Nomor HP Aktif</label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890" required
                       class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded text-sm focus:outline-none focus:border-sky-500">
            </div>

            <!-- Tanggal Lahir -->
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Tanggal Lahir</label>
                <input type="date" id="tgl_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required onchange="setPasswords()"
                       class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded text-sm focus:outline-none focus:border-sky-500">
            </div>

            <!-- Hidden Inputs Password (Otomatis Terisi dari Tanggal Lahir DDMMYYYY) -->
            <input type="hidden" id="password" name="password">
            <input type="hidden" id="password_confirmation" name="password_confirmation">

            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2.5 rounded text-sm shadow transition">
                Daftar Akun
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-xs text-sky-600 hover:underline">Sudah punya akun? Login di sini</a>
        </div>
    </div>

    <script>
        function setPasswords() {
            const dateVal = document.getElementById('tgl_lahir').value;
            if (dateVal) {
                // Mengubah format YYYY-MM-DD menjadi DDMMYYYY
                const parts = dateVal.split('-');
                const formatted = parts[2] + parts[1] + parts[0];
                
                document.getElementById('password').value = formatted;
                document.getElementById('password_confirmation').value = formatted;
            }
        }
    </script>
</body>
</html>