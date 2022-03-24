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
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_season_id');
            $table->string('type');//課程類型
            $table->string('name');
            $table->string('place');
            $table->string('hour');//學分數
            $table->string('teacher');
            $table->string('time');
            $table->unsignedInteger('students')->nullable();//學生總數
            $table->unsignedInteger('situation')->nullable();//1開班  2未開班
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
        Schema::dropIfExists('courses');
    }
};
