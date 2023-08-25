<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidenceWasteManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidence_waste_management', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // NOMBRE ORIGINAL DEL ARCHIVO QUE SE ESTÁ ALMACENANDO
            $table->string('file'); // ARCHIVO QUE SE ESTÁ ALMACENANDO
            $table->string('extension'); // EXTENSIÓN DEL ARCHIVO QUE SE ESTÁ ALMACENANDO
            $table->foreignId('waste_management_id')->references('id')->on('waste_management'); // REGISTRO DE GENERACIÓN DE RESIDUOS
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
        Schema::dropIfExists('evidence_waste_management');
    }
}
