<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagTable extends Migration
{
    public function up()
    {
        Schema::create('tag', function (Blueprint $table) {
            $table->id(); // ينشئ عمود id بشكل تلقائي
            $table->string('title', 75);
            $table->string('metaTitle', 100)->nullable();
            $table->string('slug', 100)->unique();
            $table->text('content')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tag');
    }
}