<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stand extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_stand',
        'seller_name',
        'Phone',
        'jenis_jualan',
        'tambahan_start',
        'tambahan_end'
    ];
}
