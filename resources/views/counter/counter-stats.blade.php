@extends('layouts.master')
@section('css')

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
                        <!-- ... Votre tableau existant ... -->

<canvas id="barChart"></canvas>
<canvas id="lineChart"></canvas>
<canvas id="pieChart"></canvas>

                    </div>
                    <hr class="mg-b-40">
                  
                </div>
            </div>
        </div>

     
    </div><!-- COL-END -->
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