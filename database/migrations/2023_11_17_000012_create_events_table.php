<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->boolean('home')->default(0)->nullable();
            $table->datetime('date');
            $table->string('time');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
