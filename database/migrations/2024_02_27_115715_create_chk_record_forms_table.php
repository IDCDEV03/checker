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
        Schema::create('chk_record_forms', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('car_id');
            $table->string('car_mileage');
            $table->string('round_chk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chk_record_forms');
    }
};
