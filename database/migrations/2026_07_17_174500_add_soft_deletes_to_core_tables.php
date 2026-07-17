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
        $tables = ['packages', 'guides', 'articles', 'documentations', 'testimonials', 'hero_slides'];
        
        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['packages', 'guides', 'articles', 'documentations', 'testimonials', 'hero_slides'];
        
        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }
    }
};
