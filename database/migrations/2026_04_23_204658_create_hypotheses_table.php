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
        Schema::create('hypotheses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_content_post_id')->constrained('content_posts')->cascadeOnDelete();
            
            $table->string('title')->nullable();
            $table->text('insight')->nullable();

            $table->enum('variable', [
                'hook',
                'topic',
                'visual',
                'format',
                'caption',
                'combination',
                'distribution',
                'other'
            ]);
            $table->string('variable_custom')->nullable();

            $table->enum('status', [
                'observing',
                'testing',
                'promising',
                'reliable',
                'discarded'
            ])->default('observing');

            $table->unsignedTinyInteger('positive_signals_count')->default(0);
            $table->unsignedTinyInteger('failed_tests_count')->default(0);
            $table->unsignedTinyInteger('confidence_score')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['status', 'variable']);

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hypotheses');
    }
};
