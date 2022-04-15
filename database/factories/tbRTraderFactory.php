<?php

namespace Database\Factories;

use App\Models\Trader;
use Illuminate\Database\Eloquent\Factories\Factory;

class tbRTraderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_trader' => $this->faker->randomElement(Trader::all())['id_trader'],
            'nm_trader' => $this->faker->name,
            'al_trader' => $this->faker->address,
            'kt_trader' => $this->faker->numerify('####'),
            'kd_negara' => $this->faker->randomElement(['ID', 'US']),
            'npwp' => $this->faker->numerify('################'),
            'no_ktp' => $this->faker->numerify('################'),
            'no_izin' => $this->faker->numerify('###/##/II/####-PM'),
            'email' => $this->faker->email,
        ];
    }
}
