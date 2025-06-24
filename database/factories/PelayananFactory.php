<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pelayanan;

class PelayananFactory extends Factory
{
    protected $model = Pelayanan::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'days' => 'Senin - Jumat',
            'description' => $this->faker->paragraph(5)
        ];
    }
}
