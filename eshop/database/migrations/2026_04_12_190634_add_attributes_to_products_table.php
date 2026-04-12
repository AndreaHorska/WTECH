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
        Schema::table('products', function (Blueprint $table) {
            $table->string('material', 50)->default('Vinyl');
            $table->string('size', 50)->default('5 cm');
            $table->string('weight', 50)->default('20 g');
            $table->string('age', 20)->default('3+');
            $table->string('country_of_origin', 50)->default('Slovakia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['material', 'size', 'weight', 'color', 'age', 'country_of_origin']);
        });
    }
};
