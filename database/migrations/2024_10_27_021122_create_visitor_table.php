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
        Schema::create('visitor', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('token_id')->default(0);
            $table->integer('pic_id')->default(0);
            $table->integer('user_id')->nullable();

            $table->string('fullname', 160)->nullable();
            $table->string('email', 160)->nullable();
            $table->string('citizenship_id', 20)->nullable();
            $table->string('citizenship_doc', 255)->nullable();

            $table->string('description', 160)->nullable();
            $table->string('destination', 40)->nullable();
            $table->string('duration', 120)->nullable();

            $table->dateTime('date_request', precision: 0);
            $table->integer('approve_1')->default(0);
            $table->integer('approve_2')->default(0);
            $table->integer('approve_3')->default(0);
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
        Schema::dropIfExists('visitor');
    }
};
