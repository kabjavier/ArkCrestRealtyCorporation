<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        \DB::statement("ALTER TABLE commission_requests MODIFY COLUMN status VARCHAR(50) NOT NULL DEFAULT 'Not Yet Released'");
    }

    public function down(): void
    {
        \DB::statement("ALTER TABLE commission_requests MODIFY COLUMN status ENUM('LIQUIDATED','NOT YET LIQUIDATED') NOT NULL DEFAULT 'NOT YET LIQUIDATED'");
    }
};
