<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workspace_id')->constrained()->cascadeOnDelete();
            $table->foreignId('creator_id')->constrained('users')->cascadeOnDelete();
            $table->string('kind');
            $table->string('status')->default('draft');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('slug', 64)->unique();
            // Type/feature flags: allow_anonymous, time_limit_seconds, max_attempts,
            // show_results, password_hash, etc. Kept opaque at the schema level so
            // we can iterate without migrations.
            $table->json('settings')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['workspace_id', 'status']);
            $table->index(['workspace_id', 'kind']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questionnaires');
    }
};
