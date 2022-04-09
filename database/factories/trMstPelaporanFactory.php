<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\vForQr;

class trMstPelaporanFactory extends Factory
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
            'id_ppk' => $this->faker->unique()->randomElement(vForQr::all())['id_ppk'],
            'code_qr' => $this->faker->randomElement(['0100022KR90S1Z8', '0100022KVOP3OMY', '0100022KV3CGGBZ', '0100022KI92WZ2G', '0100022KGM3EXNP']),
        ];
    }
}
