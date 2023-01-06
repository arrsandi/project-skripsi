<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaPengiriman extends Model
{
    use HasFactory;
    protected $table = 'biaya_pengiriman';
    protected $fillable = ['unit_id', 'rute_asal', 'rute_tujuan', 'jenis_pengiriman_id', 'biaya_pengiriman'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function detail()
    {
        return $this->hasMany(Detail::class);
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }

    public function jenis()
    {
        return $this->belongsTo(JenisPengiriman::class, 'jenis_pengiriman_id');
    }
}
