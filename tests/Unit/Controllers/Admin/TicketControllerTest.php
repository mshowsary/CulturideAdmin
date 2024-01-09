<?php

use App\Models\Ticket;
use App\Models\User;
use App\Models\Customer;
use App\Models\Zone;
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

it('affiche la page d\'index des tickets', function () {
    get(route('admin.tickets.index'))
        ->assertStatus(200)
        ->assertViewIs('admin.tickets.index');
});

it('affiche la page de détails du ticket', function () {
    $ticket = Ticket::factory()->create();
    get(route('admin.tickets.show', $ticket))
        ->assertStatus(200)
        ->assertViewIs('admin.tickets.show')
        ->assertViewHas('ticket', $ticket);
});

it('supprime le ticket et redirige', function () {
    $ticket = Ticket::factory()->create();
    delete(route('admin.tickets.destroy', $ticket))
        ->assertRedirect();
    
        $this->assertEquals(Ticket::count(), 0);
});

it('supprime plusieurs tickets', function () {
    $tickets = Ticket::factory()->count(3)->create();
    $ticketIds = $tickets->pluck('id')->toArray();
    delete(route('admin.tickets.massDestroy'), ['ids' => $ticketIds])
        ->assertStatus(204);
  
        $this->assertEquals(Ticket::count(), 0);
});
