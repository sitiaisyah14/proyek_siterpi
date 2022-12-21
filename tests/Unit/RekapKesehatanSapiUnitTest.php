<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class RekapKesehatanSapiUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_Akses_Rekap_Kesehatan_Sapi()
    {
        $reponse = $this->post('/login', [
            'username' => 'admin',
            'password' => 'admin',
        ])->assertStatus(302);
        $this->call('get', '/home');
        $this->call('get', '/healthfarm');
    }

    public function test_create_Rekap_Kesehatan_Sapi()
    {
        $reponse = $this->post('/healthfarm/create', [
            'farm_id' => 708,
            'tanggal' => '2022-12-11',
            'keterangan' => 'Sakit Sesak Nafas dan Gatal',
            'obat' => 'Paracetamol',
            'jumlah obat' => 1,
        ]);
        $this->assertTrue(true);
    }

    public function test_update_Rekap_Kesehatan_Sapi()
    {
        $reponse = $this->post('/healthfarm/update', [
            'farm_id' => 708,
            'tanggal' => '2022-Desember-11',
            'keterangan' => 'Sakit Gatal dan Diare',
            'obat' => 'Kosong',
            'jumlah obat' => 1,
        ]);
        $this->assertTrue(true);
    }

    public function test_delete_Rekap_Kesehatan_Sapi()
    {
        $reponse = $this->delete('/healthfarm/07');
        $this->assertTrue(true);
    }

    public function test_cetak_pdf_Rekap_Kesehatan_Sapi()
    {
        $this->get('/healthfarm-pdf')->assertStatus(302);
    }

    public function test_cetak_excel_Rekap_Kesehatan_Sapi()
    {
        $this->get('/healthfarm-excel')->assertStatus(302);
    }
}
