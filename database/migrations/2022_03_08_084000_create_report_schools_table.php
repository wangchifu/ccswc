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
        Schema::create('report_schools', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('report_id')->index();
            $table->string('code')->index();
            $table->unsignedInteger('signed_user_id')->index()->nullable();
            $table->unsignedInteger('review_user_id')->nullable();
            $table->timestamp('signed_at')->nullable();
            $table->tinyInteger('situation')->nullable();//1已送出未審核；2已審核送出；3不填報；0退回
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
        Schema::dropIfExists('report_schools');
    }
};
