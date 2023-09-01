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
        Schema::create('silabus', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('mdl_user_id');
            $table->unsignedBigInteger('state_type_id');
            $table->string('curso_name',125);
            $table->string('escuela',125);
            $table->string('ciclo',50)->nullable();
            $table->integer('creditos')->nullable();
            $table->integer('horas_teoricas')->nullable();
            $table->integer('horas_practicas')->nullable();
            $table->string('pdf_path')->nullable();
            $table->string('pdf_url')->nullable();
            $table->timestamps();

            $table->foreign('state_type_id')
                ->references('id')->on('state_types')
                ->onDelete('restrict');
            $table->foreign('mdl_user_id')
                ->references('id')->on(config('app.db_name_moodle').'.mdl_user')
                ->onDelete('cascade');
        });

        Schema::create('silabu_reqs', function (Blueprint $table) {
            $table->id();
            $table->string('name',125);
            $table->integer('orden')->nullable();
        });

        Schema::create('silabu_incomplete_reqs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('silabu_id');
            $table->unsignedBigInteger('silabu_req_id');
            $table->text('description')->nullable();

            $table->foreign('silabu_id')
                ->references('id')->on('silabus')
                ->onDelete('cascade');

            $table->foreign('silabu_req_id')
                ->references('id')->on('silabu_reqs')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('silabu_incomplete_reqs');
        Schema::dropIfExists('silabu_reqs');
        Schema::dropIfExists('silabus');
    }
};
