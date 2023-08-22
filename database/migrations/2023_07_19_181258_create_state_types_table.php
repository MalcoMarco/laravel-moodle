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
        Schema::create('state_types', function (Blueprint $table) {
            $table->id();
            $table->string('name',125);
            $table->string('guard_name',125);
            $table->integer('order');
            $table->unique(['guard_name']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state_types');
    }
};
