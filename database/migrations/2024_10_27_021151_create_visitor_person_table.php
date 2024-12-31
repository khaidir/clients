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
        Schema::create('visitor_person', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visitor_id')->nullable();
            $table->string('citizenship_number', 255)->nullable();
            $table->string('citizenship_docs', 255)->nullable();
            $table->integer('foreign')->default(1);
            $table->string('name', 160)->nullable();
            $table->string('ocuppational', 160)->nullable();
            $table->string('notes', 255)->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_person');
    }
};
