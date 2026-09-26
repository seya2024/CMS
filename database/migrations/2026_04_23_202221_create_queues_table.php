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
        Schema::create('queues', function (Blueprint $table) {
    $table->id();
    // --- RELATIONS ---
    $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
    $table->foreignId('department_id')->constrained()->cascadeOnDelete();
    // --- QUEUE IDENTIFICATION ---
    // The date allows tokens like 'A-001' to reset for every department, every day
    $table->date('queue_date')->index(); 
    $table->string('token_number'); // e.g., A-001, OPD-15
    // --- PRIORITY ---
    // Using string makes code more readable than integers
    $table->enum('priority', ['normal', 'urgent', 'emergency'])->default('normal')->index();
    // --- STATUS ---
    $table->enum('status', [
        'waiting',     // Patient is in the waiting room
        'called',      // Staff called the patient's name
        'in_service',  // Patient is currently with the doctor
        'served',      // Consultation finished
        'skipped',     // Patient didn't answer when called (3 times)
        'cancelled',   // Patient left or cancelled
    ])->default('waiting')->index();
    // --- ASSIGNMENT ---
    $table->foreignId('assigned_to')->nullable()->constrained('users'); 
    // --- TIME TRACKING ---
    $table->timestamp('arrived_at')->nullable();       // When patient took the ticket
    $table->timestamp('called_at')->nullable();         // When staff called their name
    $table->timestamp('service_start_at')->nullable();  // When doctor actually started (fixes gap between called & in_service)
    $table->timestamp('served_at')->nullable();        // When consultation finished
    // --- CANCELLATION/SKIP TRACKING ---
    $table->timestamp('cancelled_at')->nullable();
    $table->string('cancelled_reason')->nullable();
    $table->text('notes')->nullable();
    $table->timestamps();
    // --- INDEXES FOR DASHBOARD PERFORMANCE ---
    // Crucial: Your TV Dashboard will constantly query "waiting patients for today"
    $table->index(['queue_date', 'department_id', 'status'], 'queue_dashboard_idx');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queues');
    }
};
