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
       Schema::create('staff', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
        $table->foreignId('department_id')->nullable()->constrained();
        $table->string('staff_code')->unique();
        $table->string('full_name');
        $table->string('role'); // doctor, nurse, lab_tech, pharmacist
        $table->string('phone')->nullable();
        $table->string('email')->nullable();
        $table->boolean('active')->default(true);
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
