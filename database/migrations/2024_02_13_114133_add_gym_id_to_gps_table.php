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
        Schema::table('gps', function (Blueprint $table) {
            $table->unsignedBigInteger('gym_id'); // The foreign key column

            // Define the foreign key constraint
            $table->foreign('gym_id')->references('gym_id')->on('gyms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gps', function (Blueprint $table) {
            //
        });
    }
};
