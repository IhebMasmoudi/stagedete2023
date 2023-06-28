<?php

namespace App\Http\Controllers;
use App\invoices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\counters;
use App\counter_types;
use App\locations;
use Carbon\Carbon;
class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoices::all();
        $counters = counters::all();
        $locations = locations::all();
        $counter_types = counter_types::all();
        return view('invoices.invoices',compact('invoices','counters', 'locations', 'counter_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  
     public function create()
     {
         
         $invoices = Invoices::all();
         $counters = counters::all();
         $locations = Locations::all();
         $counter_types = counter_types::all();
     
       
     
         return view('invoices.add_invoice', compact('invoices', 'counters', 'locations', 'counter_types'));
     }
     

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

        $invoiceDate = Carbon::createFromFormat('d-m-Y', $request->input('invoice_Date'))->format('Y-m-d');
    $dueDate = Carbon::createFromFormat('d-m-Y', $request->input('due_date'))->format('Y-m-d');

    invoices::create([
        'invoice_number' => $request->input('invoice_number'),
        'invoice_Date' => $invoiceDate,
        'due_date' => $dueDate,
        'discount' => $request->input('Discount'),
        'rate_vat' => $request->input('Rate_VAT'),
        'value_vat' => $request->input('Value_VAT'),
        'Total' => $request->input('Total'),
        'Status' => 'Unpaid',
        'value_Status' => '2',
        'note' => $request->input('note'),
        'Created_by' => Auth::user()->name,
        'CounterReferenceid' => $request->input('Reference')
    ]);

    session()->flash('Add', 'Invoice created successfully.');

    return redirect('/invoices');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($idinvoice)
    {
        $invoice = invoices::find($idinvoice);
        $counters = counters::all();
        $locations = locations::all();
        $counter_types = counter_types::all();
    
        return view('invoices.edit_invoice', compact('invoice', 'counters', 'locations', 'counter_types'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
public function update(Request $request, $idinvoice)
{
    try {
        $invoice = invoices::findOrFail($idinvoice);

        $invoiceDate = Carbon::createFromFormat('d-m-Y', $request->input('invoice_Date'))->format('Y-m-d');
        $dueDate = Carbon::createFromFormat('d-m-Y', $request->input('due_date'))->format('Y-m-d');

        $invoice->update([
            'invoice_number' => $request->input('invoice_number'),
            'invoice_Date' => $invoiceDate,
            'due_date' => $dueDate,
            'discount' => $request->input('Discount'),
            'rate_vat' => $request->input('Rate_VAT'),
            'value_vat' => $request->input('Value_VAT'),
            'Total' => $request->input('Total'),
            'Status' => $request->input('status') == 1 ? 'Paid' : ($request->input('status') == 2 ? 'Unpaid' : ($request->input('status') == 3 ? 'Other' : 'Other')),

            'value_Status' => $request->input('status'),
            'note' => $request->input('note'),
            'Created_by' => Auth::user()->name,
            'CounterReferenceid' => $request->input('Reference')
        ]);

        session()->flash('edit', 'Edit successful');
        return redirect('/invoices');
    } catch (\Exception $e) {
        session()->flash('error', 'Error occurred: ');
        return redirect('/invoices');
    }
}
    

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices $invoices)
    {
        //
    }
    public function Invoice_Paid()
    {
        $invoices = Invoices::where('Value_Status', 1)->get();
        return view('invoices.invoices-paid',compact('invoices'));
    }

    public function Invoice_unPaid()
    {
        $invoices = Invoices::where('Value_Status',2)->get();
        return view('invoices.invoices-unpaid',compact('invoices'));
    }
    public function Invoice_other()
    {
        $invoices = Invoices::where('Value_Status',3)->get();
        return view('invoices.invoices-other',compact('invoices'));
    }
}
