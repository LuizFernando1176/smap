<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('legenda')->nullable();
            $table->string('foto')->nullable();
            $table->bigInteger('idHistorico')->unsigned();
            $table->foreign('idHistorico')->references('id')->on('historicos')->onDelete('cascade')->onUpdate('cascade');
            $table->softDeletes();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fotos');
    }
}
