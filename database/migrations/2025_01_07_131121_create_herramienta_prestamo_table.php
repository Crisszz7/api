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
        Schema::create('herramienta_prestamo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prestamo_id');
            $table->unsignedBigInteger('herramienta_id');
            $table->unsignedInteger('cantidad'); 
            $table->timestamps();

            $table->foreign('prestamo_id')->references('id')->on('prestamos')->onUpdate('cascade');
            $table->foreign('herramienta_id')->references('id')->on('herramientas')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('herramienta_prestamo');
    }
};
