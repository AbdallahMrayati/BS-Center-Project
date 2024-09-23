<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('city_id');

            $table->string('title', 250)->nullable();
            $table->decimal('price', 10, 2)->default(0.00);

            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->integer('duration')->nullable()->index();

            $table->string('lang', 5)->nullable();
            $table->boolean('is_upcoming')->default(0);
            $table->boolean('is_banner')->default(0);
            $table->boolean('hidden')->default(false);

            $table->timestamps();
            $table->softDeletes();

            // Adding foreign key constraints
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timings', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropForeign(['country_id']);
            $table->dropForeign(['city_id']);
        });
        Schema::dropIfExists('timings');
    }
}


