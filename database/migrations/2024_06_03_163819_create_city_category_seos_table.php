<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityCategorySeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_category_seos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();

            $table->string('h1_ar', 255)->nullable();
            $table->string('h1_en', 255)->nullable();
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->string('meta_keywords_ar', 255)->nullable();
            $table->string('meta_keywords_en', 255)->nullable();
            $table->string('meta_title_ar', 255)->nullable();
            $table->string('meta_title_en', 255)->nullable();
            $table->string('meta_description_ar', 255)->nullable();
            $table->string('meta_description_en', 255)->nullable();
            $table->string('meta_robots_ar', 255)->nullable();
            $table->string('meta_robots_en', 255)->nullable();
            $table->string('meta_image_size', 255)->nullable();
            $table->string('meta_type_ar', 255)->nullable();
            $table->string('meta_type_en', 255)->nullable();
            $table->string('meta_site_name_ar', 255)->nullable();
            $table->string('meta_site_name_en', 255)->nullable();
            $table->string('meta_site_ar', 255)->nullable();
            $table->string('meta_site_en', 255)->nullable();
            $table->string('meta_local_ar', 255)->nullable();
            $table->string('meta_local_en', 255)->nullable();
            $table->string('meta_card_ar', 255)->nullable();
            $table->string('meta_card_en', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Adding foreign key constraint
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city_category_seos');
    }
}
