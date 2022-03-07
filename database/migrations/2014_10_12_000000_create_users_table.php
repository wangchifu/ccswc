<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('login_type')->nullable();
            $table->string('code')->nullable(); //gsuite's code
            $table->string('kind')->nullable(); //gsuite's kind
            $table->string('title')->nullable(); //gsuite's title
            $table->tinyInteger('admin')->nullable(); //1系統管理者
            $table->tinyInteger('school_admin')->nullable(); //1社大管理者
            $table->tinyInteger('social_education')->nullable();//null 0申請中 1社教科員  2社教科長
            $table->string('name');
            $table->string('email')->nullable();
            $table->tinyInteger('disable')->nullable(); //1=disable
            $table->timestamps();
            //以下未用
            $table->foreignId('current_team_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('profile_photo_path', 2048)->nullable();
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
};
