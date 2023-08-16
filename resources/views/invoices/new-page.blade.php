@extends('layouts.master')
@section('css')

@endsection
@section('title')
Invoice Details
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Invoice </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
            Invoice Details</span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->


<div class="row row-sm">
    <div class="col-md-12 col-xl-12">
        <div class="main-content-body-invoice" id="print">
            <div class="card card-invoice">
                <div class="card-body">
                    <div class="invoice-header">
                        <h1 class="invoice-title">Invoice Details</h1>
                            
                    </div><!-- invoice-header -->
                    <div class="row mg-t-20">
                       
                        </div>
                        <div class="col-md">
                          <label class="tx-gray-600">Counter Deatils</label>

                          <p class="invoice-info-row"><span>Counter Reference</span>
                            <span>{{ $invoice->counter->CounterReference }}</span>
                        </p>
                        <p class="invoice-info-row"><span>Counter Type</span>
                          <td>{{ $invoice->counter->counterType->CounterType }}</td>
                        </p>
                            <p class="invoice-info-row"><span>Invoice Number</span>
                                <span>{{ $invoice->invoice_number }}</span>
                            </p>
                           
                        </div>
                    </div>
                    <div class="table-responsive mg-t-40">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Invoice Number</th>
                                    <th class="border-bottom-0">Invoice Date</th>
                                    <th class="border-bottom-0">Due Date</th>
                                    <th class="border-bottom-0">Counter Reference</th>
                                    <th class="border-bottom-0">Counter Type</th>
                                    <th class="border-bottom-0">Local Label</th>
                                    <th class="border-bottom-0">Discount</th>
                                    <th class="border-bottom-0">Rate VAT</th>
                                    <th class="border-bottom-0">Total</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0"></th>
                                    <th class="border-bottom-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                               
                                <?php $i++; ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $invoice->invoice_number }}</td>
                                    <td>{{ $invoice->invoice_Date }}</td>
                                    <td>{{ $invoice->due_date }}</td>
                                    <td>{{ $invoice->counter->CounterReference }}</td>
                                    <td>{{ $invoice->counter->counterType->CounterType }}</td>
                                    <td>{{ $invoice->counter->locations->LocalLabel }}</td>
                                    <td>{{ $invoice->discount }}</td>
                                    <td>{{ $invoice->rate_vat }}</td>
                                    <td>{{ $invoice->Total }}</td>
                                    <td>
                                        @if ($invoice->value_Status == 1)
                                        <span class="text-success">{{ $invoice->Status }}</span>
                                        @elseif($invoice->value_Status == 2)
                                        <span class="text-danger">{{ $invoice->Status }}</span>
                                        @else
                                        <span class="text-warning">{{ $invoice->Status }}</span>
                                        @endif
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                               
                            </tbody>
                        </table>


                       
                        <div class="card">
                            <div class="card-body">
                                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">     
                                    <div class="col-md-4">
                                        <div class="card overflow-hidden sales-card bg-primary-gradient">
                                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                               
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <div class="">
                                            @php      
                                                $counterReference = $invoice->counter->CounterReference;
                            
                                                $totalInvoices = \App\Invoices::whereHas('counter', function($query) use ($counterReference) {
                                                    $query->where('CounterReference', $counterReference);
                                                })->sum('Total');
                            
                                                $invoiceCount = \App\Invoices::whereHas('counter', function($query) use ($counterReference) {
                                                    $query->where('CounterReference', $counterReference);
                                                })->count();
                                            @endphp
                                             <div class="text-center">
                                                <h6 class="mb-3 tx-12 text-white">Counter Refrence &nbsp;&nbsp;&nbsp; {{ $counterReference }}</h6> 
                                        <div class="text-center">
                                            <p class="mb-3 tx-12 text-white">Invoices number &nbsp;&nbsp;&nbsp; {{ $invoiceCount }} </p>
                                        </div>
                                                <h6 class="mb-3 tx-12 text-white">Total Invoices amount &nbsp;&nbsp;&nbsp;   {{ $totalInvoices }}</h6>
                                            </div>
                                     
                                        </div>
                                        <span id="compositeline" class="pt-1"></span>

                                    </div>
                                </div>
                            </div>
                        </div>
                        

                         <!-- for counter type-->
                       
              
    
    
                                                
<!-- main-content closed -->
@endsection
@section('js')
<!--Internal Chart.bundle js -->
<script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>



@endsection