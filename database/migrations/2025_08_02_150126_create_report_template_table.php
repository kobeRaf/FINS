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
        Schema::create('report_template', function (Blueprint $table) {
            $table->id();
            $table->string('header_logo_1a')->nullable();
            $table->string('header_logo_1b')->nullable();
            $table->string('header_logo_1c')->nullable();
            $table->string('header_logo_1d')->nullable();
            $table->string('footer_logo_2a')->nullable();
            $table->string('footer_logo_2b')->nullable();
            $table->string('footer_logo_2c')->nullable();
            $table->string('footer_logo_2d')->nullable();
            $table->string('report_title')->nullable();
            $table->string('report_subtitle')->nullable();
            $table->string('footer_title')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_template');
    }
};
