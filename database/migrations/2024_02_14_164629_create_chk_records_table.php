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
        Schema::create('chk_records', function (Blueprint $table) {
            $table->id();
            $table->string('agent_id');
            $table->string('user_id');
            $table->string('form_id');
            $table->string('choice_id');
            $table->tinyInteger('user_chk');
            $table->string('round_chk');
            $table->string('choice_remark');
            $table->string('choice_img');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chk_records');
    }
};
