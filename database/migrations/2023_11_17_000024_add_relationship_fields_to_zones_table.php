<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToZonesTable extends Migration
{
    public function up()
    {
        Schema::table('zones', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->nullable();
            $table->foreign('event_id', 'event_fk_9220626')->references('id')->on('events');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_9222940')->references('id')->on('users');
        });
    }
}
