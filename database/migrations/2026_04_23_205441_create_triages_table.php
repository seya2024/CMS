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
       
        Schema::create('triages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('queue_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('patient_visit_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('assessed_by')->constrained('staff');
            $table->string('priority_level');
            // emergency, urgent, moderate, low
            $table->string('chief_complaint')->nullable();
            $table->integer('temperature')->nullable();
            $table->integer('pulse')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->integer('respiratory_rate')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('triaged_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triages');
    }
};
