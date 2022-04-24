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
            'id_trader' => $this->faker->unique()->randomDigit,
            'nm_trader' => $this->faker->name,
            'al_trader' => $this->faker->address,
            'kt_trader' => $this->faker->city,
            'npwp' => $this->faker->numerify('###############'),
            'no_ktp' => $this->faker->numerify('################'),
            'no_izin' => $this->faker->randomDigit,
            'no_hp' => $this->faker->e164PhoneNumber,
            'email' => $this->faker->email,
            'password' => '$2y$10$yzLwDat6kIhj/9XF7TDKG.hskg8RMnOiLGoBQyJyG6Txh5SO6n5LG',
        ];
    }
}
