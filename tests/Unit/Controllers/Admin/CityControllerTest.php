<?php

use App\Models\City;
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

it('affiche la page d\'index des villes', function () {
    get(route('admin.cities.index'))
        ->assertStatus(200)
        ->assertViewIs('admin.cities.index');
});



it('affiche le formulaire de création de ville', function () {
    get(route('admin.cities.create'))
        ->assertStatus(200)
        ->assertViewIs('admin.cities.create');
});



it('crée une nouvelle ville et redirige vers l\'index', function () {
    $cityData = City::factory()->make()->toArray();

    post(route('admin.cities.store'), $cityData)
        ->assertRedirect(route('admin.cities.index'));

    $this->assertDatabaseHas('cities', $cityData);
});



it('affiche la page de modification de ville', function () {
    $city = City::factory()->create();

    get(route('admin.cities.edit', $city))
        ->assertStatus(200)
        ->assertViewIs('admin.cities.edit')
        ->assertViewHas('city', $city);
});


it('met à jour la ville et redirige vers l\'index', function () {
    $city = City::factory()->create();
    $updatedCityData = City::factory()->make()->toArray();

    put(route('admin.cities.update', $city), $updatedCityData)
        ->assertRedirect(route('admin.cities.index'));

    $this->assertDatabaseHas('cities', $updatedCityData);
});



it('affiche la page de détails de ville', function () {
    $city = City::factory()->create();

    get(route('admin.cities.show', $city))
        ->assertStatus(200)
        ->assertViewIs('admin.cities.show')
        ->assertViewHas('city', $city);
});

it('supprime la ville et redirige', function () {
    $city = City::factory()->create();

    delete(route('admin.cities.destroy', $city))
        ->assertRedirect();
   $this->assertEquals(City::count(), 0);
});



it('supprime plusieurs villes', function () {
    $cities = City::factory()->count(3)->create();
    $cityIds = $cities->pluck('id')->toArray();

    delete(route('admin.cities.massDestroy'), ['ids' => $cityIds])
        ->assertStatus(204);

        $this->assertEquals(City::count(), 0);
});
