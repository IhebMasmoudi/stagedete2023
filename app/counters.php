<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class counters extends Model
{
    protected $primaryKey = 'CounterReferenceid';
    
    protected $fillable = [
        'CounterReference',
        'LocalCode',
        'CounterTypeCode'
    ];

    public function locations()
    {
        return $this->belongsTo(locations::class, 'LocalCode');
    }

    public function counterType()
    {
        return $this->belongsTo(counter_types::class, 'CounterTypeCode');
    }
}