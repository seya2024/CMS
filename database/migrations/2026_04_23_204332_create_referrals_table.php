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
        Schema::create('referrals', function (Blueprint $table) {
        $table->id();
        $table->foreignId('patient_visit_id')->constrained();
        $table->foreignId('referred_by')->constrained('staff');
        $table->string('referred_to'); // hospital name or facility code
        $table->text('reason');
        $table->string('status')->default('pending');
        // pending, accepted, rejected, completed
        $table->timestamp('referred_at')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
