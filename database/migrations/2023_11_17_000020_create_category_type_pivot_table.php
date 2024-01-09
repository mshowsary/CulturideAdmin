<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTypePivotTable extends Migration
{
    public function up()
    {
        Schema::create('category_type', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id', 'type_id_fk_9217612')->references('id')->on('types')->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id', 'category_id_fk_9217612')->references('id')->on('categories')->onDelete('cascade');
        });
    }
}
