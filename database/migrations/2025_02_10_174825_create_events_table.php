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
        Schema::create('events', function (Blueprint $table)
        {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('color');

            $table->unsignedBigInteger('created_by'); // Usuario que creó el evento
            $table->dateTime('start_at');
            $table->dateTime('end_at');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
