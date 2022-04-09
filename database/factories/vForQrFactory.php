<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\vDataHeader;

class vForQrFactory extends Factory
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
            'id_ppk' => $this->faker->unique()->randomElement(vDataHeader::all())['id_ppk'],
            'nm_kegiatan' => ('Domestik Keluar'),
            'id_sertifikat' => $this->faker->numerify('######'),
            'no_sertifikat' => $this->faker->numerify('P#/KI-D#/##.#/I/2022/######'),
            'tgl_sertifikat' => $this->faker->date(),
            'seri' => $this->faker->numerify('#########'),
            'kd_pel_muat' => $this->faker->numerify('ID###'),   
            'kd_pel_bongkar' => $this->faker->numerify('ID###'),
        ];
    }
}
