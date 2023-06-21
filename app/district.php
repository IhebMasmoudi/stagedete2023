<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class district extends Model
{
    protected $fillable = [
     'district_name',
     'description',
     'Created_by'

    ];
}
