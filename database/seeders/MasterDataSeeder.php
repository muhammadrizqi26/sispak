<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;
use App\Models\Ruang;
use App\Models\Kondisi;
use App\Models\StatusProduk;
use App\Models\SumberDana;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Data Unit
        $units = ['Farmasi', 'Fisioterapi', 'Hemodialisa', 'IGD', 'IPSRS', 'Kamar Operasi', 'Rawat Jalan (Poliklinik)', 'Laboratorium', 'Marketing', 'Maternal Perinatal', 'Radiologi', 'Ranap lt 2', 'Ranap lt 3', 'Security', 'ICU', 'Legal', 'Teknologi Informasi', 'Keuangan', 'Gizi', 'Laundry', 'Humas', 'Kasir', 'Rekam Medis', 'Pendaftaran', 'Sanitasi', 'Logistik', 'Driver', 'Unit Bisnis', 'Administrasi', 'Gudang Farmasi', 'Sekretaris', 'CSO', 'HRD', 'Laktasi', 'Ruang Jenazah', 'Ruang Direktur', 'Ruang KMP', 'Kabag HRD', 'Kabag Umum', 'Kasie Jangmed', 'Koridor Lt 1', 'Koridor Lt 2', 'Koridor Lt 3', 'Ruang istirahat Dokter IGD', 'Kasie Umum, IPCN', 'Aset Manajemen', 'Ruang Pertemuan Lt 4', 'Kasie Perawatan', 'Elektromedis', 'Kantin', 'Ruang Laktasi', 'Parkir' ];
        foreach ($units as $u) {
            Unit::firstOrCreate(['nama_unit' => $u]);
        }

        // 2. Seed Data Ruang
        $ruangs = ['HCU', 'ISOLASI', 'Kamar Operasi', 'Kit Ambulance', 'Kit P3K', 'Klinik Anak', 'Klinik Bedah', 'Klinik Penyakit Dalam', 'Klinik Gigi', 'Klinik Mata', 'Klinik MCU', 'Klinik Rehab Medik', 'Klinik Syaraf', 'Klinik THT', 'Klinik Umum', 'Nurse Station', 'Rawat Jalan', 'Ruang Bayi', 'Ruang VK', 'Gudang Farmasi','Farmasi Rawat Inap', 'Farmasi Rawat Jalan', 'Radiologi', 'Nurse Sation Lantai 2', 'Nurse Sation Lantai 3', 'Laboratorium', 'BDRS', 'ICU', 'PICU', 'NICU', 'Manajemen', 'Sekretaris', 'Elekromedis', 'Klinik Paru', 'Klinik Psikiatri', 'CSSD', 'Kantin', 'Ruang Laktasi', 'Parkir', 'Ruang APM', 'Klinik Kulit Kelamin', 'Klinik Fisioterapi'];

        foreach ($ruangs as $r) {
            Ruang::firstOrCreate(['nama_ruang' => $r]);
        }

        // 3. Seed Data Kondisi
        $kondisis = ['Baik', 'Rusak', 'Tidak Beroperasi'];
        foreach ($kondisis as $k) {
            Kondisi::firstOrCreate(['nama_kondisi' => $k]);
        }

        // 4. Seed Data Status Produk
        $statusProduks = ['Dalam Negeri', 'Luar Negeri', 'Tidak Tahu'];
        foreach ($statusProduks as $sp) {
            StatusProduk::firstOrCreate(['nama_status_produk' => $sp]);
        }

        // 5. Seed Data Sumber Dana
        $sumberDanas = ['APBN', 'APBD', 'Hibah / Pemberian', 'KSO / Pinjaman', 'BLU / Swadana', 'JKN', 'DAK', 'Keuangan RS Condong Catur'];
        foreach ($sumberDanas as $sd) {
            SumberDana::firstOrCreate(['nama_sumber_dana' => $sd]);
        }


        // Buat User Default dengan No HP & TTL sebagai Password
        User::firstOrCreate(
            ['no_hp' => '081234567890'],
            [
                'name' => 'Muhamad Agus Hidayat',
                'tanggal_lahir' => '1995-08-25',
                'password' => Hash::make('25081995') // Tanggal Lahir (DDMMYYYY) di-hash
            ]
        );
    }
}