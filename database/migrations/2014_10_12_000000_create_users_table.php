<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('personal_id'); // PRIMER NOMBRE
            $table->string('first_name'); // PRIMER NOMBRE
            $table->string('second_name')->nullable(); // SEGUNDO NOMBRE (OPCIONAL)
            $table->string('first_last_name'); // PRIMER APELLIDO
            $table->string('second_last_name')->nullable(); // SEGUNDO APELLIDO (OPCIONAL)
            $table->string('email')->unique(); // CORREO ELECTRÓNICO
            $table->string('phone_number')->nullable(); // NÚMERO DE CELULAR
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password'); // CONTRASEÑA
            $table->enum('active', ['ACTIVO' , 'INACTIVO'])->default('ACTIVO'); // ESTADO DEL FUNCIONARI@
            $table->string('position')->nullable(); // CARGO DEL FUNCIONARI@
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
            $table->softDeletes(); // BORRADO LÓGICO
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
