<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Kayitt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kayitt', function (Blueprint $table) {
            $table->id();
            $table->string("username")->nullable();
            $table->string("email")->nullable();
            $table->string("password")->nullable();
            $table->text("repassword")->nullable();
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
        Schema::dropIfExists('kayitt');
    }
}
