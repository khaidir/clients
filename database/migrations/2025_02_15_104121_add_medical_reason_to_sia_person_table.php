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
        Schema::table('sia_person', function (Blueprint $table) {
            Schema::table('sia_person', function (Blueprint $table) {
                $table->string('medical_reason')->nullable()->after('medical_checkup');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sia_person', function (Blueprint $table) {
            $table->dropColumn('medical_reason');
        });
    }
};
