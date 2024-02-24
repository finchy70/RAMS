<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Method;
use App\Models\Prelim;
use App\Models\Rams;
use App\Models\SetUp;
use Illuminate\Database\Eloquent\Factories\Factory;

class RamsFactory extends Factory
{
    protected $model = Rams::class;

    public function definition(): array
    {
        return [
            'job' => $this->faker->randomNumber(4),
            'site' => $this->faker->city,
            'client_id' => Client::factory()->create(),
            'method_id' => Method::factory()->create(),
            'prelim_id' => Prelim::factory()->create(),
            'setup_id' => SetUp::factory()->create(),
            'works_date' => now()
        ];
    }
}
