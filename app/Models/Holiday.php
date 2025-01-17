<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Holiday extends Model
{
    use HasFactory;
    use Loggable;

    const TYPE_REGULAR = 'Regular Holiday';
    const TYPE_SPECIAL = 'Special Non-Working Holiday';

    protected $fillable = [
        'title',
        'date',
        'type',
    ];

    public static function types(): array
    {
        return [
            self::TYPE_REGULAR,
            self::TYPE_SPECIAL,
        ];
    }
}

