<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('herramientas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_herramienta');
            $table->string('codigo')->unique();
            $table->unsignedInteger('stock')->default(0);
            $table->string('ubicacion');
            $table->unsignedBigInteger('usuariosede_id');
            $table->timestamps();

            $table->foreign('usuariosede_id')->references('id')->on('usuario_sedes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('herramientas');
    }
};
