<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividades', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome')->nullable();
            $table->float('percentual')->nullable();
            $table->date('prazo')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('responsavel')->nullable();
            $table->foreign('responsavel')->references('id')->on('users');
            $table->text('observacao')->nullable();
            $table->smallInteger('numeroPPA')->unsigned();
            $table->boolean('pPA')->nullable();
            $table->bigInteger('idAcao')->unsigned();
            $table->foreign('idAcao')->references('id')->on('acaos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('atividades');
    }
}
