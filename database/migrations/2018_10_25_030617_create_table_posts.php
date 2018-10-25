<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->text('description')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->integer('cat_id')->unsigned();
            $table->integer('seo_id')->unsigned();
            $table->integer('content_id')->unsigned();
            $table->integer('sort_order')->nullable()->default(0);
            $table->integer('view_count')->unsigned()->default(0);
            $table->timestamp('published_date')->nullable();
            $table->string('thumb', 255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post');
    }
}
