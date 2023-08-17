<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidenceTreePlantationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidence_tree_plantations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // NOMBRE DEL ARCHIVO QUE SE ESTÁ ALMACENANDO
            $table->string('file'); // ARCHIVO QUE SE ESTÁ ALMACENANDO
            $table->foreignId('tree_plantation_id')->references('id')->on('tree_plantations'); // REGISTRO DE PLANTACIÓN
            $table->timestamps(); // CREACIÓN Y ACTUALIZACIÓN
            $table->softDeletes(); // ELIMINACIÓN
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evidence_tree_plantations');
    }
}
