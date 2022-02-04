<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TraderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_trader' => $this->faker->randomDigit,
            'nm_trader' => $this->faker->name,
            'al_trader' => $this->faker->address,
            'kt_trader' => $this->faker->city,
            'npwp' => $this->faker->numerify('###############'),
            'no_ktp' => $this->faker->numerify('################'),
            'no_izin' => $this->faker->randomDigit,
            'no_hp' => $this->faker->e164PhoneNumber,
            'email' => $this->faker->email,
            'password' => '$2y$10$nc3oRB2v0zPVerRW7Peaiu.KwvBgFn1IulhUND0V2piB9d2MbVQue',
        ];
    }
}
