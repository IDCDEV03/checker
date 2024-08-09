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
        Schema::table('truck_data_chks', function (Blueprint $table) {
            $table->string('round_chk')->after('status_chk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('truck_data_chks', function (Blueprint $table) {
            $table->dropColumn('round_chk');
        });
    }
};
