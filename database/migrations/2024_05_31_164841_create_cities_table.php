<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('lang', 5)->nullable();
            //
            $table->string('title', 250)->nullable();
            $table->string('slug', 255);
            $table->string('h1', 255)->nullable();
            $table->text('description')->nullable();
            $table->boolean('hidden')->default(false);
            $table->string('image_title', 150)->nullable();
            $table->string('image_alt', 255)->nullable();
            //
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords', 255)->nullable();
            $table->string('meta_robots', 255)->nullable();
            $table->string('meta_type', 255)->nullable();
            $table->string('meta_site_name', 255)->nullable();
            $table->string('meta_site', 255)->nullable();
            $table->string('meta_local', 255)->nullable();
            $table->text('meta_card')->nullable();
            //
            $table->string('meta_image_size', 255)->nullable();

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
        Schema::dropIfExists('cities');
    }
}
