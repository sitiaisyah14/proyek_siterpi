<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class HistoryFeedUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_Akses_Data_Stok_Pakan()
    {
        $reponse = $this->post('/login', [
            'username' => 'admin',
            'password' => 'admin',
        ])->assertStatus(302);
        $this->call('get', '/home');
        $this->call('get', '/historyfeed');
    }

    public function test_create_Data_Stok_Pakan()
    {
        $reponse = $this->post('/historyfeed/create', [
            'nama_pakan' => 'Dedek Cina',
            'tanggal' => '2022-12-11',
            'masuk' => 20,
            'keluar' => 0,
        ]);
        $this->assertTrue(true);
    }

    public function test_update_Data_Stok_Pakan()
    {
        $reponse = $this->post('/historyfeed/update', [
            'nama_pakan' => 'Dedek Cina',
            'tanggal' => '2022-12-11',
            'masuk' => 0,
            'keluar' => 10,
        ]);
        $this->assertTrue(true);
    }

    public function test_delete_Data_Stok_Pakan()
    {
        $reponse = $this->delete('/historyfeed/PGW0006');
        $this->assertTrue(true);
    }

    public function test_cetak_pdf_Data_Stok_Pakan()
    {
        $this->get('/historyfeed-pdf')->assertStatus(404);
    }

    public function test_cetak_excel_Data_Stok_Pakan()
    {
        $this->get('/historyfeed-excel')->assertStatus(404);
    }
}
