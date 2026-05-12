<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workspace_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            // What was the AI asked to do? generate_questions | grade_answer | insights | other
            $table->string('kind', 32);
            $table->string('provider', 32);
            $table->string('model');
            $table->unsignedInteger('prompt_tokens')->default(0);
            $table->unsignedInteger('completion_tokens')->default(0);
            // Rough cost estimate computed at call time. Stored in cents to
            // avoid float drift in totals.
            $table->unsignedInteger('cost_cents')->default(0);
            // Free-form refs so we can join back to a generated questionnaire,
            // a graded response, an analyzed batch, etc.
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->index(['workspace_id', 'kind']);
            $table->index(['workspace_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_usages');
    }
};
