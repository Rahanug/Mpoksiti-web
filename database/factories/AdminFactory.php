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
            'email' => 'affannovian@gmail.com',
            'password' => '$2y$10$fVmfaQc/iQTCoAWL5U0v8u/3aX26e.Gipp444gr2oND/XFmZHkOrO',
            'jenis_admin' => 'Admin Mobile',
        ];
    }
}
