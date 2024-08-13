<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'address' => 'array',
    ];

    public function formattedAddress()
    {
        return implode(', ', array_filter($this->address));
    }
}
