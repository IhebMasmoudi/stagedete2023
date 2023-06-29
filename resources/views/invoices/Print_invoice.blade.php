@extends('layouts.master')
@section('css')
<style>
    @media print {
        #print_Button {
            display: none;
        }
    }
</style>
@endsection
@section('title')
Print Invoice 
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">invoice</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
            invoice</span>
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
                        <h1 class="invoice-title">Invoice</h1>
                        <div class="billed-from">
                            <h6>BootstrapDash, Inc.</h6>
                            <p>*************<br>
                            Tel No: *************<br>
                            Email: Etap@Etap.com</p>
                        </div><!-- billed-from -->

                        
                    </div><!-- invoice-header -->
                    <div class="row mg-t-20">
                        <div class="col-md">
                            <label class="tx-gray-600">Billed To</label>
                            <div class="billed-to">
                                <h6>Etap</h6>
                                <p>Etap<br>
                                Tel No: *************<br>
                                Email: Etap@Etap.com</p>
                            </div>
                        </div>
                        <div class="col-md">
                            <label class="tx-gray-600">Invoice</label>
                            <p class="invoice-info-row"><span>Invoice Number</span>
                                <span>{{ $invoice->invoice_number }}</span>
                            </p>
                            <p class="invoice-info-row"><span>Invoice Date</span>
                                <span>{{ $invoice->invoice_Date }}</span>
                            </p>
                            <p class="invoice-info-row"><span>Due Date</span>
                                <span>{{ $invoice->Due_date }}</span>
                            </p>
                            <p class="invoice-info-row"><span>Counter Reference</span>
                                <span>{{ $invoice->counter->CounterReference }}</span>
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
                                    <th class="border-bottom-0">Note</th>
                                    <th class="border-bottom-0">Created By</th>
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
                                    <td>{{ $invoice->note }}</td>
                                    <td>{{ $invoice->Created_by }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                    <hr class="mg-b-40">
                    <button class="btn btn-danger float-left mt-3 mr-2" id="print_Button" onclick="printDiv()">
                        <i class="mdi mdi-printer ml-1"></i>Print
                    </button>
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
<!--Internal  Chart.bundle js -->
<script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>


<script type="text/javascript">
    function printDiv() {
        var printContents = document.getElementById('print').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>

@endsection