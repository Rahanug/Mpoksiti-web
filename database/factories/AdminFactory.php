<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => 'Admin@gmail.com',
            'password' => '$2y$10$wMPua3iytghAjW3nmM.U2u0hUigj80FreoSCzuzBfKhRnDErUHAdO',
            'jenis_admin' => 'Admin',
        ];
    }
}
