<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projek extends Model
{
    protected $table = 'projek';

    protected $fillable = [
        'title', 'description', 'tags', 'thumb_color', 'gambar',
        'demo_url', 'github_url', 'tipe_akses', 'harga', 'urutan',
    ];

    protected $casts = ['tags' => 'array'];

    public function isBerbayar(): bool
    {
        return $this->tipe_akses === 'berbayar' && $this->harga > 0;
    }

    public function hargaFormatted(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}
