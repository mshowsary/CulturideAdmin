<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('token')->nullable();
            $table->string('token_reset_password')->unique()->nullable();
            $table->timestamp('expire_at')->nullable();            
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
