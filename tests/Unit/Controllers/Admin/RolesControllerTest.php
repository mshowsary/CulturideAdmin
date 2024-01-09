<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

beforeEach(function() {
    $this->seed(DatabaseSeeder::class);
    actingAs(User::where('id', 1)->first());
});

it('affiche la page d\'index des roles', function () {
    get(route('admin.roles.index'))
        ->assertStatus(200)
        ->assertViewIs('admin.roles.index');
});



it('affiche le formulaire de création de role', function () {
    get(route('admin.roles.create'))
        ->assertStatus(200)
        ->assertViewIs('admin.roles.create');
});


/*
it('crée une nouvelle role et redirige vers l\'index', function () {
    $roleData = Role::factory()->make()->toArray();

    post(route('admin.roles.store'), $roleData)
        ->assertRedirect(route('admin.roles.index'));

    $this->assertDatabaseHas('roles', $roleData);
});
*/



it('affiche la page de modification de role', function () {
    $role = Role::factory()->create();

    get(route('admin.roles.edit', $role))
        ->assertStatus(200)
        ->assertViewIs('admin.roles.edit')
        ->assertViewHas('role', $role);
});

/*
it('met à jour la role et redirige vers l\'index', function () {
    $role = Role::factory()->create();
    $updatedRoleData = Role::factory()->make()->toArray();

    put(route('admin.roles.update', $role), $updatedRoleData)
        ->assertRedirect(route('admin.roles.index'));

    $this->assertDatabaseHas('roles', $updatedRoleData);
}); */



it('affiche la page de détails de role', function () {
    $role = Role::factory()->create();

    get(route('admin.roles.show', $role))
        ->assertStatus(200)
        ->assertViewIs('admin.roles.show')
        ->assertViewHas('role', $role);
});

it('supprime la role et redirige', function () {
    $role = Role::factory()->create();

    $initialCount = Role::whereNull('deleted_at')->count();
    fwrite(STDERR, print_r("Initial Count: {$initialCount}\n", TRUE));

    delete(route('admin.roles.destroy', $role))
        ->assertRedirect();

    $finalCount = Role::whereNull('deleted_at')->count();
    fwrite(STDERR, print_r("Final Count: {$finalCount}\n", TRUE));

    $this->assertEquals($finalCount, $initialCount - 1);
});
