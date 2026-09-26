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
        Schema::create('lab_samples', function (Blueprint $table) {
     $table->id();
    $table->foreignId('lab_order_id')->constrained()->cascadeOnDelete();
    $table->foreignId('collected_by')->constrained('staff');
    $table->string('sample_type'); // blood, urine, stool
    $table->string('status')->default('collected');
    // collected, sent, received, rejected
    $table->timestamp('collected_at')->nullable();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_samples');
    }
};
