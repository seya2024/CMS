<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_visits', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->dateTime('check_in_time')->nullable();
            $table->dateTime('check_out_time')->nullable();

            // FIXED TYPO
            $table->string('visit_type');

            // doctor
            $table->foreignId('doctor_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // department
            $table->foreignId('department_id')
                ->nullable()
                ->constrained('departments')
                ->nullOnDelete();

            // checker (nurse/triage)
            $table->foreignId('checker_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_visits');
    }
};