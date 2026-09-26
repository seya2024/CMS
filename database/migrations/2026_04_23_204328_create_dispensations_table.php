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
        Schema::create('dispensations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('prescription_id')->constrained()->cascadeOnDelete();
    $table->foreignId('drug_id')->constrained();
    $table->foreignId('dispensed_by')->constrained('staff');
    $table->integer('quantity');
    $table->decimal('unit_price', 10, 2)->nullable();
    $table->timestamp('dispensed_at')->nullable();
    $table->text('notes')->nullable();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispensations');
    }
};
