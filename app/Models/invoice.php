<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $fillable = [
        'id',
        'pasar_id',
        'stand_id',
        'total',
        'listrik',
        'parkir',
        'netto'
    ];
    public function stand()
    {
        return $this->belongsTo(stand::class,'stand_id','id');
    }
}
