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
            $table->foreignId('account_id')->nullable()->constrained()->nullOnDelete();

            // NEW VARIANT INFO
            $table->string('variable_variant');
            $table->text('notes')->nullable();            
            // EXTRA INFO
            $table->text('caption')->nullable();
            $table->boolean('same_format')->default(true);
            $table->string('format_used')->nullable();
            $table->dateTime('published_at')->nullable();

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
