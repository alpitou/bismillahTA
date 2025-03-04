<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Laporan;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaporanFactory extends Factory
{
    protected $model = Laporan::class;

    public function definition()
    {
        return [
            'kodeLaporan' => $this->faker->unique()->numberBetween(1000, 9999),
            'nomor_lhp' => $this->faker->unique()->numberBetween(1000, 9999),
            'user_id' => User::factory(),
            'judul' => $this->faker->sentence,
            'tgl_pemeriksaan' => $this->faker->date(),
            'ringkasan_hasil' => $this->faker->paragraph,
            'uraian_hasil' => $this->faker->text,
            'kesimpulan' => $this->faker->paragraph,
            'saran' => $this->faker->paragraph,
            'ttd' => $this->faker->name,
            'namaTtd' => $this->faker->name
        ];
    }
}