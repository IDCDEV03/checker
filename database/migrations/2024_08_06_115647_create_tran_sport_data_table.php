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
        Schema::create('tran_sport_data', function (Blueprint $table) {
            $table->id();
            $table->string('ts_agent');
            $table->string('ts_name');
            $table->string('ts_address');
            $table->string('ts_province');
            $table->string('ts_amphur');
            $table->string('ts_tambon');
            $table->string('ts_zipcode');
            $table->string('ts_phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tran_sport_data');
    }
};
