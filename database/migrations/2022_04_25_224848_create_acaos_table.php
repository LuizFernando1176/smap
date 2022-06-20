<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acaos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome')->nullable();
            $table->float('percentual')->nullable();
            $table->date('prazo')->nullable();
            $table->smallInteger('exercicio')->nullable();
            $table->string('status');
            $table->bigInteger('idSecretaria')->unsigned();
            $table->foreign('idSecretaria')->references('id')->on('secretarias')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('acaos');
    }
}
