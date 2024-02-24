<?php

namespace Database\Factories;

use App\Models\Method;
use App\Models\MethodCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class MethodFactory extends Factory
{
    protected $model = Method::class;

    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence,
            'method_category_id' => MethodCategory::factory()->create(),
            'method' => $this->faker->paragraph
        ];
    }
}
