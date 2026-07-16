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
        // 1. Create documentations table
        Schema::create('documentations', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('caption')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 2. Add order to guides
        Schema::table('guides', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('photo_path');
        });

        // 3. Add order to articles
        Schema::table('articles', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('status');
        });

        // 4. Add order to testimonials
        Schema::table('testimonials', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentations');

        Schema::table('guides', function (Blueprint $table) {
            $table->dropColumn('order');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('order');
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
