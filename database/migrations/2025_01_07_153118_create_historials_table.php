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
        Schema::create('historials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('prestamo_id')->unique();
            $table->unsignedBigInteger('usuariosede_id');
            $table->enum('estado', ['activo', 'devuelto', 'mora']);
            $table->timestamps('');

            $table->foreign('usuario_id')->references('id')->on('usuarios')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('usuariosede_id')->references('id')->on('usuario_sedes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('prestamo_id')->references('id')->on('prestamos')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historials');
    }
};
