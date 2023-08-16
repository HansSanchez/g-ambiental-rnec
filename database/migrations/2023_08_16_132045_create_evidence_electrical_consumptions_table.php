<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidenceElectricalConsumptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidence_electrical_consumptions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // NOMBRE ORIGINAL DEL ARCHIVO QUE SE ESTÁ ALMACENANDO
            $table->string('file'); // ARCHIVO QUE SE ESTÁ ALMACENANDO
            $table->unsignedBigInteger('electrical_consumption_id'); // REGISTRO DEL CONSUMO ELÉCTRICO
            $table->foreign('electrical_consumption_id', 'fk_elec_consumption_id')
                ->references('id')
                ->on('electrical_consumptions'); // REGISTRO DEL CONSUMO ELÉCTRICO
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
        Schema::dropIfExists('evidence_electrical_consumptions');
    }
}
