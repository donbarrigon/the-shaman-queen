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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nick')->nullable()->unique();
            $table->string('phone')->nullable()->unique();
            $table->string('address')->nullable();
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('address_complement')->nullable();
            $table->string('postal_code')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['nick']);
            $table->dropColumn('nick');

            $table->dropUnique(['phone']);
            $table->dropColumn('phone');

            $table->dropColumn('address');

            $table->dropForeign('users_city_id_foreign');
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');

            $table->dropColumn('address_complement');
            $table->dropColumn('postal_code');

            $table->dropSoftDeletes();
        });
    }

};
