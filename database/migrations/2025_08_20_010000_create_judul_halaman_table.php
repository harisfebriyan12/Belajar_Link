<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('judul_halamen'); // Drop the incorrect table if it exists
        Schema::dropIfExists('judul_halaman'); // Drop the correct table if it exists
        
        Schema::create('judul_halaman', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('judul_halaman');
    }
};
