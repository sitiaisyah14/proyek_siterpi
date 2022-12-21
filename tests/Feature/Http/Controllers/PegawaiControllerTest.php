<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PegawaiControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function test_employee_can_access()
    {
        $this->withoutExceptionHandling();
        $user =  User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('employee');
        $response->assertStatus(200);
    }

    use WithFaker;

    public function test_store_data_employee()
    {
        $this->withoutExceptionHandling();
        $user =  User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('employee.store'),[
            'nip' => $this->faker->numerify('PGW#####'),
            'foto' => 'foto.jpg',
            'nama' => 'Aisyah',
            'jk' => 'P',
            'tempat_lahir' => "Pasuruan",
            'tgl_lahir' => $this->faker->date(),
            ]);

            $response->assertStatus(302);
    }
}
