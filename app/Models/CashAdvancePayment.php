<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class CashAdvancePayment extends Model
{
    use HasFactory, Loggable;

    protected $fillable = [
        'cash_advance_id',
        'amount',
        'payment_date',
        'notes',
    ];

    protected $dates = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
    ];

    public function cashAdvance()
    {
        return $this->belongsTo(CashAdvance::class);
    }
}
