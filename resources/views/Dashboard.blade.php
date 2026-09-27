<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - SISPAK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 flex">
   <!-- Sidebar -->
<aside class="w-64 bg-slate-800 min-h-screen text-white p-4 flex flex-col justify-between">
    <div>
        <!-- Brand Logo / Title -->
        <div class="text-center pb-6 border-b border-slate-700">
            <h1 class="text-2xl font-bold tracking-wider text-sky-400">SISPAK</h1>
            <p class="text-xs text-slate-400 mt-1">RS Condong Catur</p>
        </div> 

        <!-- Navigation Menu -->
        <nav class="space-y-1 text-sm mt-4">
            <!-- Menu Beranda -->
            <a href="{{ route('dashboard') }}" 
               class="flex items-center gap-3 px-4 py-2.5 rounded transition {{ request()->routeIs('dashboard') ? 'bg-sky-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-700' }}">
                <i class="fa-solid fa-house w-5"></i>
                <span>Beranda</span>
            </a>

            <!-- Menu Master Data (Dropdown Accordion) -->
            <div>
                @php
                    // Cek apakah salah satu route master sedang aktif, jika ya, otomatis buka submenu
                    $isMasterActive = request()->routeIs('units.*') || request()->routeIs('ruangs.*') || request()->routeIs('sumber-danas.*') || request()->routeIs('status-produks.*') || request()->routeIs('kondisis.*');
                @endphp

                <button type="button" 
                        onclick="toggleSubmenu('masterSubmenu', 'masterArrow')" 
                        class="w-full flex items-center justify-between px-4 py-2.5 rounded text-slate-300 hover:bg-slate-700 transition">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-gear w-5"></i>
                        <span>Master</span>
                    </div>
                    <i id="masterArrow" class="fa-solid fa-chevron-down text-xs transition-transform duration-200 {{ $isMasterActive ? 'rotate-180' : '' }}"></i>
                </button>

                <!-- Sub-Menu Master Data -->
                <div id="masterSubmenu" class="{{ $isMasterActive ? '' : 'hidden' }} pl-9 pr-2 py-1 space-y-1 bg-slate-900/50 rounded mt-1">
                    <a href="{{ route('units.index') }}" 
                    class="block py-1.5 px-3 rounded text-xs {{ request()->routeIs('units.*') ? 'text-sky-400 font-bold bg-slate-800' : 'text-slate-300 hover:text-white hover:bg-slate-700' }} transition">    
                    Unit
                    </a>
                    <a href="{{ route('ruangs.index') }}" 
                    class="block py-1.5 px-3 rounded text-xs {{ request()->routeIs('ruangs.*') ? 'text-sky-400 font-bold bg-slate-800' : 'text-slate-300 hover:text-white hover:bg-slate-700' }} transition">
                    Ruang
                    </a>
                    <a href="{{ route('sumber-danas.index') }}" 
                    class="block py-1.5 px-3 rounded text-xs {{ request()->routeIs('sumber-danas.*') ? 'text-sky-400 font-bold bg-slate-800' : 'text-slate-300 hover:text-white hover:bg-slate-700' }} transition">
                    Sumber Dana
                    </a>
                    <a href="{{ route('status-produks.index') }}" 
                    class="block py-1.5 px-3 rounded text-xs {{ request()->routeIs('status-produks.*') ? 'text-sky-400 font-bold bg-slate-800' : 'text-slate-300 hover:text-white hover:bg-slate-700' }} transition">
                    Status Produk
                    </a>
                    <a href="{{ route('kondisis.index') }}" 
                    class="block py-1.5 px-3 rounded text-xs {{ request()->routeIs('kondisis.*') ? 'text-sky-400 font-bold bg-slate-800' : 'text-slate-300 hover:text-white hover:bg-slate-700' }} transition">
                    Kondisi
                    </a>
                </div>
            </div>

            <!-- Menu Pemeliharaan (Dropdown Accordion) -->
            <div>
                <button type="button" 
                        onclick="toggleSubmenu('pemeliharaanSubmenu', 'pemeliharaanArrow')" 
                        class="w-full flex items-center justify-between px-4 py-2.5 rounded text-slate-300 hover:bg-slate-700 transition">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-screwdriver-wrench w-5"></i>
                        <span>Pemeliharaan</span>
                    </div>
                    <i id="pemeliharaanArrow" class="fa-solid fa-chevron-down text-xs transition-transform duration-200 {{ request()->routeIs('panel-listrik.*') || request()->routeIs('apar.*') ? 'rotate-180' : '' }}"></i>
                </button>

                <!-- Sub-Menu Pemeliharaan -->
                <div id="pemeliharaanSubmenu" class="{{ request()->routeIs('panel-listrik.*') || request()->routeIs('apar.*') ? '' : 'hidden' }} pl-9 pr-2 py-1 space-y-1 bg-slate-900/50 rounded mt-1">
                    <a href="{{ route('panel-listrik.index') }}" 
                    class="block py-1.5 px-3 rounded text-xs {{ request()->routeIs('panel-listrik.*') ? 'text-sky-400 font-bold bg-slate-800' : 'text-slate-300 hover:text-white hover:bg-slate-700' }} transition">
                        Panel Listrik
                    </a>
                    <a href="{{ route('apar.index') }}" 
                    class="block py-1.5 px-3 rounded text-xs {{ request()->routeIs('apar.*') ? 'text-sky-400 font-bold bg-slate-800' : 'text-slate-300 hover:text-white hover:bg-slate-700' }} transition">
                        APAR
                    </a>
                </div>
            </div>

            <!-- Menu Daftar Alkes -->
            <a href="{{ route('alkes.index') }}" 
               class="flex items-center gap-3 px-4 py-2.5 rounded transition {{ request()->routeIs('alkes.*') ? 'bg-sky-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-700' }}">
                <i class="fa-solid fa-database w-5"></i>
                <span>Daftar Alkes</span>
            </a>

            <!-- Menu Daftar Non Alkes -->
            <a href="{{ route('non-alkes.index') }}" 
               class="flex items-center gap-3 px-4 py-2.5 rounded transition {{ request()->routeIs('non-alkes.*') ? 'bg-sky-600 text-white font-medium' : 'text-slate-300 hover:bg-slate-700' }}">
                <i class="fa-solid fa-boxes-stacked w-5"></i>
                <span>Daftar Non Alkes</span>
            </a>

            <!-- Menu Kalibrasi Alkes -->
            <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded text-slate-300 hover:bg-slate-700 transition">
                <i class="fa-solid fa-sliders w-5"></i>
                <span>Kalibrasi Alkes</span>
            </a>
        </nav>
    </div>

    <!-- Menu Logout -->
    <div class="pt-4 border-t border-slate-700">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-slate-300 hover:text-red-400 hover:bg-slate-700/50 rounded transition text-sm">
                <i class="fa-solid fa-right-from-bracket w-5"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>

<!-- Script JavaScript Toggle Sub-menu -->
<script>
    function toggleSubmenu(menuId, arrowId) {
        const submenu = document.getElementById(menuId);
        const arrow = document.getElementById(arrowId);
        
        submenu.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
    }
</script>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <h2 class="text-2xl font-semibold mb-4">Dashboard</h2>

        <!-- Cards -->
        <div class="grid grid-cols-4 gap-4 mb-6 text-white text-center font-bold">
            <div class="bg-sky-500 p-4 rounded shadow">
                <p>Total Alkes</p>
                <p class="text-3xl mt-2">{{ $totalAlkes }}</p>
            </div>
            <div class="bg-emerald-500 p-4 rounded shadow">
                <p>Baik</p>
                <p class="text-3xl mt-2">{{ $baik }}</p>
            </div>
            <div class="bg-amber-400 p-4 rounded shadow">
                <p>Rusak</p>
                <p class="text-3xl mt-2">{{ $rusak }}</p>
            </div>
            <div class="bg-rose-600 p-4 rounded shadow">
                <p>Tidak Beroperasi</p>
                <p class="text-3xl mt-2">{{ $tidakBeroperasi }}</p>
            </div>
        </div>

        <!-- Chart Container Full Width -->
        <div class="bg-white rounded shadow overflow-hidden mb-6 w-full">
            <div class="bg-sky-500 text-white font-bold p-3 text-sm">
                Grafik Jumlah Alkes Unit
            </div>
            <div class="p-4 w-full relative" style="min-height: 400px; height: 420px;">
                <canvas id="alkesUnitChart"></canvas>
            </div>
        </div>
    </main>

<!-- Script Chart.js -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('alkesUnitChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Grafik Jumlah Alkes Unit',
                    data: {!! json_encode($chartData) !!},
                    backgroundColor: [
                        '#ef4444', '#3b82f6', '#10b981', '#f59e0b', 
                        '#06b6d4', '#8b5cf6', '#ec4899', '#14b8a6',
                        '#f97316', '#84cc16', '#6366f1', '#a855f7'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            maxRotation: 45,
                            minRotation: 45,
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            display: true
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0
                        }
                    }
                }
            }
        });
    });
</script>
</body>
</html>