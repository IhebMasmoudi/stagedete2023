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
        'compteur',
        'section',
        'discount',
        'rate_vat',
        'Total',
        'Status',
        'value_status',
        'note',
        'Created_by',
        'CounterReference',
    ];

    public function counter()
    {
        return $this->belongsTo(Counters::class, 'CounterReference', 'CounterReferenceid');
    }
}
