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
        Schema::create('maladie_medicament', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maladie_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('medicament_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maladie_medicament');
    }
};
