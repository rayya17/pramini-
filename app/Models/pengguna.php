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
        'alamat',
        'ktp',
        'checkin_date', 
        'checkout_date', 
        'status'
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'kamar_id');
    }


}
