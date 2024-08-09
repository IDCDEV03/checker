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
        Schema::create('form_chks', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('form_id')->unique();
            $table->string('form_name');
            $table->string('form_category')->nullable();
            $table->tinyInteger('form_status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_chks');
    }
};
