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
    public function details()
    {
        return $this->hasMany(dtrans::class,'htrans_id','id');
    }
    public function stand()
    {
        return $this->belongsTo(stand::class,'stand_id','id');
    }
    public function checker()
    {
        return $this->belongsTo(user::class,'user_id','id');
    }
}
