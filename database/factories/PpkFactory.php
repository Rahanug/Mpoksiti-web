<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Jpp;
use App\Models\Trader;

class PpkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'no_ppk' => $this->faker->numerify('E/E/######'),
            'no_aju_ppk' => $this->faker->numerify('E/E/######'), 
            'jumlah' => $this->faker->numerify('##'),
            'satuan' => $this->faker->randomDigit,
            'status' => null,
            'nm_penerima' => $this->faker->name,
            'id_trader' => $this->faker->randomElement(Trader::all())['id_trader'],
            'kode_counter_jpp'=> $this->faker->randomElement(Jpp::all())['kode_counter']
        ];
    }
}
