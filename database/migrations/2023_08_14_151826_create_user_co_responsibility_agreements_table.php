<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCoResponsibilityAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_co_responsibility_agreements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('co_responsibility_agreement_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('co_responsibility_agreement_id', 'fk_co_resp_agreement')
                ->references('id')
                ->on('co_responsibility_agreements')
                ->onDelete('cascade'); // REGISTRO DEL ACUERDO

            $table->foreign('user_id', 'fk_user_co_resp_agreement')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // REGISTRO DEL GESTOR AMBIENTAL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_co_responsibility_agreements');
    }
}
