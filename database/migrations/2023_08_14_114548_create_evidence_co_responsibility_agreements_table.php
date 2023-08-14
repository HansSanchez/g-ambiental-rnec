<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidenceCoResponsibilityAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidence_co_responsibility_agreements', function (Blueprint $table) {
            $table->id();
            $table->string('file'); // NOMBRE DEL ARCHIVO QUE SE ESTÁ ALMACENANDO
            $table->unsignedBigInteger('co_responsibility_agreement_id'); // REGISTRO DEL ACUERDO
            $table->foreign('co_responsibility_agreement_id', 'fk_co_resp_agreement_id')
                ->references('id')
                ->on('co_responsibility_agreements'); // LLAVE FORANEA PARA REGISTRO DEL ACUERDO
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
        Schema::dropIfExists('evidence_co_responsibility_agreements');
    }
}
