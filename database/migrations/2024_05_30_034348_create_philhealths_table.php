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
        Schema::create('philhealths', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->constrained()->cascadeOnDelete();
            $table->string('employee_philhealth_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->float('philhealth_contribution');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('philhealths');
    }
};
