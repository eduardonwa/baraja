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
        Schema::create('account_platformables', function (Blueprint $table) {
            $table->id();

            $table->foreignId('account_platform_id')->constrained()->cascadeOnDelete();

            $table->unsignedBigInteger('account_platformable_id');
            $table->string('account_platformable_type');

            $table->timestamps();

            $table->index(
                ['account_platformable_type', 'account_platformable_id'],
                'apl_type_id_idx'
            );

            $table->unique(
                [
                    'account_platform_id',
                    'account_platformable_id',
                    'account_platformable_type',
                ],
                'apl_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_platformables');
    }
};
