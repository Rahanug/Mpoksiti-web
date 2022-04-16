<?php

namespace Database\Factories;

use App\Models\Jpp;
use Illuminate\Database\Eloquent\Factories\Factory;

class JPPNotifFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_jpp' => $this->faker->unique()->randomElement(Jpp::all())['id'],
            'last_notif' => date('Y-m-d H:i:s')
        ];
    }
}
