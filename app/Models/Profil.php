<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $table = 'profil';

    protected $fillable = ['nama', 'bio1', 'bio2', 'status', 'lokasi', 'bahasa', 'keahlian', 'foto', 'kata_penyemangat', 'no_whatsapp', 'cv_file'];

    protected $casts = ['keahlian' => 'array', 'kata_penyemangat' => 'array'];
}
