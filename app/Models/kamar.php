<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kamar extends Model
{
    use HasFactory;

    protected $fillable =[
        'no_kamar',
        'foto',
        'jenis_kamar',
        'deskripsi',
        'fasilitas',
        'harga',
    ];


}
