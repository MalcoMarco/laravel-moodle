<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('historial_clinicos', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('mdl_user_id');
            $table->string('talla',20)->nullable();
            $table->string('peso',20)->nullable();
            $table->string('imc',20)->nullable();
            $table->string('grupo_sanguineo',20)->nullable();
            $table->boolean('alergia')->default(false);
            $table->string('alergia_especifique',100)->nullable();
            $table->string('enfermedad',200)->nullable();
            $table->string('enfermedad_especifique',200)->nullable();

            $table->date('fecha_consulta');
            $table->time('hora_consulta');
            $table->text('motivo')->nullable();
            $table->text('examen_fisico')->nullable();
            $table->string('diagnostico',200)->nullable();
            $table->text('tratamiento')->nullable();
            $table->string('observacion',200)->nullable();
            $table->string('personal_a_cargo',200)->nullable();

            $table->string('pa',20)->nullable();
            $table->string('fc',20)->nullable();
            $table->string('fr',20)->nullable();
            $table->string('tc',20)->nullable();

            $table->timestamps();

            $table->foreign('mdl_user_id')
                ->references('id')->on(config('app.db_name_moodle').'.mdl_user')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_clinicos');
    }
};
