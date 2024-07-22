<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalAuthority extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'local_authorities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gss_code',
        'name',
    ];

    public function constituencies()
    {
        return $this->belongsToMany(Constituency::class)
                    ->withPivot('overlap_area', 'original_area', 'percentage_overlap_area', 'percentage_overlap_pop', 'overlap_pop', 'original_pop', '__index_level_0__')
                    ->withTimestamps();
    }
}
