<?php

use App\Models\Customer;
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

it('affiche la page d\'index des clients', function () {
    get(route('admin.customers.index'))
        ->assertStatus(200)
        ->assertViewIs('admin.customers.index');
});


it('affiche la page de modification de client', function () {
    $customer = Customer::factory()->create();

    get(route('admin.customers.edit', $customer))
        ->assertStatus(200)
        ->assertViewIs('admin.customers.edit')
        ->assertViewHas('customer', $customer);
});


it('met à jour la client et redirige vers l\'index', function () {
    $customer = Customer::factory()->create();
    $updatedCustomerData = Customer::factory()->make()->toArray();

    put(route('admin.customers.update', $customer), $updatedCustomerData)
        ->assertRedirect(route('admin.customers.index'));

   // $this->assertDatabaseHas('customers', $updatedCustomerData);
});



it('affiche la page de détails de client', function () {
    $customer = Customer::factory()->create();

    get(route('admin.customers.show', $customer))
        ->assertStatus(200)
        ->assertViewIs('admin.customers.show')
        ->assertViewHas('customer', $customer);
});


it('supprime la client et redirige', function () {
    $customer = Customer::factory()->create();

    delete(route('admin.customers.destroy', $customer))
        ->assertRedirect();

   // $this->assertModelMissing($);
   $this->assertEquals(Customer::count(), 0);
});


it('supprime plusieurs clients', function () {
    $customers = Customer::factory()->count(3)->create();
    $customerIds = $customers->pluck('id')->toArray();

    delete(route('admin.customers.massDestroy'), ['ids' => $customerIds])
        ->assertStatus(204);

        $this->assertEquals(Customer::count(), 0);
});
