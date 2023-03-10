<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stand extends Model
{
    use HasFactory;
    protected $fillable = [
        'pasar_id',
        'no_stand',
        'badan_usaha',
        'seller_name',
        'Phone',
        'jenis_jualan',
    ];
}
