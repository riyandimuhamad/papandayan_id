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
        Schema::table('testimonials', function (Blueprint $table) {
            if (Schema::hasColumn('testimonials', 'name')) {
                $table->renameColumn('name', 'customer_name');
            }
            if (Schema::hasColumn('testimonials', 'content')) {
                $table->renameColumn('content', 'message');
            }
            if (Schema::hasColumn('testimonials', 'photo_path')) {
                $table->renameColumn('photo_path', 'avatar_path');
            }
        });

        Schema::table('testimonials', function (Blueprint $table) {
            if (!Schema::hasColumn('testimonials', 'trip_date')) {
                $table->date('trip_date')->nullable()->after('customer_name');
            }
            if (!Schema::hasColumn('testimonials', 'package_id')) {
                $table->foreignId('package_id')->nullable()->after('message')->constrained('packages')->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropForeign(['package_id']);
            $table->dropColumn(['trip_date', 'package_id']);
            $table->renameColumn('customer_name', 'name');
            $table->renameColumn('message', 'content');
            $table->renameColumn('avatar_path', 'photo_path');
        });
    }
};
