<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('mrn')->nullable();
            $table->string('first_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('grandfather_name')->nullable();
            $table->enum('sex', ['Male', 'Female']);
            $table->datetime('dob')->nullable();
            $table->foreignId('region_id')->nullable()->constrained('regions');
            $table->foreignId('zone_id')->nullable()->constrained('zones');
            $table->foreignId('woreda_id')->nullable()->constrained('woredas');
            $table->string('kebele')->nullable();
            $table->string('house_no')->nullable();
            $table->string('national_id')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};