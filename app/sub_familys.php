<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubFamily extends Model
{
    protected $fillable = [
        'SubFamily',
        'FamilyCode'
    ];

    public function localityFamily()
    {
        return $this->belongsTo(LocalityFamily::class, 'FamilyCode', 'FamilyCode');
    }
}