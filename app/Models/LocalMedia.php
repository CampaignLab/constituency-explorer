<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class LocalMedia extends Model
{
    use HasFactory;

    public $guarded = [];

    protected $casts = [
        'address' => 'array',
    ];

    public function formattedAddress(): string
    {
        if (! $this->address) {
            return '';
        }

        return implode(', ', array_filter($this->address));
    }
}
