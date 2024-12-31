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
        Schema::table('visitor_person', function (Blueprint $table) {
            Schema::table('visitor_person', function (Blueprint $table) {
                $table->string('citizenship')->nullable(); // Sesuaikan tipe data sesuai kebutuhan
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitor_person', function (Blueprint $table) {
            //
        });
    }
};
