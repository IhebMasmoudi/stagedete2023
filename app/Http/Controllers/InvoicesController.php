<?php

namespace App\Http\Controllers;

use App\invoices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\counters;
use App\counter_types;
use App\locations;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserController;
use App\User;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* public function index()
    {
        $invoices = invoices::all();
        $counters = counters::all();
        $locations = locations::all();
        $counter_types = counter_types::all();
        return view('invoices.invoices', compact('invoices', 'counters', 'locations', 'counter_types'));
    }*/

    /*public function sort($order = 'asc', $column = 'invoice_number')
    {
        $invoices = invoices::join('counters', 'invoices.CounterReferenceid', '=', 'counters.CounterReferenceid')
            ->join('locations', 'counters.LocalCode', '=', 'locations.LocalCode')
            ->orderBy('locations.LocalLabel', $order)
            // ->orderBy($column, $order)
            ->get();

        $counters = counters::all();
        $locations = locations::all();
        $counter_types = counter_types::all();

        return view('invoices.invoices', compact('invoices', 'counters', 'locations', 'counter_types'));
    }*/

    public function index1($order = null, $column = 'invoice_number')
    {
        $orderBy = ($order === 'desc') ? 'desc' : 'asc';

        $invoices = invoices::join('counters', 'invoices.CounterReferenceid', '=', 'counters.CounterReferenceid')
            ->join('locations', 'counters.LocalCode', '=', 'locations.LocalCode')
            ->orderBy($column, $orderBy)
            ->get();

        $counters = counters::all();
        $locations = locations::all();
        $counter_types = counter_types::all();

        return view('invoices.invoices', compact('invoices', 'counters', 'locations', 'counter_types'));
    }


    public function index(Request $request)
    {
        $invoices = invoices::all();
        $counters = counters::all();
        $locations = locations::all();
        $counter_types = counter_types::all();

        return view('invoices.invoices', compact('invoices', 'counters', 'locations', 'counter_types'));
    }

    public function sort($order = 'asc', $column = 'LocalCode')
    {
        $orderBy = ($order === 'desc') ? 'desc' : 'asc';

        $invoices = invoices::join('counters', 'invoices.CounterReferenceid', '=', 'counters.CounterReferenceid')
            ->join('locations', 'counters.LocalCode', '=', 'locations.LocalCode')
            ->orderBy($column, $orderBy)
            ->get();

        $counters = counters::all();
        $locations = locations::all();
        $counter_types = counter_types::all();

        return view('invoices.invoices', compact('invoices', 'counters', 'locations', 'counter_types'));
    }


    public function sortDueDate($order = 'asc', $column = 'due_date')
    {
        $orderBy = ($order === 'desc') ? 'desc' : 'asc';

        $invoices = invoices::orderBy($column, $orderBy)->get();

        $counters = counters::all();
        $locations = locations::all();
        $counter_types = counter_types::all();

        return view('invoices.invoices', compact('invoices', 'counters', 'locations', 'counter_types'));
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


    public function getCounterDetails(Request $request)
    {
        $CounterReferenceid = $request->input('CounterReferenceid');
        $counter = Counters::findOrFail($CounterReferenceid);

        // Assuming 'counterType' and 'locations' are relations defined in your Counters model
        $counterType = $counter->counterType->CounterType;
        $localLabel = $counter->locations->LocalLabel;

        return response()->json([
            'CounterReference' => $counter->CounterReference,
            'counterType' => $counterType,
            'LocalLabel' => $localLabel,
            // Add more counter information fields here as needed
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(invoices::rules());


        $pathImage = Storage::putFile('invoices', $request->file('pathImage'));
        $invoiceDate = Carbon::createFromFormat('d-m-Y', $request->input('invoice_Date'))->format('Y-m-d');
        $dueDate = Carbon::createFromFormat('d-m-Y', $request->input('due_date'))->format('Y-m-d');

        invoices::create([

            'pathImage' => $pathImage,
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

        $user = User::find(Auth::user()->id);
        //$user =  Auth::user();
        $invoices = invoices::latest()->first();
        Notification::send($user, new \App\Notifications\Add_invoice($invoices));

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
            $pathImage = Storage::putFile('invoices', $request->file('pathImage'));
            $invoiceDate = Carbon::createFromFormat('d-m-Y', $request->input('invoice_Date'))->format('Y-m-d');
            $dueDate = Carbon::createFromFormat('d-m-Y', $request->input('due_date'))->format('Y-m-d');

            $invoice->update([
                'pathImage' => $pathImage,
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
        return view('invoices.invoices-paid', compact('invoices'));
    }

    public function Invoice_unPaid()
    {
        $invoices = Invoices::where('Value_Status', 2)->get();
        return view('invoices.invoices-unpaid', compact('invoices'));
    }
    public function Other()
    {
        $invoices = Invoices::where('Value_Status', 3)->get();
        return view('invoices.invoices-other', compact('invoices'));
    }
    public function printInvoice($idinvoice)
    {
        $invoice = Invoices::findOrFail($idinvoice);

        return view('invoices.print_invoice', compact('invoice'));
    }
    public function MarkAsRead_all(Request $request)
    {

        $userUnreadNotification = auth()->user()->unreadNotifications;

        if ($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }
    }


    public function unreadNotifications_count()

    {
        return auth()->user()->unreadNotifications->count();
    }

    public function unreadNotifications()

    {
        foreach (auth()->user()->unreadNotifications as $notification) {

            return $notification->data['title'];
        }
    }

    public function populateCounterData(Request $request)
    {
        $counterReferenceId = $request->input('counterReferenceId');

        $counter = Counters::findOrFail($counterReferenceId);

        $counterType = $counter->counterType;
        $localLabel = $counter->locations;

        return response()->json([
            'counterType' => $counterType,
            'localLabel' => $localLabel
        ]);
    }
    public function getCounterInfoI(Request $request)
    {
        $counterReference = $request->input('counterReferenceId');

        $counter = Counters::findOrFail($counterReference);

        return response()->json($counter);
    }
    public function getCounterInfo(Request $request)
    {
        $CounterReferenceid = $request->input('CounterReferenceid');
        $counter = Counters::findOrFail($CounterReferenceid);

        // Assuming 'counterType' and 'locations' are relations defined in your Counters model
        $counterType = $counter->counterType->CounterType;
        $localLabel = $counter->locations->LocalLabel;

        return response()->json([
            'CounterReference' => $counter->CounterReference,
            'counterType' => $counterType,
            'LocalLabel' => $localLabel,
            // Add more counter information fields here as needed
        ]);
    }

    public function sortUnpaid($order = 'asc', $column = 'LocalCode')
    {
        $orderBy = ($order === 'desc') ? 'desc' : 'asc';

        $invoices = invoices::join('counters', 'invoices.CounterReferenceid', '=', 'counters.CounterReferenceid')
            ->join('locations', 'counters.LocalCode', '=', 'locations.LocalCode')
            ->orderBy($column, $orderBy)
            ->get();

        $counters = counters::all();
        $locations = locations::all();
        $counter_types = counter_types::all();

        return view('invoices.invoices-unpaid', compact('invoices', 'counters', 'locations', 'counter_types'));
    }


    public function sortUnpaidDueDate($order = 'asc', $column = 'due_date')
    {
        $orderBy = ($order === 'desc') ? 'desc' : 'asc';

        $invoices = invoices::orderBy($column, $orderBy)->get();

        $counters = counters::all();
        $locations = locations::all();
        $counter_types = counter_types::all();

        return view('invoices.invoices-unpaid', compact('invoices', 'counters', 'locations', 'counter_types'));
    }

    public function sortPaid($order = 'asc', $column = 'LocalCode')
    {
        $orderBy = ($order === 'desc') ? 'desc' : 'asc';

        $invoices = invoices::join('counters', 'invoices.CounterReferenceid', '=', 'counters.CounterReferenceid')
            ->join('locations', 'counters.LocalCode', '=', 'locations.LocalCode')
            ->orderBy($column, $orderBy)
            ->get();

        $counters = counters::all();
        $locations = locations::all();
        $counter_types = counter_types::all();

        return view('invoices.invoices-paid', compact('invoices', 'counters', 'locations', 'counter_types'));
    }
    /* public function getCounterInfo(Request $request)
    {
        $counterReferenceid = $request->input('counterReferenceid');

        $counter = Counters::with('CounterTypeCode')->where('CounterReferenceid', $counterReferenceid)->first();

        return response()->json($counter);
    }*/
}
