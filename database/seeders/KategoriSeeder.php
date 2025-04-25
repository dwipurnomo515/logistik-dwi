<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Elektronik & Peralatan Listrik',
            'Komputer & Aksesoris',
            'Alat Tulis Kantor (ATK)',
            'Peralatan Kebersihan',
            'Furniture & Interior Kantor',
            'Peralatan Kesehatan & P3K',
            'Peralatan Dapur & Konsumsi',
            'Bahan Bangunan & Renovasi',
            'Peralatan Keamanan (Security)',
            'Alat Ukur & Instrumen',
            'Mesin & Peralatan Industri',
            'Suku Cadang (Spare Parts)',
            'Peralatan Laboratorium',
            'Bahan Kimia & Material Pendukung',
            'Perlengkapan Gudang & Logistik',
            'Barang Cetakan (Brosur, Poster, Dll)',
            'Bahan Bakar & Pelumas',
            'Peralatan Jaringan & Telekomunikasi',
            'Peralatan Transportasi (Forklift, Troli, dll)',
            'Lain-lain / Miscellaneous',
        ];

        foreach ($categories as $kategori) {
            Kategori::create(['nama_kategori' => $kategori]);
        }
    }
}
