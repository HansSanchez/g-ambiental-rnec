<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipalities', function (Blueprint $table) {
            $table->id();
            $table->string('state_code'); // CÓDIGO DE DEPARTAMENTO O DELEGACIÓN
            $table->string('state_name'); // NOMBRE DEL DEPARTAMENTO O DELEGACIÓN
            $table->string('city_code'); // CÓDIGO DEL MUNICIPIO
            $table->string('city_name'); // NOMBRE DEL MUNICIPIO
            $table->longText('profile_photo_path')->nullable(); // IMAGEN DEL REPRESENTANTE
            $table->boolean('active')->default(true); // ESTADO DEL MUNICIO (ACTIVO O INACTIVO)
            $table->foreignId('delegation_id')->references('id')->on('delegations'); // SEDE O DELEGACIÓN
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
        Schema::dropIfExists('municipalities');
    }
}
