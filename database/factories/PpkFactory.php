<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'status' => ('Pengajuan - Disetujui'),
            'nm_penerima' => $this->faker->name,
            'id_trader' => ('1'),
        ];
    }
}
