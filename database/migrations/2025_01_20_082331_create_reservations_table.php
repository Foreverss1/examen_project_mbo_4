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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('num_adults')->nullable();
            $table->integer('num_kids')->nullable();
            $table->foreignId('exstra_opties_id')->constrained('exstra_opties')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('time_start')->nullable();
            $table->dateTime('time_end')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
