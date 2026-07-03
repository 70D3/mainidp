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
        Schema::create('panelis_assessments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id_talent');
            $table->foreignId('development_session_id')->nullable()->constrained('development_sessions')->nullOnDelete();
            $table->unsignedBigInteger('panelis_id');
            $table->integer('panelis_score')->nullable();
            $table->json('panelis_scores_json')->nullable();
            $table->text('panelis_komentar')->nullable();
            $table->text('panelis_rekomendasi')->nullable();
            $table->date('panelis_tanggal_penilaian')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id_talent')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('panelis_id')->references('id')->on('users')->onDelete('cascade');

            $table->index('user_id_talent');
            $table->index('panelis_id');
            $table->unique(['development_session_id', 'panelis_id'], 'panelis_assessments_session_panelis_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panelis_assessments');
    }
};
