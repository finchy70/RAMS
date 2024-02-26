<?php

use App\Livewire\dashboard\UserDashboard;
use App\Models\Rams;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

it('lets an authenticated user visit the dashboard view', function () {
    actingAs(User::factory()->create())->get('/')->assertStatus(200)->assertSee('Dashboard')->assertSeeLivewire(UserDashboard::class);

});

it('doesnt let an unauthorised user visit the dashboard view', function (){
    get('/')->assertStatus(302)->assertRedirect(route('login'));
});

it('displays a list of rams created by the logged in user.', closure: function () {
    $user = User::factory()->create();
    $rams = Rams::factory()->count(3)->create([
        'user_id' => $user->id,
    ]);

    actingAs($user);
    livewire(UserDashboard::class)
        ->assertSeeText($rams[0]->user->name)
        ->assertSeeText($rams[0]->client->name)
        ->assertSeeText($rams[0]->site)
        ->assertSeeText($rams[0]->jobNumber);
});

it('doesnt display rams created by a different user.', closure: function () {
    $userLoggedIn = User::factory()->create();
    $userNotLoggedIn = User::factory()->create();
    $rams = Rams::factory()->count(3)->create([
        'user_id' => $userNotLoggedIn->id,
    ]);

    actingAs($userLoggedIn);
    livewire(UserDashboard::class)
        ->assertDontSeeText($rams[0]->user->name)
        ->assertDontSeeText($rams[0]->client->name)
        ->assertDontSeeText($rams[0]->site)
        ->assertDontSeeText($rams[0]->jobNumber);
});

it('shows the Add New Rams button', function () {
    actingAs( User::factory()->create());
    livewire(UserDashboard::class)
        ->assertSee('Add New RAMS');
});

it('redirects to the Create rams menu when you click Add New rams button as an EPS user', function () {
    $user = User::factory()->create();
    actingAs($user);
    livewire(UserDashboard::class)
        ->call('newRams')
        ->assertRedirect('/new-rams-menu');
});

