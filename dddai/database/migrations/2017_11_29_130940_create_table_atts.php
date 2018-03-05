<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAtts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atts', function (Blueprint $table) {
            $table->increments('aid');//项目附属表
            $table->integer('uid');
            $table->integer('pid');
            $table->string('title',60);
            $table->string('realname',60);
            $table->tinyinteger('age')->unsigned();
            $table->enum('gender',['男','女']);//枚举
            $table->tinyinteger('salary');
            $table->string('jobcity',10);
            $table->string('udesc',500) ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('atts');
    }
}
