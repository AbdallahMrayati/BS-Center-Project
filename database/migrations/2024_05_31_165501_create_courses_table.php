<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('title', 999)->nullable();
            $table->string('slug', 255)->nullable();
            $table->string('h1', 255)->nullable();
            $table->string('lang', 5)->nullable();
            $table->longText('overview')->nullable();
            $table->text('description')->nullable();
            $table->longText('objectives')->nullable();
            $table->longText('brief')->nullable();
            $table->string('image_alt', 150)->nullable();
            $table->string('image_title', 150)->nullable();
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

            // Adding foreign key constraint
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
