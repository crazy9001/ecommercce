<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('active')->unsigned()->default(1);
            $table->integer('cat_id')->unsigned();
            $table->integer('seo_id')->unsigned();
            $table->integer('content_id')->unsigned();
            $table->string('code', 100)->nullable();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->text('description')->nullable();
            $table->string('thumb', 255)->nullable();
            $table->text('gallery')->nullable();
            $table->integer('sort_order')->nullable()->default(0);
            $table->integer('view_count')->unsigned()->default(0);
            $table->timestamp('published_date')->nullable();
            $table->integer('price')->nullable();
            $table->integer('price_promotion')->nullable();
            $table->timestamp('start_promotion')->nullable();
            $table->timestamp('stop_promotion')->nullable();

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
        Schema::dropIfExists('product');
    }
}
