<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workspace_id')->constrained()->cascadeOnDelete();
            $table->foreignId('questionnaire_id')->constrained()->cascadeOnDelete();
            // Either a logged-in user, an anonymous email, or just a session token.
            $table->foreignId('respondent_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('respondent_email')->nullable();
            $table->string('session_token', 64)->nullable()->index();
            $table->string('status')->default('in_progress');
            // Computed for graded assessments at submission time.
            $table->decimal('score', 10, 2)->nullable();
            $table->decimal('max_score', 10, 2)->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('submitted_at')->nullable();
            // ip hash, user-agent, locale, etc. Avoid raw IP for GDPR.
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->index(['questionnaire_id', 'status']);
            $table->index(['workspace_id', 'submitted_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
