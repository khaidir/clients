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
        Schema::create('permission_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Group name (e.g. "User Management")
            $table->string('slug')->unique(); // Slug for URL or identifier
            $table->text('description')->nullable(); // Optional description
            $table->timestamps();
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->foreignId('permission_group_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropForeign(['permission_group_id']);
        });

        Schema::dropIfExists('permission_groups');
    }
};
