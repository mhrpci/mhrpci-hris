<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Philhealth extends Model
{
    use HasFactory;
    use Loggable;

    protected $fillable = [
        'employee_id',
        'employee_philhealth_id',
        'date',
        'philhealth_contribution',
    ];
    
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
