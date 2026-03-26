<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projek extends Model
{
    protected $table = 'projek';

    protected $fillable = ['title', 'description', 'tags', 'thumb_color', 'gambar', 'demo_url', 'github_url', 'urutan'];

    protected $casts = ['tags' => 'array'];
}
