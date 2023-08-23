@extends('layouts.master')
@section('title')
    Dashboard
@stop
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ __('messages.welcome_back') }}</h2> 

            </div>
        </div>
        
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white"> Total </h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">

                                    {{ number_format(\App\invoices::sum('Total'), 2) }}
                                </h4>
                                <p class="mb-0 tx-12 text-white op-7">{{ \App\invoices::count() }}</p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7">100%</span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
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
                <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
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
                <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
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
                <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
    </div>
    <!-- row closed -->
<!-- row opened -->
<div class="row row-sm">
    <div class="col-md-12 col-lg-12 col-xl-7">
        <div class="card">
            <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-0">Statistics</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body" style="width: 70%">
                {!! $chartjs->render() !!}
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-xl-5">
        <div class="card card-dashboard-map-one">
            <label class="main-content-label">Statistics</label>
            <div class="" style="width: 100%">
                {!! $chartjs_2->render() !!}
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-xl-5">
        <div class="card card-dashboard-map-one">
            <label class="main-content-label">Statistics</label>
            <div class="" style="width: 100%">
                {!! $chartjs1->render() !!}
            </div>
        </div>
    </div>

    <div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h1>Chart Per Local and Date </h1>
                    <form id="chartForm" action="{{ route('generate') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input class="form-control fc-datepicker" type="date" name="start_date" id="start_date" placeholder="yyyy-mm-dd" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date:</label>
                            <input class="form-control fc-datepicker" type="date" name="end_date" id="end_date" placeholder="yyyy-mm-dd" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Location:</label>
                            <select class="form-control" name="location" id="location">
                                <option value="">All Locations</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location }}">{{ $location }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Generate Chart</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="chartContainer"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>


<!-- row closed -->

<!-- Container closed -->
@endsection

@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>

    <!-- Bootstrap Datepicker -->
    <script>
        // Initialize datepicker
        $(document).ready(function() {
    $('.fc-datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });
});

        // AJAX request to generate the chart
        $('#chartForm').submit(function (e) {
            e.preventDefault(); // Prevent form submission
            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: 'POST',
                url: url,
                data: form.serialize(),
                success: function (response) {
                    renderChart(response); // Call the function to render the chart
                },
                error: function (xhr, status, error) {
                    console.log(error); // Handle error if necessary
                }
            });
        });

        // Function to render the chart using Chart.js
        function renderChart(chartData) {
            var ctx = document.getElementById('chartContainer').getContext('2d');
            var chart = new Chart(ctx, chartData);
        }
    </script>
@endsection
