<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            // workspace_id is denormalized so the global tenancy scope works
            // without joining through questionnaires on every query.
            $table->foreignId('workspace_id')->constrained()->cascadeOnDelete();
            $table->foreignId('questionnaire_id')->constrained()->cascadeOnDelete();
            $table->string('type');
            $table->string('title');
            $table->text('helper')->nullable();
            $table->boolean('required')->default(false);
            $table->unsignedInteger('position')->default(0);
            // Type-specific config: scale_min/max, max_length, accepted_file_types, etc.
            $table->json('meta')->nullable();
            // Skip-logic rules. Interpreted at taker time; opaque here.
            $table->json('branching')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['questionnaire_id', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
