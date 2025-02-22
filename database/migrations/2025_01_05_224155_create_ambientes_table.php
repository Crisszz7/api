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
        Schema::create('ambientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_ambiente');
            $table->string('codigo')->unique();
            $table->boolean('disponible')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ambientes');
    }
};
