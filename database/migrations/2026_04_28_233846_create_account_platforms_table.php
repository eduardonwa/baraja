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
        Schema::create('account_platforms', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            $table->enum('network', [
                'facebook',
                'instagram',
                'threads',
                'tiktok',
                'youtube',
                'x',
                'other'
            ]);
            $table->string('handle')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'network', 'handle']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_platforms');
    }
};
