<?php

use App\Models\Artist;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

beforeEach(function() {
    $this->seed(DatabaseSeeder::class);
    actingAs(User::where('id', 1)->first());
});

it('affiche une liste d\'artistes', function () {
    $artist1 = Artist::factory()->create();
    $artist2 = Artist::factory()->create();
    
    get(route('admin.artists.index'))
        ->assertStatus(200)
        ->assertViewIs('admin.artists.index')
        ->assertViewHas('artists', function ($artists) use ($artist1, $artist2) {
            return $artists->contains($artist1) && $artists->contains($artist2);
        });
});

it('affiche le formulaire de création d\'artiste', function () {
    get(route('admin.artists.create'))
        ->assertStatus(200)
        ->assertViewIs('admin.artists.create');
});
 

it('enregistre un nouvel artiste dans la base de données', function () {
    Storage::fake('public');
    $photo = UploadedFile::fake()->image('photo.jpg');
    post(route('admin.artists.store'), [
            'name' => 'New Artist',
            'photo' => $photo,
        ])
        ->assertStatus(302);

    $this->assertDatabaseHas('artists', [
        'name' => 'New Artist',
    ]);
});

it('met à jour un artiste spécifique dans la base de données', function () {
    $artist = Artist::factory()->create(['name' => 'Old Artist']);
    
    Storage::fake('public');
    $photo = UploadedFile::fake()->image('photo.jpg');
    put(route('admin.artists.update', $artist->id), [
            'name' => 'New Artist',
            'photo' => $photo,
        ])
        ->assertStatus(302);

    $this->assertDatabaseHas('artists', [
        'id' => $artist->id,
        'name' => 'New Artist',
    ]);
});

it('affiche un artiste spécifique', function () {
    $artist = Artist::factory()->create();
    
    get(route('admin.artists.show', $artist->id))
        ->assertStatus(200)
        ->assertViewIs('admin.artists.show')
        ->assertViewHas('artist', $artist);
});

it('supprime un artiste spécifique de la base de données', function () {
    $artist = Artist::factory()->create();
    
    delete(route('admin.artists.destroy', $artist->id))
        ->assertStatus(302)
        ->assertSessionHasNoErrors();

    $this->assertEquals(Artist::count(), 0);
});

it('supprime plusieurs artistes de la base de données', function () {
    $artist1 = Artist::factory()->create();
    $artist2 = Artist::factory()->create();
    
    delete(route('admin.artists.massDestroy'), [
            'ids' => [$artist1->id, $artist2->id],
        ])
        ->assertStatus(204);

    $this->assertEquals(Artist::count(), 0);
}); 
