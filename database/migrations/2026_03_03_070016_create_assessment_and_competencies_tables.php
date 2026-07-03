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
        Schema::create('competencies', function (Blueprint $table) {
            $table->id(); // PK id [cite: 145]
            $table->string('name'); // Key name [cite: 156]
            $table->timestamps(); // created_at [cite: 171]
            $table->softDeletes();
        });

        Schema::create('question', function (Blueprint $table) {
            $table->id(); // PK id [cite: 190]
            $table->foreignId('competence_id')->constrained('competencies'); // FK competence_id [cite: 195]
            $table->tinyInteger('level');
            $table->text('question_text')->nullable(); // Key question_text [cite: 198]
            $table->timestamps(); // created_at [cite: 171]
            $table->softDeletes();
        });

        Schema::create('development_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id_talent')->constrained('users');
            $table->foreignId('source_position_id')->nullable()->constrained('position')->nullOnDelete();
            $table->foreignId('target_position_id')->nullable()->constrained('position')->nullOnDelete();
            $table->foreignId('atasan_id')->nullable()->constrained('users')->nullOnDelete();
            $table->json('mentor_ids')->nullable();
            $table->string('status')->default('In Progress');
            $table->date('start_date')->nullable();
            $table->date('target_date')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id_talent', 'is_active']);
            $table->index(['target_position_id', 'is_active']);
        });

        Schema::create('assessment_session', function (Blueprint $table) {
            $table->id(); // PK id [cite: 196]
            $table->foreignId('user_id_talent')->constrained('users'); // FK user_id(kandidat) [cite: 202]
            $table->foreignId('development_session_id')->nullable()->constrained('development_sessions')->nullOnDelete();
            $table->foreignId('user_id_atasan')->nullable()->constrained('users'); // FK user_id(atasan) [cite: 209]
            $table->boolean('is_active')->default(true);
            $table->string('period'); // Key period [cite: 212]
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('detail_assessment', function (Blueprint $table) {
            $table->id(); // PK id [cite: 259]
            $table->foreignId('assessment_id')->constrained('assessment_session'); // FK assessment_id [cite: 265]
            $table->foreignId('competence_id')->constrained('competencies'); // FK competence_id [cite: 267]
            $table->integer('score_atasan'); // Key score_atasan [cite: 270]
            $table->integer('score_talent'); // Key score_talent [cite: 273]
            $table->decimal('gap_score', 8, 2); // Key gap_score [cite: 277]
            $table->string('notes'); // Key notes [cite: 275]
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('position_target_competence', function (Blueprint $table) {
            $table->id(); // PK id [cite: 280]
            $table->foreignId('position_id')->constrained('position'); // FK position_id [cite: 285]
            $table->foreignId('competence_id')->constrained('competencies'); // FK competence_id [cite: 287]
            $table->integer('target_level'); // Key target_level [cite: 290]
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('position_target_competence');
        Schema::dropIfExists('detail_assessment');
        Schema::dropIfExists('assessment_session');
        Schema::dropIfExists('development_sessions');
        Schema::dropIfExists('question');
        Schema::dropIfExists('competencies');
    }
};
