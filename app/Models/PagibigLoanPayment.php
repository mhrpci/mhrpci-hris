<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagibigLoanPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'pagibig_loan_id',
        'amount',
        'payment_date',
        'notes',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
    ];

    public function pagibigLoan()
    {
        return $this->belongsTo(PagibigLoan::class);
    }
}