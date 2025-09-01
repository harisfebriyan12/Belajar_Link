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
    if (!Schema::hasColumn('judul_halaman', 'deskripsi')) {
        Schema::table('judul_halaman', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->after('judul');
        });
    }
}

public function down(): void
{
    if (Schema::hasColumn('judul_halaman', 'deskripsi')) {
        Schema::table('judul_halaman', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
        });
    }
}

};
