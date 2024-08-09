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
        Schema::create('agent_form_pers', function (Blueprint $table) {
            $table->id();
            $table->string('agent_id');
            $table->string('form_id');
            $table->string('form_per');
            $table->tinyInteger('per_status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_form_pers');
    }
};
