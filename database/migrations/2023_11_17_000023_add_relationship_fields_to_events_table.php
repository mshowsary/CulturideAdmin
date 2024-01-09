<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEventsTable extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id', 'city_fk_9217668')->references('id')->on('cities');
            $table->unsignedBigInteger('artist_id')->nullable();
            $table->foreign('artist_id', 'artist_fk_9217669')->references('id')->on('artists');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id', 'category_fk_9217671')->references('id')->on('categories');
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id', 'type_fk_9217670')->references('id')->on('types');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_9217675')->references('id')->on('users');
        });
    }
}
