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
        Schema::table('agent_form_lists', function (Blueprint $table) {
            $table->string('leader_role')->after('agentform_status')->nullable();
            $table->string('company_role')->after('leader_role')->nullable();
            $table->string('user_role')->after('company_role')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agent_form_lists', function (Blueprint $table) {
            $table->string('leader_role');
            $table->string('company_role');
            $table->string('user_role');
        });
    }
};
