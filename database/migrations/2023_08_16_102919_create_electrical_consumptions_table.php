<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElectricalConsumptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electrical_consumptions', function (Blueprint $table) {
            $table->id();
            $table->string('environmental_manager'); // GESTOR(A) AMBIENTAL (ES MEJOR QUE SEA ABIERTO)
            $table->foreignId('delegation_id')->references('id')->on('delegations'); // SEDE O DELEGACIÓN
            $table->foreignId('municipality_id')->references('id')->on('municipalities'); // MUNICIPIO
            $table->string('year'); // AÑO DE RESPORTE (PUEDA QUE QUIERAN CARGAR HISTORICOS)
            $table->enum('month', ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE']); // MES DE REPORTE
            $table->bigInteger('kw_monthly'); // KILOWATTS EN EL MES
            $table->bigInteger('total_staff'); // TOTAL DE PERSONAL
            $table->longText('observations')->nullable(); // OBSERVACIONES SOBRE EL REGISTRO
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
        Schema::dropIfExists('electrical_consumptions');
    }
}
