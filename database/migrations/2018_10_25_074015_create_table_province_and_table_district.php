<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProvinceAndTableDistrict extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('province', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 191);
            $table->string('name', 191);
            $table->integer('ghn_code')->unsigned();
            $table->integer('shipchung_code')->unsigned();
        });

        Schema::create('district', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('province_id');
            $table->string('code', 191);
            $table->string('name', 191);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('province');
        Schema::dropIfExists('district');
    }
}
