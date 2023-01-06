<?php

namespace App\Http\Controllers;


use App\Models\BiayaPengiriman;
use App\Models\InformasiPerusahaan;
use App\Models\JenisPengiriman;
use App\Models\SyaratKetentuan;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $informasi_perusahaan = InformasiPerusahaan::first();
        $biaya_pengiriman = BiayaPengiriman::orderBy('jenis_pengiriman_id', 'desc')->get();
        $jenis_pengiriman = JenisPengiriman::limit(4)->get();
        $syarat_ketentuan = SyaratKetentuan::all();
        return view('front', compact('biaya_pengiriman', 'jenis_pengiriman', 'syarat_ketentuan', 'informasi_perusahaan'));
    }
}
