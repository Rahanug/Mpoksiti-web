<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ppk;

class vDtlPelaporanFactory extends Factory
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
            'id_ppk' => $this->faker->randomElement(Ppk::all())['id_ppk'],
            'id_kd_ikan' => $this->faker->randomDigit,
            'kd_ikan_lokal_ol' => $this->faker->randomDigit,
            'kd_ikan' => $this->faker->unique()->randomElement(['5065','C00195','C00070','C01245','C00070']),
            'nm_lokal' => ('nm_lokal'),
            'nm_umum' => ('nm_umum'),
            'nm_latin' => ('nm_latin'),
            'jumlah' => $this->faker->randomDigit,
            'satuan' => $this->faker->randomDigit,
            'hscode' => ('test'),
            'no_urut_hs' => ('test'),
            'kd_tarif' => ('test'),
            'keterangan' => ('test'),
            'tarif' => ('test'),
            'kd_kel_ikan' => ('test'),
            'jn_pemeriksaan' => ('test'),
            'id_satuan' => ('test'),
            'satuan_int' => ('test'),
            'satuan_nsw' => ('test'),
            'kd_kel_tarif' => ('test'),
            'nm_kel_tarif' => ('test'),
            'id_kd_lokal' => ('test'),
            'kd_jenis_kel' => ('test'),
            'kelas' => ('test'),
            'kelompok' => ('test'),
            'ket_kelompok' => ('test'),
            'konsumsi' => ('test'),
            'tawar' => ('test'),
            'hidup' => ('test'),
            'bentuk' => ('test'),
            'hias' => ('test'),
            'pelagis' => ('test'),
            'nilai' => ('test'),
            'nilai_ref' => ('test'),
            'status' => ('test'),
            'ukuran' => ('test'),
            'pembagian' => ('test'),
            'ket_kelas' => ('test'),
            'no_hs' => ('test'),
            'grup_0' => ('test'),
            'grup_1' => ('test'),
            'grup_2' => ('test'),
            'des' => ('test'),
            'des_1' => ('test'),
            'des_2' => ('test'),
            'des_3' => ('test'),
            'des_4' => ('test'),
            'no_urut' => ('test'),
            'nilai_percmdts' => ('test'),
            'jml_kg' => ('test'),
            'satuan_kg' => ('test'),
            'nilai_usd_cmdts' => ('test'),
            'jml_kirim' => ('test'),
            'jml_kg_kirim' => ('test'),
            'ket_bentuk' => ('test'),
            'id_kel_ikan' => ('test'),
            'nm_kel_ikan' => ('test'),
            'asal_cmdts' => ('test'),
            'konsumsi_ppk' => ('test'),
        ];
    }
}
