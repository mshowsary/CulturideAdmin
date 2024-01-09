<?php

use App\Models\Event;
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

it('affiche la page d\'index des evenements', function () {
    get(route('admin.events.index'))
        ->assertStatus(200)
        ->assertViewIs('admin.events.index');
});



it('affiche le formulaire de création de evenement', function () {
    get(route('admin.events.create'))
        ->assertStatus(200)
        ->assertViewIs('admin.events.create');
});

/*
it('crée une nouvelle evenement et redirige vers l\'index', function () {
    $eventData = Event::factory()->make()->toArray();

    post(route('admin.events.store'), $eventData)
        ->assertRedirect(route('admin.events.index'));

    $this->assertDatabaseHas('events', $eventData);
});
*/


it('affiche la page de modification de evenement', function () {
    $event = Event::factory()->create();

    get(route('admin.events.edit', $event))
        ->assertStatus(200)
        ->assertViewIs('admin.events.edit')
        ->assertViewHas('event', $event);
});



it('affiche la page de détails de evenement', function () {
    $event = Event::factory()->create();

    get(route('admin.events.show', $event))
        ->assertStatus(200)
        ->assertViewIs('admin.events.show')
        ->assertViewHas('event', $event);
});

it('supprime la evenement et redirige', function () {
    $event = Event::factory()->create();

    delete(route('admin.events.destroy', $event))
        ->assertRedirect();
   $this->assertEquals(Event::count(), 0);
});



it('supprime plusieurs evenements', function () {
    $events = Event::factory()->count(3)->create();
    $eventIds = $events->pluck('id')->toArray();

    delete(route('admin.events.massDestroy'), ['ids' => $eventIds])
        ->assertStatus(204);

        $this->assertEquals(Event::count(), 0);
});
