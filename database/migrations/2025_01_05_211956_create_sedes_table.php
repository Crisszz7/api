<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('sedes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_sede');
            $table->unsignedBigInteger('numero_sede');
            $table->boolean('estado')->default(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sedes');
    }
};
