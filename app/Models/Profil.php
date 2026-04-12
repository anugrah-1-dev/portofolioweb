<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $table = 'profil';

    protected $fillable = ['nama', 'bio1', 'bio2', 'deskripsi_home', 'footer_tagline', 'status', 'lokasi', 'bahasa', 'keahlian', 'logo', 'foto', 'foto2', 'hero_role1', 'hero_role2', 'hero_status', 'kata_penyemangat', 'no_whatsapp', 'cv_file'];

    protected $casts = ['keahlian' => 'array', 'kata_penyemangat' => 'array'];
}
