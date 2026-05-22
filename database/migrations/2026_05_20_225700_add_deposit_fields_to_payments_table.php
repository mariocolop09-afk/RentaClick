<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            $table->decimal('deposit_amount', 10, 2)->default(0);

            $table->string('deposit_status')->default('authorized');

            // authorized
            // released
            // retained

        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            $table->dropColumn([
                'deposit_amount',
                'deposit_status'
            ]);

        });
    }
};
