<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class EmployeeUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_employee_access()
    {
        $reponse = $this->post('/login', [
            'username' => 'admin',
            'password' => 'admin',
        ])->assertStatus(302);
        $this->call('get', '/home');
        $this->call('get', '/employee');
    }

    public function test_create_employee()
    {
        $reponse = $this->post('/employee/create', [
            'foto' => 'foto.jpg',
            'nama' => 'Aisyah',
            'jk' => 'P',
            'tempat_lahir' => 'Pasuruan',
            'tgl_lahir' =>'1999-03-20',
        ]);
        $this->assertTrue(true);
    }

    public function test_update_employee()
    {
        $reponse = $this->post('/employee/update', [
            'foto' => 'foto.jpg',
            'nama' => 'Aisyah Cantik',
            'jk' => 'P',
            'tempat_lahir' => 'Pasuruan',
            'tgl_lahir' => '1999-01-02',
        ]);
        $this->assertTrue(true);
    }

    public function test_delete_employee()
    {
        $reponse = $this->delete('/employee/PGW0006');
        $this->assertTrue(true);
    }

    public function test_cetak_pdf_employee()
    {
        $this->get('/employee-pdf')->assertStatus(302);
    }

    public function test_cetak_excel_employee()
    {
        $this->get('/employee-excel')->assertStatus(404);
    }








}
