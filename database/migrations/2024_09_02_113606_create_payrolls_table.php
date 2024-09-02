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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('total_overtime', 10, 2)->nullable();
            $table->decimal('total_deductions', 10, 2)->nullable();
            $table->decimal('total_contributions', 10, 2)->nullable();
            $table->decimal('total_loans', 10, 2)->nullable();
            $table->decimal('net_pay', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
