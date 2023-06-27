<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoices extends Model
{
    protected $primaryKey = 'idinvoice';

    protected $fillable = [
        'invoice_number',
        'invoice_Date',
        'due_date',
        'discount',
        'rate_vat',
        'value_vat',
        'Total',
        'Status',
        'value_Status',
        'note',
        'Created_by',
        'CounterReferenceid'
    ];

    public function counter()
    {
        return $this->belongsTo(counters::class, 'CounterReferenceid', 'CounterReferenceid');
    }

}
