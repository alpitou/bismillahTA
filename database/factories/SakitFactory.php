<?php

namespace Database\Factories;

use App\Models\Sakit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SakitFactory extends Factory
{
    protected $model = Sakit::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'kodeSurat' => $this->faker->numberBetween(100, 999),
            'noSurat' => $this->faker->unique()->numberBetween(1000, 9999),
            'nama' => $this->faker->name(),
            'nik' => $this->faker->numerify('################'),
            'tempatTglLahir' => $this->faker->city(),
            'pekerjaan' => $this->faker->jobTitle(),
            'alamat' => $this->faker->address(),
            'keterangan' => $this->faker->sentence(),
            'tglSurat' => $this->faker->date(),
            'ttd' => $this->faker->name(),
            'namaTtd' => $this->faker->name(),
        ];
    }
}