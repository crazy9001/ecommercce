<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrderAndOrderItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('	code', 191);
            $table->tinyInteger('payment')->unsigned()->nullable();
            $table->tinyInteger('payment_status')->unsigned()->nullable();
            $table->string('	payment_method', 255)->nullable();
            $table->string('	name', 191);
            $table->tinyInteger('gender')->nullable();
            $table->string('	phone', 20);
            $table->string('	email', 50);
            $table->string('	address', 50);
            $table->smallInteger('district_id')->unsigned()->nullable();
            $table->smallInteger('province_id')->unsigned()->nullable();
            $table->smallInteger('ship_another_address')->unsigned()->default(0);
            $table->text('sname')->nullable();
            $table->string('	saddress', 255)->nullable();
            $table->smallInteger('sdistrict_id')->unsigned()->nullable();
            $table->smallInteger('sprovince_id')->unsigned()->nullable();
            $table->text('note')->nullable();
            $table->integer('status')->default(1);
            $table->tinyInteger('delivery_time')->nullable();
            $table->integer('total');

            $table->timestamps();
        });

        Schema::create('order_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('pro_id')->unsigned();
            $table->text('pro_thumb')->nullable();
            $table->string('	pro_name', 191);
            $table->integer('qty')->unsigned();
            $table->integer('price')->unsigned();
            $table->integer('subtotal')->unsigned();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
        Schema::dropIfExists('order_item');
    }
}
