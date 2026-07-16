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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('price', 12, 2);
            $table->string('duration');
            $table->enum('difficulty', ['easy', 'medium', 'hard', 'expert'])->default('medium');
            $table->integer('max_people')->default(20);
            $table->longText('description')->nullable();
            $table->longText('itinerary')->nullable();
            $table->string('meeting_point')->nullable();
            $table->longText('facilities')->nullable();
            $table->string('cover_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
