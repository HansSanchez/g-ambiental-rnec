<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreePlantationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tree_plantations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delegation_id')->references('id')->on('delegations'); // SEDE O DELEGACIÓN
            $table->integer('number_of_trees_planted')->default(0); // NÚMERO DE ÁRBOLES PLANTADOS (AÑO)
            $table->timestamp('date')->default(now()->format('Y-m-d H:i')); // FECHA DE PLATACIÓN
            $table->longText('address'); // DIRECCIÓN EN DONDE SE PLANTARON LOS ÁRBOLES
            $table->string('lat'); // LATITUD
            $table->string('lng'); // LONGITUD
            $table->longText('observations')->nullable(); // OBSERVACIONES SOBRE LA PLATACIÓN
            $table->foreignId('user_id')->references('id')->on('users'); // RELACIÓN CON EL USUARIO QUE CREA EL REGISTRO O LO REPORTA
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
        Schema::dropIfExists('tree_plantations');
    }
}
