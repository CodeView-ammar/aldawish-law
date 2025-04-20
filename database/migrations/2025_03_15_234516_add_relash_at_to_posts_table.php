<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // إذا كانت الأعمدة موجودة، نقوم بتعديلها بدلاً من إضافتها
            if (Schema::hasColumn('posts', 'createdAt')) {
                DB::statement('ALTER TABLE posts MODIFY COLUMN createdAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
            } else {
                $table->timestamp('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            }

            if (Schema::hasColumn('posts', 'updatedAt')) {
                DB::statement('ALTER TABLE posts MODIFY COLUMN updatedAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
            } else {
                $table->timestamp('updatedAt')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // حذف الأعمدة في حالة التراجع عن الهجرة
            $table->dropColumn('createdAt');
            $table->dropColumn('updatedAt');
        });
    }
};
