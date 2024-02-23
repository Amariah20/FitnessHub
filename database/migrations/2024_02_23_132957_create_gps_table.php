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
        Schema::create('gps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('latitude', 10, 7); //10 nums allowed in total, 7 decimal places allowed
            $table->float('longitude', 10, 7 );
            $table->timestamps();
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
        Schema::dropIfExists('gps');
    }
};
