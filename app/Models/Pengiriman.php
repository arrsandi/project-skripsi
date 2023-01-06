<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'transaksi_pengiriman';
    protected $fillable = ['noinvoice', 'user_id', 'tanggal', 'nama_pengirim', 'telepon_pengirim', 'alamat_pengirim', 'total_biaya', 'potongan', 'total_biaya_keseluruhan', 'status_pengiriman'];

    public function detail()
    {
        return $this->hasMany(Detail::class, 'transaksi_id');
    }

    public function input_pengiriman()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
