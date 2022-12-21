<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CowHealthHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'farm_id',
        'tanggal',
        'keterangan'
    ];
    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
    public function drugHistories(){
        return $this->hasMany(Drughistory::class,'cowhealth_id');
    }
}
