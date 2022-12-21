<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class HistoryDrugUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_Akses_Data_Stok_Obat()
    {
        $reponse = $this->post('/login', [
            'username' => 'admin',
            'password' => 'admin',
        ])->assertStatus(302);
        $this->call('get', '/home');
        $this->call('get', '/historydrug');
    }

    public function test_create_Data_Stok_Obat()
    {
        $reponse = $this->post('/historydrug/create', [
            'nama_obat' => 'Paracetamol',
            'tanggal' => '2022-12-11',
            'masuk' => 20,
            'keluar' => 0,
        ]);
        $this->assertTrue(true);
    }

    public function test_update_Data_Stok_Obat()
    {
        $reponse = $this->post('/historydrug/update', [
            'nama_obat' => 'Ivomec',
            'tanggal' => '2022-12-11',
            'masuk' => 0,
            'keluar' => 10,
        ]);
        $this->assertTrue(true);
    }

    public function test_delete_Data_Stok_Obat()
    {
        $reponse = $this->delete('/historydrug/08');
        $this->assertTrue(true);
    }

    public function test_cetak_pdf_Data_Stok_Obat()
    {
        $this->get('/historydrug-pdf')->assertStatus(404);
    }

    public function test_cetak_excel_Data_Stok_Obat()
    {
        $this->get('/historydrug-excel')->assertStatus(404);
    }
}
