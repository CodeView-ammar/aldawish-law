<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_number');
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->string('client_name');
            $table->enum('ristrict', ['arbitration', 'issues']);
            $table->string('id_number');
            $table->string('phone_number');
            $table->string('email');
            $table->longText('address')->nullable();
            $table->foreignId('case_type')->nullable();
            $table->enum('case_status', ['new', 'existing'])->nullable();
            $table->string('court')->nullable();
            $table->foreignId('party_in_the_case')->nullable();
            $table->longText('case_summary')->nullable();
            $table->timestamp('date')->nullable();
            $table->string('status')->default('pending');
            $table->string('payment_status')->nullable();
            $table->json('payment_data')->nullable();
            $table->float('total', 8, 3)->nullable();
            $table->json('service_data')->nullable();
            $table->json('quota')->nullable();
            $table->longText("notes")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('orders');
    }
};
