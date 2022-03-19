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
        Schema::create('communities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('school_name')->nullable();
            $table->string('principal_name')->nullable();
            $table->string('address')->nullable();
            $table->string('telephone_number')->nullable();
            $table->string('fax_number')->nullable();
            $table->string('email')->nullable();
            $table->text('branch')->nullable();
            $table->string('class_location')->nullable();
            $table->string('website')->nullable();
            $table->string('unit')->nullable();
            $table->string('introduction')->nullable();
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
        Schema::dropIfExists('communities');
    }
};
