<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_seasons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year');//年度
            $table->tinyInteger('season');//1春季班  2秋季班
            $table->string('start_date');//開學時間
            $table->string('code');            
            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('course_seasons');
    }
};
