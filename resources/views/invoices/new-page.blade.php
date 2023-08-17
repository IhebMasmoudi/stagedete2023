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
                        <h1 class="invoice-title">Invoice Details Dashboard</h1>
                            
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
           


                 
                         <!-- for counter type-->
                         @php      
                         $counterReference = $invoice->counter->CounterReference;
     
                         $totalInvoices = \App\Invoices::whereHas('counter', function($query) use ($counterReference) {
                             $query->where('CounterReference', $counterReference);
                         })->sum('Total');
     
                         $invoiceCount = \App\Invoices::whereHas('counter', function($query) use ($counterReference) {
                             $query->where('CounterReference', $counterReference);
                         })->count();
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
    // Récupérer les données des statuts de factures associées à ce Counter Reference
    $invoiceStatusCounts = \App\Invoices::whereHas('counter', function($query) use ($counterReference) {
        $query->where('CounterReference', $counterReference);
    })
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
                    // Ajoutez d'autres couleurs ici si nécessaire
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    // Ajoutez d'autres couleurs ici si nécessaire
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

                                                
<!-- main-content closed -->
@endsection
@section('js')
<!--Internal Chart.bundle js -->
<script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>



@endsection