<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCategoryTable extends Migration
{
    public function up()
    {
        Schema::create('post_category', function (Blueprint $table) {
            $table->unsignedBigInteger('postId');
            $table->unsignedBigInteger('categoryId');
            
            $table->primary(['postId', 'categoryId']);
            $table->index('categoryId', 'idx_pc_category');
            $table->index('postId', 'idx_pc_post');

            // تأكد من أن الجداول المرتبطة موجودة
            $table->foreign('categoryId')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('postId')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_category');
    }
}