<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWasteManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waste_management', function (Blueprint $table) {
            $table->id();
            $table->enum('month', ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE']); // MES DE REPORTE
            $table->bigInteger('value'); // VALOR DEL RESIDUO GENERADO
            $table->longText('observations')->nullable(); // OBSERVACIONES SOBRE EL REGISTRO
            $table->foreignId('headquarter_id')->references('id')->on('headquarters'); // RELACIÓN CON LA SEDE
            $table->foreignId('user_id')->references('id')->on('users'); // RELACIÓN CON EL USUARIO QUE CREA EL REGISTRO O LO REPORTA
            $table->foreignId('waste_type_id')->references('id')->on('waste_types'); // TIPO DE RESIDUO
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
        Schema::dropIfExists('waste_management');
    }
}
