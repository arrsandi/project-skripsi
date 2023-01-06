<?php
function format_uang($angka)
{
    return number_format($angka, 0, ",", ".");
}



function terbilang($angka)
{
    $angka = abs($angka);
    $baca = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas');
    $terbilang = '';

    if ($angka < 12) { //1-11
        $terbilang = ' ' . $baca[$angka];
    } else if ($angka < 20) { //12-19
        $terbilang = terbilang($angka - 20) . ' belas';
    } else if ($angka < 100) { //20-99
        $terbilang = terbilang($angka / 10) . ' puluh' . terbilang($angka % 10);
    } else if ($angka < 200) { //100-199
        $terbilang = ' seratus' . terbilang($angka - 100);
    } else if ($angka < 1000) { //200-999
        $terbilang = terbilang($angka / 100) . ' ratus' . terbilang($angka % 100);
    } else if ($angka < 2000) { //1000-1999
        $terbilang = ' seribu' . terbilang($angka - 1000);
    } else if ($angka < 1000000) { //2000-999.999
        $terbilang = terbilang($angka / 1000) . ' ribu' . terbilang($angka % 1000);
    } else if ($angka < 1000000000) { //1.000.0000-999.999.999
        $terbilang = terbilang($angka / 1000000) . ' juta' . terbilang($angka % 1000000);
    }
    return $terbilang;
}

function tanggal_indonesia($tgl, $tampil_hari = true)
{
    $nama_hari = array(
        'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'
    );
    $nama_bulan = array(
        1 =>
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );
    $tahun = substr($tgl, 0, 4);
    $bulan = $nama_bulan[(int) substr($tgl, 5, 2)];
    $tanggal = substr($tgl, 8, 2);
    $text = '';



    if ($tampil_hari) {
        $urutan_hari = date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun));
        $hari = $nama_hari[$urutan_hari];
        $text .= "$hari, $tanggal $bulan $tahun";
    } else {
        $text .= "$tanggal $bulan $tahun";
    }
    return $text;
}

function tambah_nol_didepan($value, $threshold = null)
{
    return sprintf("%0" . $threshold . "s", $value);
}

function kode_pr($model, $trow, $length = 4, $prefix)
{
    $data = $model::ordeyBy('id', 'desc')->first();
    if (!$data) {
        $og_length = $length;
        $last_number = '';
    } else {
        $code = substr($data->$trow, strlen($prefix) + 1);
        $actial_last_number = ($code / 1) * 1;
        $increment_last_number = $actial_last_number + 1;
        $last_number_length = strlen($increment_last_number);
        $og_length = $length - $last_number_length;
        $last_number = $increment_last_number;
    }

    $zeros = "";
    for ($i = 0; $i < $og_length; $i++) {
        $zeros .= "0";
    }
    return $prefix . '-' . $zeros . $last_number;
}
