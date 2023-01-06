<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiPerusahaan extends Model
{
    use HasFactory;
    protected $table = 'informasi_perusahaan';
    protected $fillable = ['nama_perusahaan', 'deskripsi_perusahaan', 'telepon_perusahaan', 'email_perusahaan', 'alamat_perusahaan', 'cover'];
}
