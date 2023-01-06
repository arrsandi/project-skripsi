<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPengiriman extends Model
{
    use HasFactory;

    protected $table = 'jenis_pengiriman';
    protected $fillable = ['nama_layanan', 'deskripsi', 'foto'];

    public function pengiriman_biaya()
    {
        return $this->hasMany(BiayaPengiriman::class);
    }
}
