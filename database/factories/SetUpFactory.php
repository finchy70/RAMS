<?php

namespace Database\Factories;

use App\Models\SetUp;
use Illuminate\Database\Eloquent\Factories\Factory;

class SetUpFactory extends Factory
{
    protected $model = SetUp::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'setup' => $this->faker->paragraph
        ];
    }
}
