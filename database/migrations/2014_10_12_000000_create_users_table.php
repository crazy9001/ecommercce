<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->string('avatar', 255)->nullable();
            $table->string('email', 191)->unique();
            $table->string('phone', 15)->nullable();
            $table->tinyInteger('gender')->default(0)->comment = "0:CXD ; 1:Nam; 2:Nu";
            $table->smallInteger('province_id')->unsigned()->nullable();
            $table->smallInteger('district_id')->unsigned()->nullable();
            $table->string('address', 255)->nullable();
            $table->string('password');
            $table->tinyInteger('user_type')->default(0)->comment = "0:Super Admin; 1:Admin; 2:User Register";
            $table->string('facebook', 255)->nullable();
            $table->string('google', 255)->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
