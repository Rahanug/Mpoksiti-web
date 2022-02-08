<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JenisKurirFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'namaKurir' => $this->faker->unique()->randomElement(['JNE', 'JNT', 'TIKI', 'SiCepat'])
        ];
    }
}
