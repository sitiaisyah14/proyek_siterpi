<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class CowUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_farm_access()
    {
        $reponse = $this->post('/login', [
            'username' => 'admin',
            'password' => 'admin',
        ])->assertStatus(302);
        $this->call('get', '/home');
        $this->call('get', '/farm');
    }

    public function test_create_farm()
    {
        $reponse = $this->post('/farm/create', [
            'nis' => 908,
            'tanggal_masuk' => '2022-12-11',
            'jk' => 'Betina',
            'status' => 'Belum Terjual',
            'kondisi' => 'Sehat',
            'keterangan' =>'',
        ]);
        $this->assertTrue(true);
    }

    public function test_update_farm()
    {
        $reponse = $this->post('/farm/update', [
            'nis' => 908,
            'tanggal_masuk' => '2022-12-11',
            'jk' => 'Betina',
            'status' => 'Belum Terjual',
            'kondisi' => 'Sehat',
            'keterangan' =>'',
        ]);
        $this->assertTrue(true);
    }

    public function test_delete_farm()
    {
        $reponse = $this->delete('/farm/809');
        $this->assertTrue(true);
    }

    public function test_cetak_pdf_farm()
    {
        $this->get('/farm-pdf')->assertStatus(404);
    }

    public function test_cetak_excel_farm()
    {
        $this->get('/farm-excel')->assertStatus(404);
    }


}
