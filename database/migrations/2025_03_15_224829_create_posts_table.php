<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // ينشئ عمود id بشكل تلقائي
            $table->foreignId('authorId')->constrained('users')->onDelete('cascade');
            $table->foreignId('parentId')->nullable()->constrained('posts')->onDelete('cascade');
            $table->string('title', 75);
            $table->string('metaTitle', 100)->nullable();
            $table->string('slug', 100)->unique();
            $table->tinyText('summary')->nullable();
            $table->boolean('published')->default(false);
            $table->dateTime('createdAt');
            $table->dateTime('updatedAt')->nullable();
            $table->dateTime('publishedAt')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}