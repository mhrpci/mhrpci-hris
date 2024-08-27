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
            $table->foreignId('employee_id')->constrained();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('gross_salary', 10, 2);
            $table->decimal('net_salary', 10, 2);
            $table->decimal('sss_contribution', 10, 2);
            $table->decimal('pagibig_contribution', 10, 2);
            $table->decimal('philhealth_contribution', 10, 2);
            $table->decimal('sss_loan_deduction', 10, 2);
            $table->decimal('pagibig_loan_deduction', 10, 2);
            $table->decimal('cash_advance_deduction', 10, 2);
            $table->decimal('overtime_pay', 10, 2);
            $table->decimal('attendance_deduction', 10, 2);
            $table->decimal('total_deductions', 10, 2);
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
