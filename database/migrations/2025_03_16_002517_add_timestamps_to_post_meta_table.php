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
        Schema::table('post_meta', function (Blueprint $table) {
            $table->timestamps(); // يضيف created_at و updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_meta', function (Blueprint $table) {
            $table->dropTimestamps(); // يحذف created_at و updated_at عند rollback
        });
    }
};
