<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class retribusitambahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'retribusi_id',
        'type',
        'name',
        'value',
    ];
}
