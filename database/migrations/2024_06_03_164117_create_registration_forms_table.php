<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('timing_id');

            // Contact Information
            $table->string('full_name', 150)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('phone_number', 50)->nullable();
            $table->string('position', 150)->nullable();
            // Company Information
            $table->string('company_name', 150)->nullable();
            $table->string('city', 150)->nullable();
            $table->string('address', 150)->nullable();
            // Instructor
            $table->string('instructor_name', 150)->nullable();
            $table->string('instructor_email', 150)->nullable();
            $table->string('instructor_phone_number', 50)->nullable();
            $table->string('instructor_position', 150)->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Add foreign key constraints:
            $table->foreign('timing_id')->references('id')->on('timings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registration_forms');
    }
}
