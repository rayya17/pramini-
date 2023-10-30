<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class kamar extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class, 'kamar_id');
    }

  
}
