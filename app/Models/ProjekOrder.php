<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjekOrder extends Model
{
    protected $table = 'projek_orders';

    protected $fillable = [
        'projek_id', 'nama', 'email', 'harga',
        'token', 'invoice_id', 'invoice_url',
        'status', 'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function projek()
    {
        return $this->belongsTo(Projek::class, 'projek_id');
    }
}
