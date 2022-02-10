<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JPPFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kodeCounter' => $this->faker->unique()->randomDigit,
            'id_kurir' => $this->faker->randomElement([0, 1, 2]),
            'latitude' => $this->faker->latitude(),
            'longtitude' => $this->faker->longitude(),
            'penanggungJawab' => $this->faker->name
        ];
    }
}
