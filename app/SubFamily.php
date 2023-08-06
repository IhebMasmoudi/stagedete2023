<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubFamily extends Model
{  
    protected $primaryKey = 'SubFamilyCode';
    protected $fillable = [
        'SubFamily',
        'LocalFamily'
        #'FamilyCode'
    ];

   /* public function localityFamily()
    {
        return $this->belongsTo(locality_family::class, 'FamilyCode', 'FamilyCode');
    }*/
}