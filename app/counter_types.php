<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class counter_types extends Model
{
    protected $primaryKey = 'CounterTypeCode';
    protected $fillable = [
        'CounterType'
    ];
}
