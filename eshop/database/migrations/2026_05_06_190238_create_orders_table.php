<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_info_id')->constrained('user_info')->restrictOnDelete();
            $table->foreignId('shipping_address_id')->constrained('addresses')->restrictOnDelete();
            $table->foreignId('billing_address_id')->constrained('addresses')->restrictOnDelete();
            $table->foreignId('shipping_method_id')->constrained()->restrictOnDelete();
            $table->timestamp('date')->useCurrent();
            $table->string('state')->default('Created');
            $table->decimal('total_price', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
