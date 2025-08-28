<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Drop any existing incorrect tables
        Schema::dropIfExists('judul_halamen');
        
        // Create the correct table
        if (!Schema::hasTable('judul_halaman')) {
            Schema::create('judul_halaman', function (Blueprint $table) {
                $table->id();
                $table->string('judul');
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });

            // Insert default record
            DB::table('judul_halaman')->insert([
                'judul' => 'Kumpulan Link Website',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    public function down()
    {
        Schema::dropIfExists('judul_halaman');
    }
};
