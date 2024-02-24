<?php

namespace Database\Factories;

use App\Models\Prelim;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrelimFactory extends Factory
{
    protected $model = Prelim::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'prelims' => $this->faker->paragraph
        ];
    }
}
