<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class employeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nip' => $this->faker->numerify('PGW#####'),
            'foto' => $this->faker->image(),
            'nama' => $this->faker->name(),
            'jk' => $this->faker->randomElement(['L', 'P']),
            'tempat_lahir' => $this->faker->address(),
            'tgl_lahir' =>$this->faker->date($format = 'Y-m-d'),
        ];
    }
}
