<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('shows the welcome screen', function () {
    get('/')->assertSeeText('Welcome to EPS-rams');
});

it('shows the dashboard screen', function () {
    actingAs(User::factory()->create());
   get('/dashboard')->assertSeeText('dashboard');
});
