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
            'kode_counter' => $this->faker->unique()->randomNumber(8, true),
            'nama_counter' => $this->faker->unique()->numerify('Jasper-#########'),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'penanggungJawab' => $this->faker->name,
            'id_kurir' => $this->faker->randomElement([0, 1, 2, 3]),
            'password' => '$2y$10$wMPua3iytghAjW3nmM.U2u0hUigj80FreoSCzuzBfKhRnDErUHAdO',
        ];
    }
}
