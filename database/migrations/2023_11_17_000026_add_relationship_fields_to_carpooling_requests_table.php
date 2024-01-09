<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCarpoolingRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('carpooling_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('carpooling_id')->nullable();
            $table->foreign('carpooling_id', 'carpooling_fk_9220645')->references('id')->on('carpoolings');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id', 'parent_fk_9220646')->references('id')->on('carpoolings');
        });
    }
}
