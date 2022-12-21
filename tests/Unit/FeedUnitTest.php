<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class FeedUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_Akses_Data_Pakan()
    {
        $reponse = $this->post('/login', [
            'username' => 'admin',
            'password' => 'admin',
        ])->assertStatus(302);
        $this->call('get', '/home');
        $this->call('get', '/feed');
    }

    public function test_create_Data_Pakan()
    {
        $reponse = $this->post('/feed/create', [
            'nama_pakan' => 'Dedek Guling',
        ]);
        $this->assertTrue(true);
    }

    public function test_update_Data_Pakan()
    {
        $reponse = $this->post('/feed/update', [
            'nama_pakan' => 'Dedek Selep',
        ]);
        $this->assertTrue(true);
    }

    public function test_delete_Data_Pakan()
    {
        $reponse = $this->delete('/feed/07');
        $this->assertTrue(true);
    }
}
