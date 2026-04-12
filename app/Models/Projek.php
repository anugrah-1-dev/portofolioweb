<?php

namespace App\Models;

use App\Support\MediaUrl;
use Illuminate\Database\Eloquent\Model;

class Projek extends Model
{
    protected $table = 'projek';

    protected $fillable = [
        'title', 'description', 'tags', 'thumb_color', 'gambar', 'galeri',
        'demo_url', 'github_url', 'urutan',
    ];

    protected $casts = ['tags' => 'array', 'galeri' => 'array'];

    /** Returns all image URLs (gambar first, then galeri) */
    public function allImages(): array
    {
        $images = [];
        if ($this->gambar) $images[] = MediaUrl::from($this->gambar);
        foreach ($this->galeri ?? [] as $g) {
            $images[] = MediaUrl::from($g);
        }
        return $images;
    }
}
