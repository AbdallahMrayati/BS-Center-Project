<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 250)->nullable();
            $table->string('lang', 5)->nullable();
            $table->longText('description')->nullable();
            $table->string('image_alt', 150)->nullable();
            $table->string('image_title', 150)->nullable();
            $table->string('slug', 255)->unique();
            $table->string('h1', 255)->nullable();
            $table->boolean('hidden')->default(false);
            //
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_robots')->nullable();
            $table->string('meta_image_size', 255)->nullable();
            $table->string('meta_type', 255)->nullable();
            $table->string('meta_site_name', 255)->nullable();
            $table->string('meta_site', 255)->nullable();
            $table->string('meta_local', 255)->nullable();
            $table->string('meta_card', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
