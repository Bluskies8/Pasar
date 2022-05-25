<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class htrans extends Model
{
    use HasFactory,SoftDeletes;
    public $incrementing = false;
    protected $fillable = [
        'id',
        'pasar_id',
        'user_id',
        'stand_id',
        'Total_jumlah',
        'Total_harga',
        'transportasi'
    ];
}
