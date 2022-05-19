<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class htrans extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'pasar_id',
        'user_id',
        'stand_id',
        'Total_jumlah',
        'Total_harga',
    ];
}
