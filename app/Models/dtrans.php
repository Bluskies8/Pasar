<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class dtrans extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'htrans_id',
        'nama_barang',
        'tipe_berat',
        'jumlah',
        'harga',
        'subtotal',
    ];
}
