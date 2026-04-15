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
        Schema::create('content_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rotation_cycle_item_id')->constrained()->cascadeOnDelete();
            
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->string('format')->nullable();
            $table->text('people_tagged_and_dmd')->nullable();
            $table->text('hashtags_used')->nullable();
            
            $table->unsignedInteger('profile_visits')->nullable();
            $table->unsignedInteger('follows')->nullable();

            $table->unsignedInteger('likes')->nullable();
            $table->unsignedInteger('comments')->nullable();
            $table->unsignedInteger('shares')->nullable();
            $table->unsignedInteger('saves')->nullable();
            $table->unsignedInteger('reposts')->nullable();
            $table->unsignedInteger('views')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_metrics');
    }
};
