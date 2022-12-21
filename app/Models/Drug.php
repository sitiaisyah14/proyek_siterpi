<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;
    protected $fillable =[
        'nama_obat',
        'stok_akhir'
    ];
    public function drugHistory()
    {
        return $this->hasMany(Drughistory::class,'drug_id');
    }
}
