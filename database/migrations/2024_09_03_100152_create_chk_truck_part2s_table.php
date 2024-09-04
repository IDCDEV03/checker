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
        Schema::create('chk_truck_part2s', function (Blueprint $table) {
            $table->id();
            $table->string('transport_id');
            $table->string('truck_id');
            $table->string('user_id');
            $table->string('form_id');
            $table->string('round_id');
            $table->date('date_chk');
            $table->tinyInteger('chk_result')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chk_truck_part2s');
    }
};
