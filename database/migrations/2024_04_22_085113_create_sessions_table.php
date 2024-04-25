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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->dateTime('time_start');
            $table->dateTime('time_end');

            $table->foreignId('session_status_id')->constrained()->onUpdate('cascade');
            $table->foreignId('film_id')->constrained()->onUpdate('cascade');
            $table->foreignId('hall_id')->constrained()->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
