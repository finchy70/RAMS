<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Client;
use App\Models\Method;
use App\Models\Prelim;
use App\Models\Rams;
use App\Models\SetUp;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Paul Finch',
            'email' => 'finchy70@gmail.com',
            'password' => bcrypt('shandy'),
            'email_verified_at' => now()
        ]);


        Rams::factory()
            ->for($user)
            ->count(20)
            ->create();
    }

}

