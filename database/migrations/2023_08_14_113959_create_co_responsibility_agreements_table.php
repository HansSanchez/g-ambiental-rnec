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
            $table->foreignId('municipality_id')->nullable()->references('id')->on('municipalities'); // MUNICIPIO DE LA SEDE O DELEGACIÓN
            $table->string('environmental_operator'); // OPERADOR AMBIENTAL
            $table->timestamp('date')->default(now()->format('Y-m-d H:i')); // FECHA DE LA FIRMA
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
