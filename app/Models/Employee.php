<?php

namespace App\Models;

use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use AutoNumberTrait;
    use HasFactory;

    protected $fillable =[
        'nip',
        'foto',
        'nama',
        'jk',
        'tempat_lahir',
        'tgl_lahir'
    ];
    public function getAutoNumberOptions()
    {
        return [
            'nip' => [
                'format' => function (){
                    return 'PGW'.'?';
                },
                'length' => 5,
            ]
        ];
    }
    public function getJenisKelamin(){
        $jk = $this->jk;

        if ($jk == 'L') {
              $text = 'Laki-Laki';
        } else {
            $text = 'Perempuan';
        }

        return $text;
    }
}
