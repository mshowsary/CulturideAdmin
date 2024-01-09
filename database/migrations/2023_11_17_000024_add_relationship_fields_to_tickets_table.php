<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTicketsTable extends Migration
{
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id', 'customer_fk_9220617')->references('id')->on('customers');
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->foreign('zone_id', 'zone_fk_9220631')->references('id')->on('zones');
        });
    }
}
