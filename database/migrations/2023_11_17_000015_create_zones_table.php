<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZonesTable extends Migration
{
    public function up()
    {
        Schema::create('zones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('seat');
            $table->integer('sold_seat')->nullable();
            $table->float('price', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
