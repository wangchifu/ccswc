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
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('pass_user_id')->index()->nullable();            
            $table->string('title');
            $table->string('die_date');
            $table->text('content')->nullable();            
            $table->text('for_schools')->nullable();//給誰
            $table->tinyInteger('situation');//1已送出未審核；2已審核送出；3作廢；0退回                    
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
        Schema::dropIfExists('reports');
    }
};
