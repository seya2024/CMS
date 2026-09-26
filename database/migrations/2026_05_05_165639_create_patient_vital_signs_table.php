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
        Schema::create('patient_vital_signs', function (Blueprint $table) {
         $table->id();
        $table->foreignId('patient_visit_id')->constrained('patient_visits')->cascadeOnDelete();
        $table->decimal('temperature', 5, 2)->nullable();
        $table->string('blood_pressure')->nullable();
        $table->integer('pulse_rate')->nullable();
        $table->integer('respiratory_rate')->nullable();
        $table->integer('oxygen_saturation')->nullable();
        $table->integer('weight')->nullable();
        $table->integer('height')->nullable();
        $table->foreignId('recorded_by')->nullable()->constrained('users') ->nullOnDelete();
        $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_vital_signs');
    }
};
