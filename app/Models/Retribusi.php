<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retribusi extends Model
{
    use HasFactory;
    protected $fillable = [
        'pasar_id',
        'retribusi',
        'listrik',
        'kuli',
        'sampah',
        'ponten_siang',
        'ponten_malam',
        'parkir_siang',
        'parkir_malam',
        'motor_siang',
        'motor_malam',
    ];
    public function tambahan()
    {
        return $this->hasMany(retribusitambahan::class,'retribusi_id','id');
    }
}
