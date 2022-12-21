<?php

namespace Tests\Unit;

use Tests\TestCase;

class LoginUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_login_system()
    {
        $reponse = $this->post('/login', [
            'username' => 'admin',
            'password' => 'admin',
        ])->assertStatus(302);
        $this->call('get', '/home');
    }

    public function test_login_password_salah()
    {
        $reponse = $this->post('/login', [
            'username' => 'admin',
            'password' => 123456,
        ])->assertStatus(302);
        $this->call('get', '/home');
    }

    public function test_login_username_salah()
    {
        $reponse = $this->post('/login', [
            'username' => 8374384,
            'password' => '123456',
        ])->assertStatus(302);
        $this->call('get', '/home');
    }

    public function test_login_username_salah_dan_password_salah()
    {
        $reponse = $this->post('/login', [
            'username' => 7236762,
            'password' => 123456,
        ])->assertStatus(302);
        $this->call('get', '/home');
    }

}
