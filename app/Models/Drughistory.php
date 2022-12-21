<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drughistory extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'obat_id',
        'tanggal',
        'masuk',
        'keluar',
        'cowhealth_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }
    public function cowHealth() {
        return $this->belongsTo(CowHealthHistory::class,'cowhealth_id');
    }
}
