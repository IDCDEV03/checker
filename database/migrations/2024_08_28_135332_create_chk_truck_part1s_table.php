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
        Schema::create('chk_truck_part1s', function (Blueprint $table) {
            $table->id();
            $table->string('transport_id');
            $table->string('truck_id');
            $table->string('form_id');
            $table->tinyInteger('chk_round')->nullable();
            $table->string('img_1')->nullable();
            $table->string('img_2')->nullable();
            $table->string('img_3')->nullable();
            $table->string('img_4')->nullable();
            $table->string('img_5')->nullable();
            $table->string('img_6')->nullable();
            $table->string('img_7')->nullable();
            $table->string('img_8')->nullable();
            $table->string('round_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chk_truck_part1s');
    }
};
