<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopBarTable extends Migration
{
    public function up()
    {
        Schema::create('topbar', function (Blueprint $table) {
            $table->id(); // مفتاح أساسي تلقائي
            $table->string('content'); // حقل الرسالة أو المحتوى لعرضه في التوب بار
            $table->string('link')->nullable(); // حقل الرابط (اختياري)
            $table->boolean('status')->default(1); // حقل الحالة لتفعيل/تعطيل التوب بار (اختياري)
            $table->timestamps(); // حقل timestamps (created_at, updated_at)
        });
    }

    public function down()
    {
        Schema::dropIfExists('topbar');
    }
}
