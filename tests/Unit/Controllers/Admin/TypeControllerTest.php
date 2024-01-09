<?php

use App\Models\Category;
use App\Models\Type;
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

it('affiche la page d\'index des types', function () {
    get(route('admin.types.index'))
        ->assertStatus(200)
        ->assertViewIs('admin.types.index');
});



it('affiche le formulaire de création de type', function () {
    get(route('admin.types.create'))
        ->assertStatus(200)
        ->assertViewIs('admin.types.create');
});



it('crée une nouvelle type et redirige vers l\'index', function () {
    Category::factory()->create();
    $typeData = Type::factory()->make()->toArray();

    $typeData['categories']=[1];
    post(route('admin.types.store'), $typeData)
        ->assertRedirect(route('admin.types.index'));

  //  $this->assertDatabaseHas('types', $typeData);
});



it('affiche la page de modification de type', function () {
    $type = Type::factory()->create();

    get(route('admin.types.edit', $type))
        ->assertStatus(200)
        ->assertViewIs('admin.types.edit')
        ->assertViewHas('type', $type);
});


it('met à jour la type et redirige vers l\'index', function () {
    Category::factory()->create();
    $type = Type::factory()->create();
    $updatedTypeData = Type::factory()->make()->toArray();

    $updatedTypeData['categories']=[1];
    put(route('admin.types.update', $type), $updatedTypeData)
        ->assertRedirect(route('admin.types.index'));

   // $this->assertDatabaseHas('types', $updatedTypeData);
});



it('affiche la page de détails de type', function () {
    $type = Type::factory()->create();

    get(route('admin.types.show', $type))
        ->assertStatus(200)
        ->assertViewIs('admin.types.show')
        ->assertViewHas('type', $type);
});

it('supprime la type et redirige', function () {
    $type = Type::factory()->create();

    delete(route('admin.types.destroy', $type))
        ->assertRedirect();

   // $this->assertModelMissing($);
   $this->assertEquals(Type::count(), 0);
});



it('supprime plusieurs types', function () {
    $types = Type::factory()->count(3)->create();
    $typeIds = $types->pluck('id')->toArray();

    delete(route('admin.types.massDestroy'), ['ids' => $typeIds])
        ->assertStatus(204);

        $this->assertEquals(Type::count(), 0);
});
