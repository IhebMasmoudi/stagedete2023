<?php

namespace App\Http\Controllers;

use App\invoices;

use Illuminate\Http\Request;

class InvoiceDetailsController extends Controller
{
    //

    public function show($idinvoice)
    {
        $invoice = Invoices::findOrFail($idinvoice);

        $totalInvoices = Invoices::where('CounterReference', $invoice->counter->CounterReference)->sum('Total');
        $invoiceCount = Invoices::where('CounterReference', $invoice->counter->CounterReference)->count();

        return view('invoices.new-page', compact('invoice', 'totalInvoices', 'invoiceCount'));
    }
}
