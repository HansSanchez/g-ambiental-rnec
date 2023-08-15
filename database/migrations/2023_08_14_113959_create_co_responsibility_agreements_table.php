<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoResponsibilityAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('co_responsibility_agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delegation_id')->references('id')->on('delegations'); // SEDE O DELEGACIÓN
            $table->foreignId('user_id')->references('id')->on('users'); // RELACIÓN CON EL USUARIO QUE CREA EL REGISTRO O LO REPORTA
            $table->string('environmental_operator'); // OPERADOR AMBIENTAL (ES MEJOR QUE SEA ABIERTO)
            $table->timestamp('date')->default(now()->format('Y-m-d H:i')); // FECHA DE LA FIRMA
            $table->enum('state', ['VIGENTE', 'NO VIGENTE']); // ESTADO DEL ACUERDO
            $table->longText('observations')->nullable(); // OBSERVACIONES SOBRE EL ACUERDO
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
        Schema::dropIfExists('co_responsibility_agreements');
    }
}
