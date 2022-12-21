<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;
    protected $fillable =[
        'nama_pakan',
        'stok_akhir'
    ];
    public function feedHistory()
    {
        return $this->hasMany(Feedhistory::class,'feed_id');
    }

}
