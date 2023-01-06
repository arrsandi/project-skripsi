<?php

use App\Models\Pengiriman;
use Carbon\Carbon;

function noinvoice()
{
    // $latest = Pengiriman::latest()->first();
    $month = date('m');
    $year = date('Y');

    $nomor = Pengiriman::whereYear("tanggal", Carbon::now()->year)->count();

    if (!$nomor) {
        return '1/' . $month . '/' . $year;
    }

    $string = preg_replace("/[^0-9\.]/", '', $nomor);

    // return 'Order #' . sprintf($string + 1);
    return sprintf($string + 1) . '/' . $month . '/' . $year;
}

function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}



function terbilang($angka)
{
    $angka = abs($angka);
    $baca = array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas');
    $terbilang = '';

    if ($angka < 12) { //1-11
        $terbilang = ' ' . $baca[$angka];
    } else if ($angka < 20) { //12-19
        $terbilang = terbilang($angka - 20) . ' Belas';
    } else if ($angka < 100) { //20-99
        $terbilang = terbilang($angka / 10) . ' Puluh' . terbilang($angka % 10);
    } else if ($angka < 200) { //100-199
        $terbilang = ' seratus' . terbilang($angka - 100);
    } else if ($angka < 1000) { //200-999
        $terbilang = terbilang($angka / 100) . ' Ratus' . terbilang($angka % 100);
    } else if ($angka < 2000) { //1000-1999
        $terbilang = ' seribu' . terbilang($angka - 1000);
    } else if ($angka < 1000000) { //2000-999.999
        $terbilang = terbilang($angka / 1000) . ' Ribu' . terbilang($angka % 1000);
    } else if ($angka < 1000000000) { //1.000.0000-999.999.999
        $terbilang = terbilang($angka / 1000000) . ' Ruta' . terbilang($angka % 1000000);
    }
    return $terbilang;
}
