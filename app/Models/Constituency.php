<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

use function App\simplify_geojson_coordinates;

class Constituency extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'constituencies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_code',
        'short_code',
        'name',
        'name_cy',
        'gss_code',
        'three_code',
        'nation',
        'region',
        'con_type',
        'electorate',
        'area',
        'density',
        'center_lat',
        'center_lon',
        'geojson',
    ];

    protected $casts = [
        'geojson' => 'array',
    ];

    public function localAuthorities()
    {
        return $this->belongsToMany(LocalAuthority::class)
            ->withPivot('overlap_area', 'original_area', 'percentage_overlap_area', 'percentage_overlap_pop', 'overlap_pop', 'original_pop', '__index_level_0__')
            ->withTimestamps()
            ->withCasts([
                'percentage_overlap_area' => 'float',
            ]);
    }

    public function charities()
    {
        return $this->hasMany(Charity::class);
    }

    public function towns(): BelongsToMany
    {
        return $this->belongsToMany(Town::class);
    }

    public function oldConstituencies(): BelongsToMany
    {
        return $this->belongsToMany(OldConstituency::class)
            ->withPivot('overlap_area', 'original_area', 'percentage_overlap_area', 'percentage_overlap_pop', 'overlap_pop', 'original_pop', '__index_level_0__')
            ->withCasts([
                'percentage_overlap_area' => 'float',
            ]);
    }

    public function dentists(): HasMany
    {
        return $this->hasMany(Dentist::class);
    }

    public function hospitals(): HasMany
    {
        return $this->hasMany(Hospital::class);
    }

    public function schools(): HasMany
    {
        return $this->hasMany(School::class);
    }

    public function communityCentres(): HasMany
    {
        return $this->hasMany(CommunityCentre::class);
    }

    public function placesOfWorship(): HasMany
    {
        return $this->hasMany(PlaceOfWorship::class);
    }

    public function localMedia(): HasMany
    {
        return $this->hasMany(LocalMedia::class);
    }

    public function greenSpaces(): HasMany
    {
        return $this->hasMany(GreenSpace::class);
    }

    public function getMapBoxImageUrl(): string
    {
        // 'https://api.mapbox.com/styles/v1/mapbox/streets-v12/static/geojson(%7B%22type%22%3A%22FeatureCollection%22%2C%22features%22%3A%5B%7B%22type%22%3A%22Feature%22%2C%22id%22%3A15%2C%22geometry%22%3A%7B%22type%22%3A%22Polygon%22%2C%22coordinates%22%3A%5B%5B%5B0.4962%2C51.6238%5D%2C%5B0.483%2C51.6257%5D%2C%5B0.4798%2C51.6256%5D%2C%5B0.4797%2C51.6254%5D%2C%5B0.4675%2C51.6236%5D%2C%5B0.4625%2C51.6238%5D%2C%5B0.4547%2C51.6253%5D%2C%5B0.451%2C51.6264%5D%2C%5B0.4485%2C51.6268%5D%2C%5B0.4478%2C51.6287%5D%2C%5B0.4479%2C51.6297%5D%2C%5B0.4472%2C51.6306%5D%2C%5B0.4479%2C51.6308%5D%2C%5B0.4458%2C51.6333%5D%2C%5B0.4445%2C51.6372%5D%2C%5B0.4451%2C51.6391%5D%2C%5B0.4476%2C51.6414%5D%2C%5B0.4486%2C51.6418%5D%2C%5B0.4475%2C51.6437%5D%2C%5B0.4436%2C51.6444%5D%2C%5B0.4446%2C51.6468%5D%2C%5B0.4415%2C51.6473%5D%2C%5B0.4355%2C51.6497%5D%2C%5B0.4306%2C51.6499%5D%2C%5B0.425%2C51.6496%5D%2C%5B0.4145%2C51.6503%5D%2C%5B0.4139%2C51.65%5D%2C%5B0.4119%2C51.6514%5D%2C%5B0.4038%2C51.6512%5D%2C%5B0.4035%2C51.6499%5D%2C%5B0.4039%2C51.6497%5D%2C%5B0.4042%2C51.6501%5D%2C%5B0.4045%2C51.6499%5D%2C%5B0.4042%2C51.6486%5D%2C%5B0.4039%2C51.6487%5D%2C%5B0.4036%2C51.6481%5D%2C%5B0.4041%2C51.6477%5D%2C%5B0.4053%2C51.6476%5D%2C%5B0.4045%2C51.647%5D%2C%5B0.4046%2C51.646%5D%2C%5B0.4031%2C51.6462%5D%2C%5B0.403%2C51.6457%5D%2C%5B0.4025%2C51.6458%5D%2C%5B0.4019%2C51.6453%5D%2C%5B0.401%2C51.6454%5D%2C%5B0.4005%2C51.645%5D%2C%5B0.3981%2C51.6451%5D%2C%5B0.3973%2C51.6445%5D%2C%5B0.3965%2C51.6447%5D%2C%5B0.3961%2C51.6441%5D%2C%5B0.3965%2C51.6434%5D%2C%5B0.3961%2C51.6419%5D%2C%5B0.3944%2C51.6398%5D%2C%5B0.3937%2C51.6398%5D%2C%5B0.3936%2C51.6394%5D%2C%5B0.3927%2C51.6396%5D%2C%5B0.3921%2C51.6392%5D%2C%5B0.3917%2C51.6394%5D%2C%5B0.391%2C51.6391%5D%2C%5B0.3894%2C51.6378%5D%2C%5B0.3891%2C51.6379%5D%2C%5B0.3884%2C51.6371%5D%2C%5B0.3887%2C51.6363%5D%2C%5B0.3869%2C51.633%5D%2C%5B0.3879%2C51.6316%5D%2C%5B0.3875%2C51.6312%5D%2C%5B0.3888%2C51.6299%5D%2C%5B0.3893%2C51.6285%5D%2C%5B0.3885%2C51.6271%5D%2C%5B0.3886%2C51.6263%5D%2C%5B0.3867%2C51.6234%5D%2C%5B0.3859%2C51.6197%5D%2C%5B0.3803%2C51.6168%5D%2C%5B0.3783%2C51.6159%5D%2C%5B0.3779%2C51.616%5D%2C%5B0.3768%2C51.6153%5D%2C%5B0.3774%2C51.6151%5D%2C%5B0.3793%2C51.6123%5D%2C%5B0.381%2C51.6038%5D%2C%5B0.3842%2C51.5997%5D%2C%5B0.3852%2C51.5989%5D%2C%5B0.3844%2C51.5983%5D%2C%5B0.3835%2C51.5957%5D%2C%5B0.3843%2C51.5944%5D%2C%5B0.3856%2C51.5939%5D%2C%5B0.3851%2C51.5936%5D%2C%5B0.3865%2C51.5914%5D%2C%5B0.3877%2C51.5861%5D%2C%5B0.3829%2C51.5852%5D%2C%5B0.3849%2C51.5769%5D%2C%5B0.3845%2C51.5743%5D%2C%5B0.3853%2C51.5723%5D%2C%5B0.3844%2C51.5721%5D%2C%5B0.3853%2C51.5699%5D%2C%5B0.3834%2C51.5685%5D%2C%5B0.3842%2C51.566%5D%2C%5B0.3875%2C51.5659%5D%2C%5B0.3913%2C51.5666%5D%2C%5B0.3934%2C51.5674%5D%2C%5B0.3934%2C51.5677%5D%2C%5B0.3998%2C51.5693%5D%2C%5B0.4048%2C51.5701%5D%2C%5B0.4086%2C51.5703%5D%2C%5B0.4147%2C51.57%5D%2C%5B0.4264%2C51.5677%5D%2C%5B0.433%2C51.5671%5D%2C%5B0.4732%2C51.569%5D%2C%5B0.4767%2C51.5689%5D%2C%5B0.4795%2C51.5686%5D%2C%5B0.4788%2C51.5669%5D%2C%5B0.479%2C51.5656%5D%2C%5B0.4728%2C51.5645%5D%2C%5B0.4736%2C51.5634%5D%2C%5B0.4732%2C51.5633%5D%2C%5B0.473%2C51.5628%5D%2C%5B0.4734%2C51.5621%5D%2C%5B0.478%2C51.5629%5D%2C%5B0.4799%2C51.561%5D%2C%5B0.4813%2C51.5589%5D%2C%5B0.4827%2C51.5595%5D%2C%5B0.4833%2C51.5586%5D%2C%5B0.484%2C51.5585%5D%2C%5B0.4875%2C51.5594%5D%2C%5B0.4898%2C51.5608%5D%2C%5B0.502%2C51.5641%5D%2C%5B0.4994%2C51.5646%5D%2C%5B0.4976%2C51.5659%5D%2C%5B0.4969%2C51.571%5D%2C%5B0.4961%2C51.5721%5D%2C%5B0.4944%2C51.5734%5D%2C%5B0.496%2C51.5754%5D%2C%5B0.4972%2C51.58%5D%2C%5B0.5001%2C51.5842%5D%2C%5B0.501%2C51.5929%5D%2C%5B0.4901%2C51.5925%5D%2C%5B0.4895%2C51.597%5D%2C%5B0.496%2C51.597%5D%2C%5B0.4967%2C51.5971%5D%2C%5B0.4969%2C51.5974%5D%2C%5B0.4993%2C51.5973%5D%2C%5B0.4992%2C51.5978%5D%2C%5B0.5019%2C51.5976%5D%2C%5B0.5015%2C51.5999%5D%2C%5B0.5059%2C51.6001%5D%2C%5B0.5059%2C51.6008%5D%2C%5B0.5068%2C51.6008%5D%2C%5B0.5069%2C51.6015%5D%2C%5B0.5065%2C51.603%5D%2C%5B0.5009%2C51.6025%5D%2C%5B0.5009%2C51.6048%5D%2C%5B0.5001%2C51.6074%5D%2C%5B0.5027%2C51.6079%5D%2C%5B0.5019%2C51.6101%5D%2C%5B0.502%2C51.6107%5D%2C%5B0.5026%2C51.6108%5D%2C%5B0.5023%2C51.6114%5D%2C%5B0.5033%2C51.6116%5D%2C%5B0.5024%2C51.6136%5D%2C%5B0.5028%2C51.6143%5D%2C%5B0.5022%2C51.6154%5D%2C%5B0.5018%2C51.6181%5D%2C%5B0.5021%2C51.6182%5D%2C%5B0.5%2C51.6201%5D%2C%5B0.4988%2C51.622%5D%2C%5B0.4962%2C51.6238%5D%5D%5D%7D%2C%22properties%22%3A%7B%22FID%22%3A15%2C%22PCON24CD%22%3A%22E14001077%22%2C%22PCON24NM%22%3A%22Basildon%20and%20Billericay%22%2C%22PCON24NMW%22%3A%22%20%22%2C%22BNG_E%22%3A569070%2C%22BNG_N%22%3A192467%2C%22LAT%22%3A51.60566%2C%22LONG%22%3A0.440099%2C%22GlobalID%22%3A%224de9b4ba-c95d-433b-bb46-115361006dfb%22%7D%7D%5D%7D)/0.4369,51.6026,10,0/500x500@2x?access_token=pk.eyJ1IjoiYWtzaGV5a2FscmEiLCJhIjoiY2x5emp4NnNrMWxicTJqc2JwbnF1ZDMweSJ9.znrOAzfIMENJMD34caTx4g'

        return sprintf(
            'https://api.mapbox.com/styles/v1/mapbox/streets-v12/static/geojson(%s)/%f,%f,10,0/800x300@2x?access_token=%s',
            urlencode(json_encode(simplify_geojson_coordinates($this->geojson))),
            round($this->center_lon, 4),
            round($this->center_lat, 4),
            config('services.mapbox.token'),
        );
    }
}
