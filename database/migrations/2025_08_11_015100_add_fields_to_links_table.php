<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // These columns are already in the initial migration
        // No need to add them again
    }

    public function down(): void
    {
        // No changes needed
    }
};
