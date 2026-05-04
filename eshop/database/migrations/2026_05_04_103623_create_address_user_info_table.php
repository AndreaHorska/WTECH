<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('address_user_info', function (Blueprint $table) {
            $table->foreignId('address_id')
                ->references('id')
                ->on('addresses')
                ->cascadeOnDelete();

            $table->foreignId('user_info_id')
                ->references('id')
                ->on('user_info')
                ->cascadeOnDelete();

            $table->primary(['address_id', 'user_info_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('address_user_info');
    }
};
