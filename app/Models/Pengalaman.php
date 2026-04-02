<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengalaman extends Model
{
    protected $table = 'pengalaman';

    protected $fillable = [
        'nama_organisasi', 'peran', 'deskripsi',
        'foto_sertifikat',
        'tahun_mulai', 'tahun_selesai', 'jenis', 'urutan',
    ];
}
