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
        Schema::create('sia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('company_id')->default(0);
            $table->string('description')->nullable();

            $table->integer('request_by')->nullable(); // end user
            $table->integer('approved_by')->nullable(); // hod
            $table->integer('doc_verified_by')->nullable(); // purchasing
            $table->integer('license_verified_by')->nullable(); // legal/healthy & safety
            $table->integer('inducted_by')->nullable(); // end user or H&S
            $table->integer('evaluated_by')->nullable(); // health & safety

            $table->dateTimeTz('dete_request', precision: 0);
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sia');
    }
};
