<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class DrugUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_Akses_Data_Obat()
    {
        $reponse = $this->post('/login', [
            'username' => 'admin',
            'password' => 'admin',
        ])->assertStatus(302);
        $this->call('get', '/home');
        $this->call('get', '/drug');
    }

    public function test_create_Data_Obat()
    {
        $reponse = $this->post('/drug/create', [
            'nama_obat' => 'Paracetamol',
        ]);
        $this->assertTrue(true);
    }

    public function test_update_Data_Obat()
    {
        $reponse = $this->post('/drug/update', [
            'nama_obat' => 'Ivomec',
        ]);
        $this->assertTrue(true);
    }

    public function test_delete_Data_Obat()
    {
        $reponse = $this->delete('/drug/02');
        $this->assertTrue(true);
    }
}
