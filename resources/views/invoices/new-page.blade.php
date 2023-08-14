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
                        <!-- ... Votre tableau existant ... -->

<canvas id="barChart"></canvas>
<canvas id="lineChart"></canvas>
<canvas id="pieChart"></canvas>
@extends('layouts.master')
@section('css')
<!-- Add your CSS imports here -->
@endsection

@section('title')
Counter Stats
@stop

@section('content')
<!-- Your existing content -->

<!-- Add chart canvas elements here -->
<canvas id="invoiceAmountChart"></canvas>
<canvas id="counterTypeDistributionChart"></canvas>
@endsection

@section('js')
<script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>

<script>
    // Receive the Local Label from the URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const localLabel = urlParams.get('localLabel');

    // You'll need to fetch data from your backend using AJAX or other methods
    // to get the counts of counter types for the specific Local Label
    // Here's a simplified example assuming you have fetched the data

    // Example data structure: object with counter type counts
    const counterTypeData = {
        "Electricity": 10,  // Replace with actual count
        "Water": 5,
        "Gas": 3
        // Add other counter types and counts
    };

    // Create the counter type distribution chart
    const counterTypeDistributionChart = new Chart(document.getElementById('counterTypeDistributionChart'), {
        type: 'pie',
        data: {
            labels: Object.keys(counterTypeData),
            datasets: [{
                data: Object.values(counterTypeData),
                backgroundColor: ['red', 'green', 'blue'], // Add more colors as needed
                borderWidth: 1
            }]
        },
        options: {
            // Chart options
        }
    });
</script>
@endsection

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