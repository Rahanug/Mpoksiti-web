<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KategoriDokumenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_kategori' => $this->faker->unique()->randomElement(['Dokumen HACCP', 'Sertifikasi Ikan', 'BPOM', 'Persetujuan Impor']),
            "status" => ('1'),
            "instansi_penerbit" => $this->faker->randomElement(['KIPM', 'KOMINFO', 'KEMENKES', 'KKP']),
        ];
    }
}
