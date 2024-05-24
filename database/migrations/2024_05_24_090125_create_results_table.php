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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('save_id')->constrained('saves')->onDelete('cascade');
            $table->string('thumbnail')->nullable();
            $table->string('name');
            $table->string('date')->nullable();
            $table->string('flag')->nullable();
            $table->string('nationality')->nullable();
            $table->string('team')->nullable();
            $table->string('equipment')->nullable();
            $table->string('equipmentSeason')->nullable();
            $table->text('age')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
