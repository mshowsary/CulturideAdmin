<?php

use App\Models\User;
use App\Models\Role;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
    actingAs(User::where('email', 'admin@admin.com')->first());
});

it('affiche la page d\'index des utilisateurs', function () {
    get(route('admin.users.index'))
        ->assertStatus(200)
        ->assertViewIs('admin.users.index');
});

it('affiche le formulaire de création d\'utilisateur', function () {
    get(route('admin.users.create'))
        ->assertStatus(200)
        ->assertViewIs('admin.users.create');
});

it('crée un nouvel utilisateur et redirige vers l\'index', function () {
    $role = Role::first();
    $userData = User::factory()->make()->toArray() + [
        'password' => 'password', 
        'roles' => [$role->id]
    ];

    post(route('admin.users.store'), $userData)
        ->assertRedirect(route('admin.users.index'));
    $this->assertDatabaseHas('users', ['email' => $userData['email']]);
});

it('affiche la page de modification d\'utilisateur', function () {
    $user = User::factory()->create();
    get(route('admin.users.edit', $user))
        ->assertStatus(200)
        ->assertViewIs('admin.users.edit')
        ->assertViewHas('user', $user);
});

it('met à jour l\'utilisateur et redirige vers l\'index', function () {
    $user = User::factory()->create();
    $role = Role::first();
    $updatedUserData = User::factory()->make()->toArray() + [
        'roles' => [$role->id]
    ];

    put(route('admin.users.update', $user), $updatedUserData)
        ->assertRedirect(route('admin.users.index'));
    $this->assertDatabaseHas('users', ['email' => $updatedUserData['email']]);
});

it('affiche la page de détails de l\'utilisateur', function () {
    $user = User::factory()->create();
    get(route('admin.users.show', $user))
        ->assertStatus(200)
        ->assertViewIs('admin.users.show')
        ->assertViewHas('user', $user);
});

it('supprime l\'utilisateur et redirige', function () {
    $user = User::factory()->create();
    $initialCount = User::count();

    delete(route('admin.users.destroy', $user))
        ->assertRedirect();
    $this->assertEquals(User::count(), $initialCount - 1);
});

it('supprime plusieurs utilisateurs', function () {
    $users = User::factory()->count(3)->create();
    $initialCount = User::count();
    $userIds = $users->pluck('id')->toArray();

    delete(route('admin.users.massDestroy'), ['ids' => $userIds])
        ->assertStatus(204);
    $this->assertEquals(User::count(), $initialCount - 3); 
});
