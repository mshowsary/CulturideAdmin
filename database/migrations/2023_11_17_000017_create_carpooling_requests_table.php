<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarpoolingRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('carpooling_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('accepted')->default(0);
            $table->integer('seat');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
