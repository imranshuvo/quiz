<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('response_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workspace_id')->constrained()->cascadeOnDelete();
            $table->foreignId('response_id')->constrained()->cascadeOnDelete();
            $table->foreignId('question_id')->constrained()->cascadeOnDelete();
            // Stored as JSON to fit every question type:
            //   single_choice → "option-value"
            //   multi_choice  → ["a", "b"]
            //   short_text    → "Hello"
            //   nps           → 7
            //   ranking       → ["a", "c", "b"]
            $table->json('value')->nullable();
            // For auto-graded types these are filled at submission. For
            // open-ended (text), the AI grader fills them later.
            $table->boolean('is_correct')->nullable();
            $table->decimal('score', 8, 2)->nullable();
            $table->timestamp('answered_at')->nullable();
            $table->timestamps();

            $table->unique(['response_id', 'question_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('response_answers');
    }
};
