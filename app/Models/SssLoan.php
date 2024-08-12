<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class SssLoan extends Model
{
    use HasFactory;
    use Loggable;

    protected $fillable = [
        'employee_id',
        'date_repayment',
        'sss_loan',
    ];
    
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
