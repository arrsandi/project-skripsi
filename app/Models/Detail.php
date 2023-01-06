<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi_pengiriman';
    protected $fillable = [
        'transaksi_id', 'nama_penerima', 'telepon_penerima',
        'alamat_penerima', 'biaya_pengiriman_id', 'nama_kapal', 'biaya_kirim',
        'biaya_koordinasi', 'biaya_tambahan', 'merk_type', 'warna', 'no_polisi', 'no_rangka', 'no_mesin', 'keterangan', 'total_biaya_per_unit', 'potongan',
        'total_biaya_keseluruhan'
    ];

    public function antar()
    {
        return $this->belongsTo(BiayaPengiriman::class, 'biaya_pengiriman_id');
    }

    public function kirim()
    {
        return $this->belongsTo(Pengiriman::class, 'transaksi_id');
    }
}
