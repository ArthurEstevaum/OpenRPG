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
        Schema::create('tabletops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('system_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('scenario_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('owner_user_id')->constrained(table: 'users')->cascadeOnDelete();
            $table->timestamps();
            $table->string('name', 100);
            $table->string('description', 1000);
            $table->string('level', 50);
            $table->string('genre', 50);
            $table->string('city', 100);
            $table->string('province', 100);
            $table->boolean('presencial');
            $table->date('next_session')->nullable();
            $table->string('frequency', 50)->nullable();
            $table->time('horary')->nullable();
            $table->string('weekday', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
