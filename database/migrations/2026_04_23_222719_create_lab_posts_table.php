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
        Schema::create('lab_posts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('hypothesis_test_id')->unique()->constrained('hypothesis_tests')->cascadeOnDelete();

            $table->string('title')->nullable();
            $table->text('caption')->nullable();
            $table->string('platform')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_posts');
    }
};
