<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
    use HasFactory, Notifiable;
    use Loggable;

    protected $fillable = [
        'company_id',
        'profile',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'email_address',
        'contact_no',
        'birth_date',
        'birth_place_province',
        'birth_place_city',
        'birth_place_barangay',
        'province_id',
        'city_id',
        'barangay_id',
        'gender_id',
        'position_id',
        'department_id',
        'zip_code',
        'date_hired',
        'salary',
        'sss_no',
        'pagibig_no',
        'tin_no',
        'philhealth_no',
        'elementary',
        'secondary',
        'tertiary',
        'emergency_name',
        'emergency_no',
        'employment_status',
    ];
    public function saveEmploymentStatus()
    {
        $this->employment_status = $this->employmentStatus();
        $this->save();
    }
/**
     * Route notifications for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        return $this->email_address;
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    public function barangay(): BelongsTo
    {
        return $this->belongsTo(Barangay::class);
    }
    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
    public function sss(): HasMany
    {
        return $this->hasMany(Sss::class);
    }
    public function sssLoan(): HasMany
    {
        return $this->hasMany(SssLoan::class);
    }
    public function tin(): HasMany
    {
        return $this->hasMany(Tin::class);
    }

    public function philhealth(): HasMany
    {
        return $this->hasMany(Philhealth::class);
    }
    public function leave(): HasMany
    {
        return $this->hasMany(Leave::class);
    }
    public function type(): HasMany
    {
        return $this->hasMany(Type::class);
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function employmentStatus(): string
{
    $hiredDate = \Carbon\Carbon::parse($this->date_hired);
    $now = \Carbon\Carbon::now();
    $diffInDays = $hiredDate->diffInDays($now);
    $diffInMonths = $hiredDate->diffInMonths($now);

    // Check if the employee belongs to the MHRHCI department
    if ($this->department && $this->department->name === 'MHRHCI') {
        if ($diffInDays <= 18) {
            return 'TRAINEE';
        } elseif ($diffInDays >= 19 && $diffInMonths < 4) {
            return 'PROBITIONARY';
        } else {
            return 'REGULAR EMPLOYEE';
        }
    }

    // Default employment status for other departments
    if ($diffInMonths >= 0 && $diffInMonths < 5) {
        return 'PROBITIONARY';
    } else {
        return 'REGULAR';
    }
}


}
