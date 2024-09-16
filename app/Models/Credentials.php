<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credentials extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'company_email',
        'company_number',
        'email_password',
    ];



    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
