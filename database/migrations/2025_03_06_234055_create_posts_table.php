<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // عمود id الأساسي
            $table->unsignedBigInteger('author_id')->default(0); // عمود author_id
            $table->string('title'); // عنوان المقال
            $table->text('content'); // محتوى المقال
            $table->string('slug')->unique(); // عنوان URL للمقال
            $table->timestamp('posted_at')->nullable(); // تاريخ نشر المقال
            $table->timestamps(); // تاريخ الإنشاء والتعديل
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
