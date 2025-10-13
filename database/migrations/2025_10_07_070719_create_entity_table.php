<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entity', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no')->unique();
            $table->string('entity_name');
            $table->string('entity_type')->nullable(); // e.g., 'Employee', 'Supplier', etc.
            $table->string('entity_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entity');
    }
};
