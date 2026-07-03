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
        Schema::create('status_log', function (Blueprint $table) {
            $table->id(); // PK id [cite: 122]
            $table->string('name_tabel'); // Key name_tabel [cite: 123]
            $table->enum('status', ['Pending', 'Approved', 'Rejected',]); // Key status [cite: 126]
            $table->string('remark')->nullable(); // Key remark [cite: 134]
            $table->timestamps(); // created_at [cite: 136]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_log');
    }
};
