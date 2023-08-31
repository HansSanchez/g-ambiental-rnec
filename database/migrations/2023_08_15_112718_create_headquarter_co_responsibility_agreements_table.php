<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeadquarterCoResponsibilityAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('headquarter_co_responsibility_agreements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('co_responsibility_agreement_id');
            $table->unsignedBigInteger('headquarter_id');
            $table->timestamps();

            $table->foreign('co_responsibility_agreement_id', 'fk_co_respon_agreement')
                ->references('id')
                ->on('co_responsibility_agreements')
                ->onDelete('cascade'); // REGISTRO DEL ACUERDO

            $table->foreign('headquarter_id', 'fk_headquarter_co_resp_agreement')
                ->references('id')
                ->on('municipalities')
                ->onDelete('cascade'); // REGISTRO DE(LOS) MUNICIPIO(S)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('headquarter_co_responsibility_agreements');
    }
}
