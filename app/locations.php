<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class locations extends Model
{
    protected $primaryKey = 'LocalCode';
    protected $fillable = [
        'LocalLabel',
        'LocalAddress',
        'DistrictCode',
        'SubFamilyCode'
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'DistrictCode', 'id');
    }

    public function subFamily()
    {
        return $this->belongsTo(SubFamily::class, 'SubFamilyCode', 'SubFamilyCode');
    }
}