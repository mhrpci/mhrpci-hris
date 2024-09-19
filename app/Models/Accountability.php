<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accountability extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'it_inventories_id', 'documents'];

    protected $casts = [
        'it_inventories_id' => 'array',
        'documents' => 'array',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function itinventory()
    {
        return $this->belongsTo(ItInventory::class);
    }
}
