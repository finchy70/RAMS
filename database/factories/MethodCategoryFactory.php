<?php

namespace Database\Factories;

use App\Models\MethodCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class MethodCategoryFactory extends Factory
{
    protected $model = MethodCategory::class;

    public function definition(): array
    {
        return [
            'category' => $this->faker->colorName
        ];
    }
}
