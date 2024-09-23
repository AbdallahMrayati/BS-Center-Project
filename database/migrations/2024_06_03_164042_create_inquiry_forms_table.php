<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquiryFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiry_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->nullable();

            $table->string('full_name', 150)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('phone_number', 50)->nullable();
            $table->string('company', 150)->nullable();
            $table->string('city', 150)->nullable();
            $table->longText('message')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Add foreign keys
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inquiry_forms');
    }
}
