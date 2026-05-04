<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('street', 50);
            $table->string('house_number', 10);
            $table->string('postal_code', 10);
            $table->string('city', 40);
            $table->string('state', 40);
            $table->boolean('is_company')->default(false);
            $table->string('company_name', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
