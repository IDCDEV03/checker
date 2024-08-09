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
        Schema::create('truck_data_chks', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id');
            $table->string('ts_agent');
            $table->string('form_chk');
            $table->string('plate_top');
            $table->string('plate_bottom');
            $table->tinyInteger('chk_num')->default('1');
            $table->tinyInteger('status_chk')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('truck_data_chks');
    }
};
