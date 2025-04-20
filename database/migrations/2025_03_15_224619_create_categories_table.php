<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parentId')->nullable()->constrained('categories')->onDelete('cascade');
            $table->string('title', 75);
            $table->string('metaTitle', 100)->nullable();
            $table->string('slug', 100)->unique();
            $table->text('content')->nullable();
            $table->timestamps();
            $table->softDeletes(); // إضافة هذا السطر
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}