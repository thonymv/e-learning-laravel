<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsNodeLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options_node_lesson', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('node_lesson_id');//nodo de test al que pertenece
            $table->bigInteger('position_init');//posición inicial para test tipo reorganizar
            $table->bigInteger('position_success');//posición correcta para test tipo reorganizar
            $table->string('response');//texto para uso entre los diferentes tipos de test
            $table->boolean('success');//booleano que determina si es correcta las respuesta para test de selección simple o verdadero o falso
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
        Schema::dropIfExists('options_node_lesson');
    }
}
