<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCarpoolingsTable extends Migration
{
    public function up()
    {
        Schema::table('carpoolings', function (Blueprint $table) {
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id', 'city_fk_9220637')->references('id')->on('cities');
            $table->unsignedBigInteger('ticket_id')->nullable();
            $table->foreign('ticket_id', 'ticket_fk_9220638')->references('id')->on('tickets');
        });
    }
}
