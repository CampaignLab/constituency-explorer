<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charity extends Model
{
    use HasFactory;

    protected $fillable = [
        'charity_id',
        'company_id',
        'name',
        'website',
        'trustees',
        'employees',
        'volunteers',
        'registered',
        'financial_year',
        'income',
        'spending',
        'funders',
        'email',
        'phone',
        'address',
        'postcode',
        'facebook',
        'instagram',
        'twitter',
        'ccg',
        'eer',
        'laua',
        'lsoa',
        'msoa',
        'pcon',
        'ru',
        'ttwa',
        'ward',
        'latitude',
        'longitude',
        'constituency_id',
    ];

    protected $casts = [
        'address' => 'array',
        'registered' => 'date',
        'financial_year' => 'date',
    ];

    public function constituency()
    {
        return $this->belongsTo(Constituency::class);
    }

    public function formattedAddress(): string
    {
        return implode(', ', array_filter(array_merge($this->address, [$this->postcode])));
    }
}
