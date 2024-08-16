<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use Loggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'email',
        'bio',
        'profile_image',
        'password',
        'company_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function adminlte_image()
{
    if ($this->profile_image) {
        return asset('storage/' . $this->profile_image);
    } else {
        // Default image URL if profile image is not uploaded
        return 'https://picsum.photos/300/300';
    }
}



    public function adminlte_desc()
    {
        return $this->bio;
    }

    public function adminlte_profile_url()
{
    return route('profile.show', $this->id);
}

public function post(): HasMany
{
    return $this->hasMany(Post::class);
}

// User.php (User Model)
public function employee()
{
    return $this->hasOne(Employee::class);
}


public function getIsEmployeeAttribute()
{
    // Example: assuming you have a column 'employee_type' in users table
    return $this->employee_type === 'employee'; // Adjust this based on your actual implementation
}
}