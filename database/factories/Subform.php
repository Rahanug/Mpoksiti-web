<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FormModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_form' => $this->faker->unique()->randomElement([
                'Nama Produk/Product Name', 
                'Nama Species/Species Name', 
                'Jenis Olahan/Processed types',
                'Kemasan / Jumlah Kemasan',
                'Packaging / Total Packaging',
            ]),
            'status' => 1
        ];
    }
}
