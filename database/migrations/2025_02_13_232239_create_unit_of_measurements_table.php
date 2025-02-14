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
        Schema::create('unit_of_measurements', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ejemplo: Gramo, Litro
            $table->string('symbol'); // Ejemplo: g, kg, L
            $table->string('group');
            $table->decimal('equivalence', 10, 4)->default(1); // Equivalencia respecto a la unidad base del grupo
            $table->boolean('is_base')->default(false); // Indica si es la unidad base del grupo
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_of_measurements');
    }
};
