<?php

use App\Http\Controllers\Admin\CarpoolingController;
use App\Http\Requests\MassDestroyCarpoolingRequest;
use App\Models\Carpooling;
use App\Models\City;
use App\Models\Ticket;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use Illuminate\Support\Facades\Gate;
use function Pest\Laravel\post;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
    actingAs(User::where('id', 1)->first());
});

it('affiche une liste de covoiturages', function () {
    Carpooling::factory()->count(5)->create();

    get(route('admin.carpoolings.index'))
        ->assertStatus(200)
        ->assertViewIs('admin.carpoolings.index');
     
});

it('affiche les détails d\'un covoiturage spécifique', function () {
    $carpooling = Carpooling::factory()->create();

    get(route('admin.carpoolings.show', ['carpooling' => $carpooling->id]))
        ->assertStatus(200)
        ->assertViewIs('admin.carpoolings.show')
        ->assertViewHas('carpooling', $carpooling);
});

it('supprime un covoiturage spécifique', function () {
    $carpooling = Carpooling::factory()->create();

    $response = delete(route('admin.carpoolings.destroy', $carpooling->id))
        ->assertStatus(302);

    $response->assertRedirect();

});

it('supprime en masse les covoiturages sélectionnés', function () {
    $carpoolings = Carpooling::factory()->count(3)->create();

    delete(route('admin.carpoolings.massDestroy'), ['ids' => $carpoolings->pluck('id')->toArray()])
        ->assertStatus(204);
});

it('interdit à un utilisateur non autorisé d\'accéder aux covoiturages', function () {
    Gate::partialMock()
        ->shouldReceive('denies')
        ->with('carpooling_access')
        ->andReturn(true);

    get(route('admin.carpoolings.index'))
        ->assertStatus(403);
});

it('interdit à un utilisateur non autorisé d\'accéder à un covoiturage spécifique', function () {
    $carpooling = Carpooling::factory()->create();

    Gate::partialMock()
        ->shouldReceive('denies')
        ->with('carpooling_show')
        ->andReturn(true);

    get(route('admin.carpoolings.show', $carpooling->id))
        ->assertStatus(403);
});

it('interdit à un utilisateur non autorisé de supprimer un covoiturage', function () {
    $carpooling = Carpooling::factory()->create();

    Gate::partialMock()
        ->shouldReceive('denies')
        ->with('carpooling_delete')
        ->andReturn(true);

    delete(route('admin.carpoolings.destroy', $carpooling->id))
        ->assertStatus(403);
});

it('interdit à un utilisateur non autorisé de supprimer en masse les covoiturages', function () {
    $carpoolings = Carpooling::factory()->count(3)->create()->pluck('id')->toArray();

    Gate::partialMock()
        ->shouldReceive('denies')
        ->with('carpooling_delete')
        ->andReturn(true);

    delete(route('admin.carpoolings.massDestroy'), ['ids' => $carpoolings])
        ->assertStatus(403);
});
