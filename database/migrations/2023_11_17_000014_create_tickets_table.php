<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('seat');
            $table->string('codebar')->unique();
            $table->boolean('used')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
