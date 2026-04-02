<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->enum('status', ['pending','accepted','in_progress','delivered','rejected'])->default('pending');
        $table->decimal('total', 8, 2);
        $table->string('address');
        $table->string('phone');
        $table->text('notes')->nullable();
        $table->enum('payment_method', ['cash', 'card'])->default('cash');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
