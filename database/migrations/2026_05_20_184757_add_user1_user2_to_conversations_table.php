<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up(): void
    {

    }

    public function down(): void
    {
        Schema::table('conversations', function (Blueprint $table) {

            $table->dropForeign(['user1_id']);
            $table->dropForeign(['user2_id']);

            $table->dropColumn([
                'user1_id',
                'user2_id'
            ]);

        });
    }
};
