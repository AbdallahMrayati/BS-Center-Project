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
        Schema::create('request_online', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();

            $table->string('full_name', 150)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('phone_number', 50)->nullable();
            $table->string('company_name', 150)->nullable();
            $table->string('subject', 150)->nullable();
            $table->string('location', 150)->nullable();
            $table->date('date')->nullable();
            $table->longText('message')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Add foreign key constraints:
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_online');
    }
};
