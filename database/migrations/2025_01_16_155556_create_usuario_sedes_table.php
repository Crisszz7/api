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
        Schema::create('usuario_sedes', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('contrasena');
            $table->unsignedBigInteger('sede_id');
            $table->timestamps();

            $table->foreign('sede_id')->references('id')->on('sedes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_sedes');
    }
};
