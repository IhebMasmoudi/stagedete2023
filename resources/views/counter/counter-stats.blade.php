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
@endsection
@section('content')

<div class="row row-sm">
    <div class="col-md-12 col-xl-12">
        <div class="main-content-body-invoice" id="print">
            <div class="card card-invoice">
                <div class="card-body">
                    <div class="invoice-header">
                        <h1 class="invoice-title">Counter Dashboard</h1>
                            
                    </div>
               
                    <div class="table-responsive mg-t-40">
                      

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

                        @php
    $counterLocalAddresses = \App\counters::whereHas('locations', function($query) use ($counterLocalLabel) {
        $query->where('LocalLabel', $counterLocalLabel);
    })
    ->join('locations', 'counters.LocalCode', '=', 'locations.LocalCode')
    ->select('locations.LocalAddress', \DB::raw('count(*) as count'))
    ->groupBy('locations.LocalAddress')
    ->get();

    $totalCounterAddresses = $counterLocalAddresses->sum('count');
@endphp

            
                        
                        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                            <div class="card overflow-hidden sales-card bg-danger-gradient">
                                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                    <div class="">
                                        <h6 class="mb-3 tx-12 text-white">  Local Address</h6>
                                    </div>
                                    <div class="pb-0 mt-0">
                                        <div class="d-flex">
                                            <div class="">
                                                <h3 class="tx-20 font-weight-bold mb-1 text-white">
                
                                                    {{ $counter->locations->LocalAddress }}  
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
                                        <h6 class="mb-3 tx-12 text-white"> Counter Refrence</h6>
                                    </div>
                                    <div class="pb-0 mt-0">
                                        <div class="d-flex">
                                            <div class="">
                                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                                    {{ $counter->CounterReference }}                
                                                </h4>
                                            </div>
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
                                        <h6 class="mb-3 tx-12 text-white"> Counter Type </h6>
                                    </div>
                                    <div class="pb-0 mt-0">
                                        <div class="d-flex">
                                            <div class="">
                                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                
                                                    {{$counter->counterType->CounterType }}                
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span id="compositeline4" class="pt-1"></span>
                            </div>
                        </div>     
                    </div>


<!--District Name-->

@php
    $districtName = \App\counters::whereHas('locations', function($query) use ($counterLocalLabel) {
        $query->where('LocalLabel', $counterLocalLabel);
    })
    ->join('locations', 'counters.LocalCode', '=', 'locations.LocalCode')
    ->join('districts', 'locations.DistrictCode', '=', 'districts.id')
    ->select('districts.District_name')
    ->pluck('districts.District_name')
    ->first();
@endphp


<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
    <div class="card overflow-hidden sales-card bg-success-gradient">
        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
            <div class="">
                <h6 class="mb-3 tx-12 text-white"> Counter Type </h6>
            </div>
            <div class="pb-0 mt-0">
                <div class="d-flex">
                    <div class="">
                        <h4 class="tx-20 font-weight-bold mb-1 text-white">

                            @if ($districtName)
                            <p>{{ $districtName }}</p>
                        @else
                            <p>No district associated with this counter and location.</p>
                        @endif                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <span id="compositeline4" class="pt-1"></span>
    </div>
</div>  

    <!--Counter Types-->
<div class="row justify-content-end">
    <div class="col-md-6"> <!-- Adjust the column width as needed -->
        <div class="text-center">
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