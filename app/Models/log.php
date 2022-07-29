<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class log extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'pasar_id',
        'keterangan',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
