<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
      public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('pid');
            $table->integer('uid');
            $table->string('name',60);
            $table->integer('money',30)->unsigned();//正数
            $table->char('mobile',11);
            $table->string('title',60);//项目名称
            $table->tinyinteger('rate')->unsigned();
            $table->tinyinteger('hrange')->unsigned();
            $table->tinyinteger('status');
            $table->integer('receive')->unsigned();
            $table->integer('pubtime')->unsigned();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projects');
    }
}
