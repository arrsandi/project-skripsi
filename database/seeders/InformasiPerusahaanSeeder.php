<?php

namespace Database\Seeders;

use App\Models\InformasiPerusahaan;
use Illuminate\Database\Seeder;

class InformasiPerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InformasiPerusahaan::create([
            'nama_perusahaan' => 'ini nama perusahaan',
            'deskripsi_perusahaan' => 'ini deskripsi perusahaan',
            'telepon_perusahaan' => 'no telepon perusahaan',
            'email_perusahaan' => 'email perusahaan',
            'alamat_perusahaan' => 'alamat perusahaan',
            'cover' => 'xxxxx'
        ]);
    }
}
