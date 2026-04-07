<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('bean_id')->constrained()->cascadeOnDelete();
            $table->enum('method', ['v60', 'aeropress', 'espresso', 'french_press', 'chemex']);
            $table->decimal('dose_grams', 6, 2);
            $table->decimal('yield_grams', 6, 2);
            $table->unsignedInteger('brew_time_seconds');
            $table->string('grind_setting')->nullable();
            $table->decimal('water_temp_c', 5, 2)->nullable();
            $table->text('taste_notes')->nullable();
            $table->unsignedTinyInteger('rating');
            $table->timestamp('brewed_at');
            $table->timestamps();

            $table->index(['user_id', 'brewed_at']);
            $table->index('bean_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brews');
    }
};
