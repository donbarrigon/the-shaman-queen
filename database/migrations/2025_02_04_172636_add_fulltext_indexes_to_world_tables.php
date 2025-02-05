<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->fullText('name');
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->fullText('name');
        });

        Schema::table('states', function (Blueprint $table) {
            $table->fullText('name');
        });
    }

    public function down()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropFullText(['name']);
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->dropFullText(['name']);
        });

        Schema::table('states', function (Blueprint $table) {
            $table->dropFullText(['name']);
        });
    }
};
