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
        Schema::create('pic', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('name', 120)->nullable();
            $table->string('segment', 160)->nullable();
            $table->string('description', 160)->nullable();
            $table->string('email', 160)->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pic');
    }
};
