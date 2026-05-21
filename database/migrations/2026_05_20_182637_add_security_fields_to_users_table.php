<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('phone')->nullable();

            $table->string('address')->nullable();

            $table->string('dpi')->nullable();

            $table->string('profile_photo')->nullable();

            $table->string('dpi_photo')->nullable();

            $table->boolean('is_verified')->default(false);

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'phone',
                'address',
                'dpi',
                'profile_photo',
                'dpi_photo',
                'is_verified'
            ]);

        });
    }
};
