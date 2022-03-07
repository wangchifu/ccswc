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
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('pass_user_id')->nullable();
            $table->unsignedInteger('category_id');//1一般公告,2行政公告
            $table->string('title');
            $table->text('content')->nullable();
            $table->text('feedback_reason')->nullable();//退回理由
            $table->text('for_schools')->nullable();//行政公告給誰
            $table->tinyInteger('situation');//1已送出未審核；2已審核送出；3作廢；0退回
            $table->tinyInteger('type')->nullable();//null為一般 1為急件
            $table->unsignedInteger('views');
            $table->timestamp('passed_at')->nullable();
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
        Schema::dropIfExists('posts');
    }
};
