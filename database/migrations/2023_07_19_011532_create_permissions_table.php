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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name',125);       // For MySQL 8.0 use string('name', 125);
            $table->string('guard_name',125)->nullable();; // For MySQL 8.0 use string('guard_name', 125);

            $table->unique(['name']);
        });

        Schema::create('role_has_permissions', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('mdl_role_id');

            // $table->foreign('permission_id')
            //     ->references('id') // permission id
            //     ->on('permissions')
            //     ->onDelete('cascade');

            // $table->foreign('mdl_role_id')
            //     ->references('id') // role id
            //     ->on('mdl_role') //conexion a la otra bd ?¡??¡?
            //     ->onDelete('cascade');
            $table->unique(['permission_id', 'mdl_role_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_has_permissions');
        Schema::dropIfExists('permissions');
    }
};
