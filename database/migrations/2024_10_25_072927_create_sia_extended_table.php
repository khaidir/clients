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
        Schema::create('sia_extended', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('company_id')->default(0);
            $table->string('type_contract', 60)->nullable();
            $table->string('periode_start', 15)->nullable();
            $table->string('periode_end', 15)->nullable();
            $table->dateTimeTz('requested_at')->nullable();
            $table->integer('request_by')->nullable(); // end user
            $table->integer('approved_by')->nullable(); // hod
            $table->integer('verified_by')->nullable(); // end user or H&S
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sia_extended');
    }
};
