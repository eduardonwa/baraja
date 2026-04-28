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
        Schema::create('hypothesis_tests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('hypothesis_id')->constrained('hypotheses')->cascadeOnDelete();
            
            $table->text('change_description');
            $table->enum('result', [
                'pending',
                'confirmed',
                'rejected'
            ])->default('pending');
            
            $table->unsignedTinyInteger('signal_strength')->nullable();
            $table->text('observations')->nullable();
            $table->timestamps();

            $table->index(['hypothesis_id', 'result']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hypothesis_tests');
    }
};
