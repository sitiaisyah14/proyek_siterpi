<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Farm extends Model
{
    // use AutoNumberTrait;
    use HasFactory;
    protected $fillable =[
        'nis',
        'jk',
        'status',
        'kondisi',
        'tanggal_masuk',
        'keterangan'
    ];
    // public function getAutoNumberOptions(){
    //     return [
    //         'nis' => [
    //             'format' => function (){
    //                 return 'S'. '?';
    //             },
    //             'length' => 4,
    //         ]
    //     ];
    // }
    public function cowHealth()
    {
        return $this->hasMany(CowHealthHistory::class);
    }
}
