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
   
            Schema::table('patients', function (Blueprint $table) {
            $table->string('email')->nullable()->after('phone');
            $table->string('emergency_contact_name')->nullable()->after('email');
            $table->string('emergency_contact_phone')->nullable()->after('emergency_contact_name');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn([
                'email',
                'emergency_contact_name',
                'emergency_contact_phone',
            ]);
        });
    }
};

