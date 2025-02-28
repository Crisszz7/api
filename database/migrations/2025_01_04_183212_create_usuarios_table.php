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
    Schema::create('usuarios', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('apellido');
        $table->BigInteger('identificacion')->unique();
        $table->string('celular')->nullable();
        $table->unsignedBigInteger('rol_id');
        $table->unsignedBigInteger('ficha_id')->nullable();
        $table->timestamps();

        $table->foreign('rol_id')->references('id')->on('rols')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('ficha_id')->references('id')->on('fichas')->onDelete('cascade')->onUpdate('cascade');
    });
}

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
