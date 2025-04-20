<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostMetaTable extends Migration
{
    public function up()
    {
        Schema::create('post_meta', function (Blueprint $table) {
            $table->id(); // ينشئ عمود id بشكل تلقائي
            $table->foreignId('postId')->constrained('posts')->onDelete('cascade');
            $table->string('key', 50);
            $table->text('content')->nullable();
            
            // تم إزالة تعريف المفتاح الأساسي لأنه يتم إنشاؤه تلقائيًا بواسطة $table->id()
            $table->unique(['postId', 'key'], 'uq_post_meta')->invisible(); // قيود فريدة غير مرئية
            $table->index('postId', 'idx_meta_post'); // إنشاء فهرس للعمود postId
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_meta');
    }
}
