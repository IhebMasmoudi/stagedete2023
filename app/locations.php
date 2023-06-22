<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'LocalLabel',
        'LocalAddress',
        'DistrictCode',
        'SubFamilyCode'
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'DistrictCode');
    }

    public function subFamily()
    {
        return $this->belongsTo(SubFamily::class, 'SubFamilyCode');
    }
}