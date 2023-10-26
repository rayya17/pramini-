<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class pengguna extends Model
{
    use HasFactory;

    protected $fillable =[
        'kamar_id',
        'user_id',
        'no_telp',
        'transaksiadmin_id',
        'alamat',
        'ktp',
        'checkin_date',
        'checkout_date',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function kamar(): BelongsTo
    {
        return $this->belongsTo(kamar::class, 'kamar_id');
    }

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(transaksiadmin::class, 'transaksiadmin_id');
    }


}
