@extends('layouts.master')
@section('css')

@endsection
@section('title')
Invoice Details Dashboard
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
                        <h1 class="invoice-title">Invoices Details Dashboard</h1>
                    </div>

                    <div class="table-responsive mg-t-40">
           


                 
       
<div class="container">
<ul class="nav nav-pills " role="tablist">
    <li class="nav-item">
        <a class="nav-link" id="nav-tab-2" data-toggle="tab" href="#tabs-2" role="tab" >Invoices Dashboard</a>
    </li>
   
	<li class="nav-item">
		<a class="nav-link " data-toggle="tab" href="#tabs-1" role="tab">Counter Details</a>
	</li>
    
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Invoices List</a>
	</li> 

    <li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#tabs-" role="tab">Local Details</a>
	</li>
</ul>


<div class="tab-content">
	
    <div class="tab-pane active" id="tabs-2" role="tabpanel">
        <br>
        <h4>Invoices Dashboard</h4>
        <br>
        <div id="invoices-list-container">
                          <!-- for counter type-->
                          @php      
                          $counterReference = $invoice->counter->CounterReference;
 
                          $totalInvoices = \App\Invoices::whereHas('counter', function($query) use ($counterReference) {
                              $query->where('CounterReference', $counterReference);
                          })->sum('Total');
      
                    
                          $invoiceCount= $invoice->counter->invoices->count();
                      @endphp
               
                          <div class="row row-sm">
                             <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                                 <div class="card overflow-hidden sales-card bg-warning-gradient
                                 ">
                                     <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                         <div class="">
                                             <h6 class="mb-3 tx-12 text-white"> Counter Refrence </h6>
                                         </div>
                                         <div class="pb-0 mt-0">
                                             <div class="d-flex">
                                                 <div class="">
                                                     <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                                             &nbsp;&nbsp;&nbsp; {{ $counterReference }} 
                                                     
                                                     </h4>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <span id="compositeline" class="pt-1"></span>
                                 </div>
                             </div>
 
                             <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                                 <div class="card overflow-hidden sales-card bg-danger-gradient">
                                     <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                         <div class="">
                                             <h6 class="mb-3 tx-12 text-white">Invoices Number</h6>
                                         </div>
                                         <div class="pb-0 mt-0">
                                             <div class="d-flex">
                                                 <div class="">
                                                     <h3 class="tx-20 font-weight-bold mb-1 text-white">
                                                        
     
                                                             &nbsp;&nbsp;&nbsp; {{ $invoiceCount }}                     
                                                     </h3>
                                                     
                                                 </div>
                                        
                                             </div>
                                         </div>
                                     </div>
                                     <span id="compositeline2" class="pt-1"></span>
                                 </div>
                             </div>
 
 
                             <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                                 <div class="card overflow-hidden sales-card bg-success-gradient">
                                     <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                         <div class="">
                                             <h6 class="mb-3 tx-12 text-white"> Total Invoice amount</h6>
                                         </div>
                                         <div class="pb-0 mt-0">
                                             <div class="d-flex">
                                                 <div class="">
                                                     <h4 class="tx-20 font-weight-bold mb-1 text-white">
                     
                                                           &nbsp;&nbsp;&nbsp;   {{ $totalInvoices }}
                     
                                                     </h4>
                                           
                                                 </div>
                                         
                                             </div>
                                         </div>
                                     </div>
                                     <span id="compositeline3" class="pt-1"></span>
                                 </div>
                             </div>
 
                             <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                                 <div class="card overflow-hidden sales-card bg-primary-gradient">
                                     <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                         <div class="">
                                             <h6 class="mb-3 tx-12 text-white"> Status </h6>
                                         </div>
                                         <div class="pb-0 mt-0">
                                             <div class="d-flex">
                                                 <div class="">
                                                     <h4 class="tx-20 font-weight-bold mb-1 text-white">
                     
                                                         <td>
                                                             @if ($invoice->value_Status == 1)
                                                             <span class="text-white">{{ $invoice->Status }}</span>
                                                             @elseif($invoice->value_Status == 2)
                                                             <span class="text-danger">{{ $invoice->Status }}</span>
                                                             @else
                                                             <span class="text-warning">{{ $invoice->Status }}</span>
                                                             @endif
                                                         </td>                    
                                                     </h4>
                                                  
                                                 </div>
                                              
                                             </div>
                                         </div>
                                     </div>
                                     <span id="compositeline4" class="pt-1"></span>
                                 </div>
                             </div>
                         </div>     
     
                             <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                                 <div class="card overflow-hidden sales-card bg-success-gradient">
                                     <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                         <div class="">
                                             <h6 class="mb-3 tx-12 text-white">Counter Type</h6>
                                         </div>
                                         <div class="pb-0 mt-0">
                                             <div class="d-flex">
                                                 <div class="">
                                                     <h4 class="tx-20 font-weight-bold mb-1 text-white">
                     
                                                         {{ $invoice->counter->counterType->CounterType }}
                     
                                                     </h4>
                                           
                                                 </div>
                                         
                                             </div>
                                         </div>
                                     </div>
                                     <span id="compositeline3" class="pt-1"></span>
                                 </div>
                             </div>

                             @php

     $invoiceStatusCounts = $invoice->counter->invoices()
    ->select('Status', \DB::raw('count(*) as count'))
    ->groupBy('Status')
    ->get();
 
     $totalInvoiceStatus = $invoiceStatusCounts->sum('count');
 @endphp

 <div class="row justify-content-end">
     <div class="col-md-6">
         <div class="text-center">
             <h6 class="mb-3 tx-12 text-black">Invoice Status</h6>
             <div style="max-width: 300px; margin: auto;">
                 <canvas id="invoiceStatusChart"></canvas>
             </div>
         </div>
     </div>
 </div>

        </div>
    </div>
    
    <div class="tab-pane " id="tabs-1" role="tabpanel">
        <br>
		<h4>Counter Details</h4>
        <div class="card-body">
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
    </div>

	<div class="tab-pane " id="tabs-3" role="tabpanel">
        <br>      
		<h4>Invoices List</h4>
        <?php
           $invoicesWithSameCounter = $invoice->counter->invoices;
?>

  <table class="table key-buttons text-md-nowrap">  
      <tbody>
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
                  <th class="border-bottom-0">Note</th>
                  <th class="border-bottom-0">Created By</th>
                  <th class="border-bottom-0">Invoice</th>       
                </tr>   
              </thead>

              <tbody>
                @forelse ($invoicesWithSameCounter as $invoice)   
              <td>{{ $loop->iteration }}</td>
              <td>{{ $invoice->invoice_number }}</td>
              <td>{{ $invoice->invoice_Date }}</td>
              <td>{{ $invoice->due_date }}</td>
              <td>

<a data-idinvoice="{{ $invoice->idinvoice }}" href="{{ route('invoices.new-page', ['idinvoice' => $invoice->idinvoice]) }}" class="btn btn-outline-primary btn-sm edit-button" data-target="#edit_counter">
  {{ $invoice->counter->CounterReference }}
</a>
</td>
<br>
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
              <td>{{ $invoice->note }}</td>
                <td>{{ $invoice->Created_by }}</td>
                <td>
                  <button type="button" class="btn btn-default btn-sm open-image-modal" data-toggle="modal"
                    data-target="#imageModal{{ $loop->iteration }}">Open Image</button>
                </td>
                <td>
                <a data-idinvoice="{{ $invoice->idinvoice }}" href="{{ route('invoices.InvoiceDeatils', ['idinvoice' => $invoice->idinvoice]) }}" class="btn btn-outline-primary btn-sm edit-button" data-target="#edit_counter">
                    Invoice Details
                  </a>
                </td>
          </tr>
          @empty
          <tr>
              <td colspan="16">No invoices found.</td>
          </tr>
      </tbody>
          @endforelse
      </tbody>
  </table>
</div>
	


<div class="tab-pane " id="tabs-" role="tabpanel">
    <br>
    <h4>Local Details</h4>

    <div class="card-body">
        <div class="row mg-t-20">
           
            </div>
            <div class="col-md">
              <label class="tx-gray-600">Counter Deatils</label>

              <p class="invoice-info-row"><span>Local Label</span>
                <span>{{ $invoice->counter->locations->LocalLabel }}</span>
            </p>

            <p class="invoice-info-row"><span>Local Address</span>
              <span> {{ $invoice->counter->locations->LocalAddress}}</span>
            </p>
                <p class="invoice-info-row"><span>District Name</span>
                    <span>{{ $invoice->counter->locations->district->district_name }}</span>
                </p>

                <p class="invoice-info-row"><span>Local Family</span>
                    <span>{{ $invoice->counter->locations->subFamily->LocalFamily}}</span>
                </p>

                <p class="invoice-info-row"><span>Sub Family</span>
                    <span>{{ $invoice->counter->locations->subFamily->SubFamily}}</span>
                </p>
            </div>
    </div>
</div>
@endsection


@section('js')
<!--Internal Chart.bundle js -->
<script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>

 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var invoiceStatusCounts = @json($invoiceStatusCounts);
    var totalInvoiceStatus = {{ $totalInvoiceStatus }};

    var ctx = document.getElementById('invoiceStatusChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: invoiceStatusCounts.map(item => item.Status),
            datasets: [{
                data: invoiceStatusCounts.map(item => item.count),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var count = context.dataset.data[context.dataIndex];
                            var percentage = ((count / totalInvoiceStatus) * 100).toFixed(2);
                            return context.label + ': ' + count + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        }
    });
</script>

@endsection