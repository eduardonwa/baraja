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
        Schema::create('content_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rotation_cycle_item_id')->constrained()->cascadeOnDelete()->unique();
            $table->foreignId('account_id')->nullable()->constrained()->nullOnDelete();

            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->string('format')->nullable();
            $table->text('caption')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->text('hashtags')->nullable();
            $table->text('people_tagged_and_dmd')->nullable();
            $table->string('external_post_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['rotation_cycle_item_id', 'published_at'], 'rci_published_index');
            $table->index('published_at');
            $table->unique(['account_id', 'external_post_id'], 'account_external_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_posts');
    }
};
