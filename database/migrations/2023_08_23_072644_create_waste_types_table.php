<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWasteTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waste_types', function (Blueprint $table) {
            $table->id();
            $table->text('name'); // TIPO DE RESIDUO (NOMBRE)
            $table->text('danger_current')->nullable(); // CORRIENTE DE PELIGROSIDAD
            $table->longText('transportation_manager')->nullable(); // ENCARGADO TRANSPORTE
            $table->longText('external_manager')->nullable(); // GESTOR EXTERNO
            $table->longText('environmental_license')->nullable(); // LICENCIA AMBIENTAL
            $table->longText('certificate_or_type_of_treatment')->nullable(); // CERTIFICADO / TIPO DE TRATAMIENT
            $table->string('year'); // AÑO
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
        Schema::dropIfExists('waste_types');
    }
}
