<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Iletisimm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iletisimm', function (Blueprint $table) {
            $table->id();
            $table->string("adsoyad")->nullable();
            $table->string("mail")->nullable();
            $table->string("telefon")->nullable();
            $table->text("metin")->nullable();
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
        Schema::dropIfExists('iletisimm');
    }
}
