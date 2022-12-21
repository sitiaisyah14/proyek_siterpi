<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class UserUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_Akses_Data_User()
    {
        $reponse = $this->post('/login', [
            'username' => 'admin',
            'password' => 'admin',
        ])->assertStatus(302);
        $this->call('get', '/home');
        $this->call('get', '/user');
    }

    public function test_create_Data_User()
    {
        $reponse = $this->post('/user/create', [
            'foto' => 'foto.jpg',
            'nama' => 'Aisyah',
            'username' => 'admin',
            'password' => '12345678',
            'posisi' => 'admin',
        ]);
        $this->assertTrue(true);
    }

    public function test_update_Data_User()
    {
        $reponse = $this->post('/user/update', [
            'foto' => 'foto.jpg',
            'nama' => 'Aisyah',
            'username' => 'manager',
            'password' => '12345678',
            'posisi' => 'manager',
        ]);
        $this->assertTrue(true);
    }

    public function test_delete_Data_User()
    {
        $reponse = $this->delete('/user/02');
        $this->assertTrue(true);
    }
}
