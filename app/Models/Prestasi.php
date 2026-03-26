<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasi';

    protected $fillable = ['icon', 'year', 'title', 'description', 'badge', 'kategori', 'foto', 'urutan'];
}
