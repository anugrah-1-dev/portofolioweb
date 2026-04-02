<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hki extends Model
{
    protected $table = 'hki';

    protected $fillable = [
        'nomor_pencatatan',
        'title',
        'authors',
        'jenis_hki',
        'year',
        'url',
        'description',
        'urutan',
    ];
}
