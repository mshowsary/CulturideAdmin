<?php

use App\Models\Artist;
use App\Models\Tag;
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

it('affiche la page d\'index des tags', function () {
    get(route('admin.tags.index'))
        ->assertStatus(200)
        ->assertViewIs('admin.tags.index');
});

it('affiche le formulaire de création de tag', function () {
    get(route('admin.tags.create'))
        ->assertStatus(200)
        ->assertViewIs('admin.tags.create');
});

it('crée un nouveau tag et redirige vers l\'index', function () {

    $artists = Artist::factory()->count(2)->create();
    $tagData = Tag::factory()->make()->toArray() + ['artists' => $artists->pluck('id')->toArray()];

    post(route('admin.tags.store'), $tagData)
        ->assertRedirect(route('admin.tags.index'));
    $this->assertDatabaseHas('tags', ['name' => $tagData['name']]);
    foreach ($artists as $artist) {
        $this->assertDatabaseHas('artist_tag', [
            'tag_id' => Tag::latest('id')->first()->id,
            'artist_id' => $artist->id,
        ]);
    }
});




it('affiche la page de modification de tag', function () {
    $tag = Tag::factory()->create();
    get(route('admin.tags.edit', $tag))
        ->assertStatus(200)
        ->assertViewIs('admin.tags.edit')
        ->assertViewHas('tag', $tag);
});


it('met à jour le tag et redirige vers l\'index', function () {
    $tag = Tag::factory()->create();
    $artists = Artist::factory()->count(2)->create();

    $updatedTagData = Tag::factory()->make()->toArray() + ['artists' => $artists->pluck('id')->toArray()];

    put(route('admin.tags.update', $tag), $updatedTagData)
        ->assertRedirect(route('admin.tags.index'));
    $this->assertDatabaseHas('tags', [
        'id' => $tag->id,
        'name' => $updatedTagData['name'],
    ]);
    foreach ($artists as $artist) {
        $this->assertDatabaseHas('artist_tag', [
            'tag_id' => $tag->id,
            'artist_id' => $artist->id,
        ]);
    }
});




it('affiche la page de détails de tag', function () {
    $tag = Tag::factory()->create();
    get(route('admin.tags.show', $tag))
        ->assertStatus(200)
        ->assertViewIs('admin.tags.show')
        ->assertViewHas('tag', $tag);
});


it('supprime le tag et redirige', function () {
    $tag = Tag::factory()->create();
    delete(route('admin.tags.destroy', $tag))
    ->assertRedirect();
    
        $this->assertEquals(Tag::count(), 0);
});


it('supprime plusieurs tags', function () {
    $tags = Tag::factory()->count(3)->create();
    $tagIds = $tags->pluck('id')->toArray();
    delete(route('admin.tags.massDestroy'), ['ids' => $tagIds])
        ->assertStatus(204);
  
      $this->assertEquals(Tag::count(), 0);
   
});
