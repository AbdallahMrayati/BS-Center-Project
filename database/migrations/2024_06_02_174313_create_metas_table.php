<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metas', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('section')
                  ->default(1)
                  ->index()
                  ->comment('1:home page, 2:categories, 3:courses, 4:venues, 5:blogs, 6:contact us, 7:about us, 8:citycategory');
            $table->string('meta_title_en', 255)->nullable();
            $table->text('meta_description_en')->nullable();
            $table->string('meta_keywords_en', 255)->nullable();
            $table->string('meta_robots_en', 255)->nullable();
            $table->string('meta_type_en', 255)->nullable();
            $table->string('meta_site_name_en', 255)->nullable();
            $table->string('meta_site_en', 255)->nullable();
            $table->string('meta_local_en', 255)->nullable();
            $table->text('meta_card_en')->nullable();

            $table->string('meta_title_ar', 255)->nullable();
            $table->text('meta_description_ar')->nullable();
            $table->string('meta_keywords_ar', 255)->nullable();
            $table->string('meta_robots_ar', 255)->nullable();
            $table->string('meta_type_ar', 255)->nullable();
            $table->string('meta_site_name_ar', 255)->nullable();
            $table->string('meta_site_ar', 255)->nullable();
            $table->string('meta_local_ar', 255)->nullable();
            $table->text('meta_card_ar')->nullable();

            $table->string('meta_image_size', 255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metas');
    }
};

/**
 * Sections:
 * 0 - home page
 * 1 - categories
 * 2 - courses
 * 3 - venus
 * 4 - blogs
 * 5 - contact us
 * 6 - about us
 * 7 - citycategory
 */
