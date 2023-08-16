@extends('layouts.master')
@section('css')
<link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('title')
Counter Details
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Counter </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
            Counter Dashboard</span>
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
                        <h1 class="invoice-title">Counter Dashboard</h1>
                            
                    </div><!-- invoice-header -->
                    <div class="row mg-t-20">
                       
                        </div>
                        <div class="col-md">
                          <label class="tx-gray-600">Counter Dashboard</label>

                          <p class="invoice-info-row"><span>Counter Reference</span>
                            <span>{{ $counter->CounterReference }}</span>
                        </p>

                        <p class="invoice-info-row"><span>Counter Local Label</span>
                            <span> {{ $counter->locations->LocalLabel }} </span>   
                        </p>

                        <p class="invoice-info-row"><span>Counter Local address</span>
                            <span> {{ $counter->locations->LocalAddress }} </span>   
                        </p>

                      
                        <p class="invoice-info-row"><span>Counter Type</span>
                          <td>{{$counter->counterType->CounterType }}</td>
                        </p>
                            <p class="invoice-info-row"><span>Counter Refrence </span>
                                <span>{{ $counter->CounterReferenceid }}</span>
                            </p>
                           
                        </div>
                    </div>
                    <div class="table-responsive mg-t-40">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Counter Refrence</th>
                                    <th class="border-bottom-0">Counter Local Label</th>
                                    <th class="border-bottom-0">Counter Local Address</th>
                                    <th class="border-bottom-0">Counter Type</th>
                                    <th class="border-bottom-0">Counter Refrence</th>
                                    <th class="border-bottom-0"></th>
                                    <th class="border-bottom-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                               
                                <?php $i++; ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $counter->CounterReference }}</td>
                                    <td> {{ $counter->locations->LocalLabel }} </td>
                                    <td> {{ $counter->locations->LocalAddress }} </td>   
                                    <td>{{$counter->counterType->CounterType }}</td>
                                    <td>{{ $counter->CounterReferenceid }}</td>
                                    
                                    <td></td>
                                    <td></td>
                                </tr>
                               
                            </tbody>
                        </table>

                        @php
                        $counterLocalLabel = $counter->locations->LocalLabel;
                    
                        $counterTypeCounts = \App\counters::whereHas('locations', function($query) use ($counterLocalLabel) {
                            $query->where('LocalLabel', $counterLocalLabel);
                        })
                        ->join('counter_types', 'counters.CounterTypeCode', '=', 'counter_types.CounterTypeCode')
                        ->select('counter_types.CounterType', \DB::raw('count(*) as count'))
                        ->groupBy('counter_types.CounterType')
                        ->get();
                    
                        $totalCounterTypes = $counterTypeCounts->sum('count');
                    @endphp

          

                    <div class="row row-sm">
                        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                            <div class="card overflow-hidden sales-card bg-primary-gradient">
                                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                    <div class="">
                                        <h6 class="mb-3 tx-12 text-white">Counter Local Label</h6>
                                    </div>
                                    <div class="pb-0 mt-0">
                                        <div class="d-flex">
                                            <div class="">
                                                
                                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                                  {{ $counterLocalLabel }}
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
                                        <h6 class="mb-3 tx-12 text-white">  Unpaid</h6>
                                    </div>
                                    <div class="pb-0 mt-0">
                                        <div class="d-flex">
                                            <div class="">
                                                <h3 class="tx-20 font-weight-bold mb-1 text-white">
                
                                                    {{ number_format(\App\invoices::where('Value_Status', 2)->sum('Total'), 2) }}
                
                                                </h3>
                                                <p class="mb-0 tx-12 text-white op-7">{{ \App\invoices::where('Value_Status', 2)->count() }}
                                                </p>
                                            </div>
                                            <span class="float-right my-auto mr-auto">
                                                <i class="fas fa-arrow-circle-down text-white"></i>
                                                <span class="text-white op-7">
                
                                                    @php
                                                    $count_all= \App\invoices::count();
                                                    $count_invoices2 = \App\invoices::where('Value_Status', 2)->count();
                
                                                    if($count_invoices2 == 0){
                                                       echo $count_invoices2 = 0;
                                                    }
                                                    else{
                                                       echo $count_invoices2 = $count_invoices2 / $count_all *100;
                                                    }
                                                    @endphp
                
                                                </span>
                                            </span>
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
                                        <h6 class="mb-3 tx-12 text-white"> Paid</h6>
                                    </div>
                                    <div class="pb-0 mt-0">
                                        <div class="d-flex">
                                            <div class="">
                                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                
                                                    {{ number_format(\App\invoices::where('Value_Status', 1)->sum('Total'), 2) }}
                
                                                </h4>
                                                <p class="mb-0 tx-12 text-white op-7">
                                                    {{ \App\invoices::where('Value_Status', 1)->count() }}
                                                </p>
                                            </div>
                                            <span class="float-right my-auto mr-auto">
                                                <i class="fas fa-arrow-circle-up text-white"></i>
                                                <span class="text-white op-7">
                                                    @php
                                                        $count_all= \App\invoices::count();
                                                        $count_invoices1 = \App\invoices::where('Value_Status', 1)->count();
                
                                                        if($count_invoices1 == 0){
                                                           echo $count_invoices1 = 0;
                                                        }
                                                        else{
                                                           echo $count_invoices1 = $count_invoices1 / $count_all *100;
                                                        }
                                                    @endphp
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <span id="compositeline3" class="pt-1"></span>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                            <div class="card overflow-hidden sales-card bg-warning-gradient">
                                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                    <div class="">
                                        <h6 class="mb-3 tx-12 text-white"> Other </h6>
                                    </div>
                                    <div class="pb-0 mt-0">
                                        <div class="d-flex">
                                            <div class="">
                                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                
                                                    {{ number_format(\App\invoices::where('Value_Status', 3)->sum('Total'), 2) }}
                
                                                </h4>
                                                <p class="mb-0 tx-12 text-white op-7">
                                                    {{ \App\invoices::where('Value_Status', 3)->count() }}
                                                </p>
                                            </div>
                                            <span class="float-right my-auto mr-auto">
                                                <i class="fas fa-arrow-circle-down text-white"></i>
                                                <span class="text-white op-7">
                                                    @php
                                                        $count_all= \App\invoices::count();
                                                        $count_invoices1 = \App\invoices::where('Value_Status', 1)->count();
                
                                                        if($count_invoices1 == 0){
                                                            echo $count_invoices1 = 0;
                                                        }
                                                        else{
                                                          echo $count_invoices1 = $count_invoices1 / $count_all *100;
                                                        }
                                                    @endphp
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <span id="compositeline4" class="pt-1"></span>
                            </div>
                        </div>
                
                
                    </div>




    <!--Counter Types-->
<div class="row justify-content-start">
    <div class="col-md-6"> <!-- Adjust the column width as needed -->
        <div class="text-center">
            <h6 class="mb-3 tx-12 text-black">Counter Local Label &nbsp;&nbsp;&nbsp; {{ $counterLocalLabel }}</h6>
            <!-- Titre du graphique -->
            <h6 class="mb-3 tx-12 text-black">Counter Types</h6>
            
    

            <!-- Smaller Graphique doughnut -->
            <div style="max-width: 300px; margin: auto;">
                <canvas id="counterTypeChart"></canvas>
            </div>
        </div>
    </div>
</div>

        
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var counterTypeCounts = @json($counterTypeCounts);
            var totalCounterTypes = {{ $totalCounterTypes }};
        
            var ctx = document.getElementById('counterTypeChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: counterTypeCounts.map(item => item.CounterType),
                    datasets: [{
                        data: counterTypeCounts.map(item => item.count),
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
                                    var percentage = ((count / totalCounterTypes) * 100).toFixed(2);
                                    return context.label + ': ' + count + ' (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });
        </script>



        <!--test cards-->
<!-- COL-END -->
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!--Internal Chart.bundle js -->
<script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>



@endsection