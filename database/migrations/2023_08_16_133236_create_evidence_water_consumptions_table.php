<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidenceWaterConsumptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidence_water_consumptions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // NOMBRE ORIGINAL DEL ARCHIVO QUE SE ESTÁ ALMACENANDO
            $table->string('file'); // ARCHIVO QUE SE ESTÁ ALMACENANDO
            $table->unsignedBigInteger('water_consumption_id'); // REGISTRO DEL CONSUMO HÍDRICO
            $table->foreign('water_consumption_id', 'fk_wat_consumption_id')
                ->references('id')
                ->on('water_consumptions'); // REGISTRO DEL CONSUMO HÍDRICO
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
        Schema::dropIfExists('evidence_water_consumptions');
    }
}
