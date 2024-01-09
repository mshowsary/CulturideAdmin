<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarpoolingsTable extends Migration
{
    public function up()
    {
        Schema::create('carpoolings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('seat');
            $table->string('status');
            $table->string('codebar')->nullable();
            $table->boolean('used')->default(0);
            $table->timestamp('check_point_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
