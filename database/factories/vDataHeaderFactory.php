<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Trader;

class vDataHeaderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'no_ppk' => $this->faker->numerify('E/E/######'),
            'no_aju_ppk' => $this->faker->numerify('E/E/######'),
            'id_trader' => $this->faker->randomElement(Trader::all())['id_trader'],
            'nm_trader' => $this->faker->name,
            'tgl_ppk' =>  $this->faker->date(),
            'kd_kegiatan' => $this->faker->randomElement(['K', 'E'])
        ];
    }
}
