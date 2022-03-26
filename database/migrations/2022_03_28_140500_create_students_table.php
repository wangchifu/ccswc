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
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year'); //年度
            $table->string('code');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('t1_sb')->nullable();
            $table->unsignedInteger('t1_sg')->nullable();
            $table->unsignedInteger('t1_fb')->nullable();
            $table->unsignedInteger('t1_fg')->nullable();
            $table->unsignedInteger('t2_sb')->nullable();
            $table->unsignedInteger('t2_sg')->nullable();
            $table->unsignedInteger('t2_fb')->nullable();
            $table->unsignedInteger('t2_fg')->nullable();
            $table->unsignedInteger('t3_sb')->nullable();
            $table->unsignedInteger('t3_sg')->nullable();
            $table->unsignedInteger('t3_fb')->nullable();
            $table->unsignedInteger('t3_fg')->nullable();
            $table->unsignedInteger('t4_sb')->nullable();
            $table->unsignedInteger('t4_sg')->nullable();
            $table->unsignedInteger('t4_fb')->nullable();
            $table->unsignedInteger('t4_fg')->nullable();
            $table->unsignedInteger('a1_sb')->nullable();
            $table->unsignedInteger('a1_sg')->nullable();
            $table->unsignedInteger('a1_fb')->nullable();
            $table->unsignedInteger('a1_fg')->nullable();
            $table->unsignedInteger('a2_sb')->nullable();
            $table->unsignedInteger('a2_sg')->nullable();
            $table->unsignedInteger('a2_fb')->nullable();
            $table->unsignedInteger('a2_fg')->nullable();
            $table->unsignedInteger('a3_sb')->nullable();
            $table->unsignedInteger('a3_sg')->nullable();
            $table->unsignedInteger('a3_fb')->nullable();
            $table->unsignedInteger('a3_fg')->nullable();
            $table->unsignedInteger('a4_sb')->nullable();
            $table->unsignedInteger('a4_sg')->nullable();
            $table->unsignedInteger('a4_fb')->nullable();
            $table->unsignedInteger('a4_fg')->nullable();
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
        Schema::dropIfExists('students');
    }
};
