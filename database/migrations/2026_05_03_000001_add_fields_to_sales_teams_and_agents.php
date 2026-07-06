<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('sales_agents', 'is_active')) {
            Schema::table('sales_agents', function (Blueprint $table) {
                $table->boolean('is_active')->default(true)->after('name');
            });
        }

        if (Schema::hasColumn('sales_teams', 'sales_manager')) {
            Schema::table('sales_teams', function (Blueprint $table) {
                $table->string('sales_manager')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('sales_agents', 'is_active')) {
            Schema::table('sales_agents', function (Blueprint $table) {
                $table->dropColumn('is_active');
            });
        }
    }
};