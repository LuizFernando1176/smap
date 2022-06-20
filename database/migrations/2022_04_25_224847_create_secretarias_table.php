<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecretariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secretarias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome')->nullable();
            $table->string('sigla')->nullable();
            $table->string('responsavel')->nullable();
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();
            $table->string('logradouro')->nullable();
            $table->unsignedTinyInteger('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->bigInteger('idSecretariaPai')->unsigned()->nullable();
            $table->foreign('idSecretariaPai')->references('id')->on('secretarias')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('secretarias');
    }
}
