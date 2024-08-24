<?php

use App\Livewire\Dashboard\UserDashboard;
use App\Models\Rams;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

it('lets an authenticated user visit the dashboard view', function () {
    actingAs(User::factory()->create())
        ->get('/')
        ->assertStatus(200)->assertSee('dashboard')
        ->assertSeeLivewire(UserDashboard::class);

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
    $epsUser = User::factory()->create([
        'client_id' => 1
    ]);

    actingAs($epsUser);
    livewire(UserDashboard::class)
        ->call('newRams')
        ->assertRedirect('/new-rams-menu');
});

it("doesn't redirect to the Create rams menu when you click Add New rams button and are not an EPS user", function () {
    $nonEpsUser = User::factory()->create([
        'client_id' => 2
    ]);

    actingAs($nonEpsUser);
    livewire(UserDashboard::class)
        ->call('newRams')
        ->assertDontSeeText('New RAMS Menu');
});

it('only shows rams from the logged in user when page loads', function () {
    $epsUser = User::factory()->create([
        'name' => 'Paul Finch',
        'client_id' => 1
    ]);
    $secondEpsUser = User::factory()->create([
        'name' => 'Lisa Finch',
        'client_id' => 1
    ]);

    Rams::factory()
        ->for($epsUser)
        ->count(5)
        ->create();

    Rams::factory()
        ->for($secondEpsUser)
        ->count(5)
        ->create();

    actingAs($epsUser);
    livewire(UserDashboard::class)
        ->assertSeeText($epsUser->name)
        ->assertDontSeeText($secondEpsUser->name)
        ->assertViewHas('rams', function ($posts) {
            return count($posts) == 5;
        });

});

it('shows all rams when view all rams is selected', function () {
    $epsUser = User::factory()->create([
        'name' => 'Paul Finch',
        'client_id' => 1
    ]);
    $secondEpsUser = User::factory()->create([
        'name' => 'Lisa Finch',
        'client_id' => 1
    ]);

    Rams::factory()
        ->for($epsUser)
        ->count(5)
        ->create();

    Rams::factory()
        ->for($secondEpsUser)
        ->count(5)
        ->create();

    actingAs($epsUser);
    livewire(UserDashboard::class)
        ->call('toggle')
        ->assertSeeText($epsUser->name)
        ->assertSeeText($secondEpsUser->name)
        ->assertViewHas('rams', function ($posts) {
            return count($posts) == 10;
        });

});

