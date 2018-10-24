<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 191)->nullable();
            $table->tinyInteger('active')->default(1);
            $table->integer('parent_id')->default(0);
            $table->integer('sort_order')->default(0);
            $table->string('thumb', 191)->nullable();
            $table->string('gallery', 191)->nullable();
            $table->string('icon', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->string('slug', 255)->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('content_id')->unsigned()->nullable();
            $table->bigInteger('seo_id')->unsigned()->nullable();
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
        Schema::dropIfExists('category');
    }
}
