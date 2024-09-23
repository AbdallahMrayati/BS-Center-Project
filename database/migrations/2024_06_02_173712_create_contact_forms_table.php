<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_forms', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 150)->nullable();
            $table->string('country', 150)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('phone_number', 50)->nullable();
            $table->string('company', 150)->nullable();
            $table->string('subject', 150)->nullable();
            $table->longText('message')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_forms');
    }
};
