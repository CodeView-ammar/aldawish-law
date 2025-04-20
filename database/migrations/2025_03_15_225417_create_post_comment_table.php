<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCommentTable extends Migration
{
    public function up()
    {
        Schema::create('post_comment', function (Blueprint $table) {
            $table->id(); // ينشئ عمود id بشكل تلقائي
            $table->foreignId('postId')->constrained('posts')->onDelete('cascade');
            $table->foreignId('parentId')->nullable()->constrained('post_comment')->onDelete('cascade');
            $table->string('title', 100);
            $table->boolean('published')->default(false);
            $table->dateTime('createdAt');
            $table->dateTime('publishedAt')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();

            // فهارس للأعمدة
            $table->index('postId', 'idx_comment_post')->invisible(); // فهرس غير مرئي
            $table->index('parentId', 'idx_comment_parent');
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_comment');
    }
}