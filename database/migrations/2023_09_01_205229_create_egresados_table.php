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
        Schema::create('egresados', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('mdl_user_id');
            $table->string('especialidad',100)->nullable();
            $table->string('programa_estudios',100)->nullable();
            $table->string('ingreso',100)->nullable();
            $table->string('egreso',100)->nullable();
            $table->string('nivel',100)->nullable();
            $table->string('parentesco',100)->nullable();
            $table->string('fullname',100)->nullable();
            $table->string('num_documento',100)->nullable();
            $table->string('direccion',100)->nullable();
            $table->string('email',100)->nullable();
            $table->string('phone',100)->nullable();
            $table->string('empresa',100)->nullable();
            $table->string('ocupacion',100)->nullable();
            $table->string('email_empresa',100)->nullable();
            $table->string('direccion_empresa',100)->nullable();
            $table->string('evidencia',100)->nullable();
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
        Schema::dropIfExists('egresados');
    }
};
