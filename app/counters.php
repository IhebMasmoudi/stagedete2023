<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class counters extends Model
{
    protected $fillable = [
        'LocalCode',
        'CounterTypeCode'
    ];

    public function locations()
    {
        return $this->belongsTo(locations::class, 'LocalCode');
    }

    public function counterType()
    {
        return $this->belongsTo(CounterType::class, 'CounterTypeCode');
    }
}