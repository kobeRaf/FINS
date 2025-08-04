<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('system_theme', function (Blueprint $table) {
            $table->id(); 
            $table->string('logo')->nullable();
            $table->string('theme_color')->nullable();
            $table->string('bg_color')->nullable();
            $table->string('text_color')->nullable();
            $table->string('system_name')->nullable();
            $table->string('sub_system_name')->nullable();
            $table->timestamps();
        });
        Schema::create('system_reports_logo', function (Blueprint $table) {
            $table->id(); 
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_theme');
    }
};
