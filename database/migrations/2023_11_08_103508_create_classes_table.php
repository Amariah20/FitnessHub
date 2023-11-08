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
        Schema::create('classes', function (Blueprint $table) {
            $table->id('Class_id');
            $table->string('name');
            $table->string('description');
            $table->string('location');
            $table->integer('capacity');
            $table->integer('duration');
            $table->decimal('price', 10, 2);
            $table->unsignedBigInteger('gym_id'); // The foreign key column

            // Define the foreign key constraint
            $table->foreign('gym_id')->references('gym_id')->on('gyms')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
