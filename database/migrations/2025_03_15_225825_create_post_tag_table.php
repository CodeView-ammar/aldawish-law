<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('postId');
            $table->unsignedBigInteger('tagId');
            
            $table->primary(['postId', 'tagId']);
            $table->index('tagId', 'idx_pt_tag');
            $table->index('postId', 'idx_pt_post');

            // تأكد من تطابق الأعمدة مع الجداول
            $table->foreign('postId')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('tagId')->references('id')->on('tags')->onDelete('cascade'); // تأكد من أن اسم الجدول هو 'tags'
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
