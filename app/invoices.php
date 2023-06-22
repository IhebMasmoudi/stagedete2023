<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoices extends Model
{
 
    protected $fillable = [
        'invoice_number',
        'invoice_Date',
        'due_date',
        'compteur',
        'section',
        'discount',
        'rate_vat',
        'value_vat',
        'Total',
        'Status',
        'value_status',
        'note',
        'user',
        'CounterReference',
    ];

    public function counter()
    {
        return $this->belongsTo(Counter::class, 'CounterReference');
    }
}
