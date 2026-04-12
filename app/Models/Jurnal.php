<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $table = 'jurnal';

    protected $fillable = ['icon', 'title', 'authors', 'journal_name', 'year', 'indexed_by', 'url', 'file_sertifikat', 'description', 'urutan'];
}
