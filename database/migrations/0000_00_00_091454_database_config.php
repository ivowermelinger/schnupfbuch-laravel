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
        DB::statement('ALTER DATABASE '. env('DB_DATABASE') .' CHARACTER SET utf8 COLLATE utf8_general_ci');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER DATABASE '. env('DB_DATABASE') .' CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    }
};