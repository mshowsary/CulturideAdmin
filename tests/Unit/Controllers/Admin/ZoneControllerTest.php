<?php

use App\Models\Zone;
use App\Models\User;
use App\Models\Event;
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

it('affiche la page d\'index des zones', function () {
    get(route('admin.zones.index'))
        ->assertStatus(200)
        ->assertViewIs('admin.zones.index');
});

it('affiche le formulaire de création de zone', function () {
    get(route('admin.zones.create'))
        ->assertStatus(200)
        ->assertViewIs('admin.zones.create');
});

it('crée une nouvelle zone et redirige vers l\'index', function () {
    $event = Event::factory()->create(); 
    $zoneData = Zone::factory()->make()->toArray() + ['event_id' => $event->id];

    post(route('admin.zones.store'), $zoneData)
        ->assertRedirect(route('admin.zones.index'));
    $this->assertDatabaseHas('zones', $zoneData);
});


it('affiche la page de modification de zone', function () {
    $zone = Zone::factory()->create();
    get(route('admin.zones.edit', $zone))
        ->assertStatus(200)
        ->assertViewIs('admin.zones.edit')
        ->assertViewHas('zone', $zone);
});

it('met à jour la zone et redirige vers l\'index', function () {
    $zone = Zone::factory()->create();
    $event = Event::factory()->create();
    $updatedZoneData = Zone::factory()->make()->toArray() + ['event_id' => $event->id];

    put(route('admin.zones.update', $zone), $updatedZoneData)
        ->assertRedirect(route('admin.zones.index'));
    $this->assertDatabaseHas('zones', $updatedZoneData);
});


it('affiche la page de détails de zone', function () {
    $zone = Zone::factory()->create();
    get(route('admin.zones.show', $zone))
        ->assertStatus(200)
        ->assertViewIs('admin.zones.show')
        ->assertViewHas('zone', $zone);
});

it('supprime la zone et redirige', function () {
    $zone = Zone::factory()->create();
    delete(route('admin.zones.destroy', $zone))
        ->assertRedirect();
    
        $this->assertEquals(Zone::count(), 0);
});

it('supprime plusieurs zones', function () {
    $zones = Zone::factory()->count(3)->create();
    $zoneIds = $zones->pluck('id')->toArray();
    delete(route('admin.zones.massDestroy'), ['ids' => $zoneIds])
        ->assertStatus(204);
  
        $this->assertEquals(Zone::count(), 0);
});
