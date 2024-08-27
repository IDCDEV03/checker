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
        Schema::create('truck_data', function (Blueprint $table) {
            $table->id();
            $table->string('truck_id');
            $table->string('transport_id');
            $table->string('plate_top');
            $table->string('plate_bottom')->nullable();
            $table->string('truck_type');
            $table->string('date_truck_enroll');
            $table->string('weight_max');
            $table->string('weight_all');
            $table->date('truck_insure_expired');
            $table->date('truck_tax_expired');
            $table->string('truck_product')->nullable();
            $table->string('truck_fuel')->nullable();
            $table->tinyInteger('status_truck')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('truck_data');
    }
};
