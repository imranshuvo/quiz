<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('question_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workspace_id')->constrained()->cascadeOnDelete();
            $table->foreignId('question_id')->constrained()->cascadeOnDelete();
            $table->string('label');
            // Stored value when this option is picked. Decoupled from `label` so
            // copy can change without invalidating prior responses.
            $table->string('value');
            $table->boolean('is_correct')->default(false);
            // For graded assessments: points awarded if this option contributes
            // to a correct answer. Negative allowed for penalty schemes.
            $table->decimal('score', 8, 2)->default(0);
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();

            $table->index(['question_id', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('question_options');
    }
};
