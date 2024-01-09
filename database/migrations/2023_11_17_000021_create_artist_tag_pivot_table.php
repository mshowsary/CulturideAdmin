<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('artist_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id', 'tag_id_fk_9217924')->references('id')->on('tags')->onDelete('cascade');
            $table->unsignedBigInteger('artist_id');
            $table->foreign('artist_id', 'artist_id_fk_9217924')->references('id')->on('artists')->onDelete('cascade');
        });
    }
}
