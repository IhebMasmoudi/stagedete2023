<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoices extends Model
{
    use SoftDeletes;
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
        'pathImage',
        'CounterReferenceid'
    ];
    protected $dates = ['deleted_at'];
    public function counter()
    {
        return $this->belongsTo(counters::class, 'CounterReferenceid', 'CounterReferenceid');
    }

    public static function rules()
    {
        return [
            'note'  => 'nullable|string',
            //'pathImage' => 'nullable',

        ];
    }
}
