<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeadquartersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('headquarters', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // NOMBRE DE LA SEDE
            $table->string('in_charge')->nullable(); // PERSONA A CARGO
            $table->string('type'); // TIPO DE SEDE
            $table->foreignId('delegation_id')->references('id')->on('delegations'); // RELACIÓN CON LA DELACIÓN
            $table->foreignId('municipality_id')->references('id')->on('municipalities'); // RELACIÓN CON EL MUNICIPIO
            $table->foreignId('user_id')->nullable()->references('id')->on('users'); // RELACIÓN CON EL USUARIO QUE CREA EL REGISTRO O LO REPORTA
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
        Schema::dropIfExists('headquarters');
    }
}
