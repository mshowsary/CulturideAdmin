<?php

use App\Models\Category;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

beforeEach(function() {
    $this->seed(DatabaseSeeder::class);
    actingAs(User::where('id', 1)->first());
});

it('permet à l\'administrateur d\'accéder à la page d\'index des catégories', function () {
    get(route('admin.categories.index'))
        ->assertStatus(Response::HTTP_OK)
        ->assertViewIs('admin.categories.index')
        ->assertViewHas('categories');
});

it('permet à l\'administrateur de créer une catégorie', function () {
    get(route('admin.categories.create'))
        ->assertStatus(Response::HTTP_OK)
        ->assertViewIs('admin.categories.create');
});

it('crée une nouvelle catégorie', function () {
    $categoryData = Category::factory()->make()->toArray();

    post(route('admin.categories.store'), $categoryData)
        ->assertRedirect(route('admin.categories.index'));

    $this->assertDatabaseHas('categories', $categoryData);
});

it('permet à l\'administrateur de modifier une catégorie', function () {
    $category = Category::factory()->create();

    get(route('admin.categories.edit', $category))
        ->assertStatus(Response::HTTP_OK)
        ->assertViewIs('admin.categories.edit')
        ->assertViewHas('category', $category);
});

it('permet à l\'administrateur de mettre à jour une catégorie', function () {
    $category = Category::factory()->create();

    $updatedCategoryData = [
        'name' => 'Updated Category',
    ];

    put(route('admin.categories.update', $category), $updatedCategoryData)
        ->assertRedirect(route('admin.categories.index'));

    $this->assertDatabaseHas('categories', $updatedCategoryData);
});

it('permet à l\'administrateur d\'afficher une catégorie', function () {
    $category = Category::factory()->create();

    get(route('admin.categories.show', $category))
        ->assertStatus(Response::HTTP_OK)
        ->assertViewIs('admin.categories.show')
        ->assertViewHas('category', $category);
});

it('permet à l\'administrateur de supprimer une catégorie', function () {
    $category = Category::factory()->create();

    delete(route('admin.categories.destroy', $category))
        ->assertRedirect();

    $this->assertEquals(Category::count(), 0);
});

it('permet à l\'administrateur de supprimer plusieurs catégories en masse', function () {
    $categories = Category::factory()->count(5)->create();

    $categoryIds = $categories->pluck('id')->toArray();

    delete(route('admin.categories.massDestroy'), ['ids' => $categoryIds])
        ->assertStatus(204);

    $this->assertEquals(Category::count(), 0);
});
