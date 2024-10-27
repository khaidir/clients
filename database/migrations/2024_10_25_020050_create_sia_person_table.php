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
        Schema::create('sia_person', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sia_id');
            $table->string('id_card', 20)->nullable();
            $table->string('fullname', 50)->nullable();
            $table->string('email', 80)->nullable();
            $table->string('token', 255)->nullable();
            $table->string('position', 120)->nullable();
            $table->dateTimeTz('cert_expire')->nullable();
            $table->string('bpjs_number', 20)->nullable();
            $table->string('score_induction', 20)->nullable();

            // attachment
            $table->string('ktp')->nullable();
            $table->boolean('ktp_checked')->default(false);
            $table->string('card_id')->nullable();
            $table->boolean('card_checked')->default(false);
            $table->string('passport')->nullable();
            $table->boolean('pp_checked')->default(false);
            $table->string('bpjs')->nullable();
            $table->boolean('bpjs_checked')->default(false);
            $table->string('contract')->nullable();
            $table->boolean('ct_checked')->default(false);
            $table->string('cert_competence')->nullable();
            $table->boolean('cc_checked')->default(false);
            $table->string('medical_checkup')->nullable();
            $table->boolean('mc_checked')->default(false);
            $table->string('license_driver')->nullable();
            $table->boolean('ld_checked')->default(false);
            $table->string('license_vaccinated')->nullable();
            $table->boolean('lv_checked')->default(false);

            // checked

            $table->unsignedInteger('user_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->boolean('status')->default(true);
            $table->boolean('post')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sia_person');
    }
};
