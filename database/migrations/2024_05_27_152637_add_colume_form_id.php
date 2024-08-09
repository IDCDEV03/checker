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
        Schema::table('detail_records', function (Blueprint $table) {
            $table->string('form_id_chk')->after('std_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_records', function (Blueprint $table) {
            $table->dropColumn('form_id_chk');
        });
    }
};
