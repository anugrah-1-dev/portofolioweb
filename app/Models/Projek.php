<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Projek extends Model
{
    protected $table = 'projek';

    protected $fillable = [
        'title', 'description', 'tags', 'thumb_color', 'gambar', 'galeri',
        'demo_url', 'github_url', 'tipe_akses', 'harga', 'urutan',
    ];

    protected $casts = ['tags' => 'array', 'galeri' => 'array'];

    public function isBerbayar(): bool
    {
        return $this->tipe_akses === 'berbayar' && $this->harga > 0;
    }

    public function hargaFormatted(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    /** Returns all image URLs (gambar first, then galeri) */
    public function allImages(): array
    {
        $images = [];
        if ($this->gambar) $images[] = Storage::url($this->gambar);
        foreach ($this->galeri ?? [] as $g) {
            $images[] = Storage::url($g);
        }
        return $images;
    }
}
