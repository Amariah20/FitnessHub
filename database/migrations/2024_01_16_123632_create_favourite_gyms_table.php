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
        Schema::create('favourite_gyms', function (Blueprint $table) {
            $table->id('favourite_gym_id');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('gym_id')->references('gym_id')->on('gyms')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favourite_gyms');
    }
};
