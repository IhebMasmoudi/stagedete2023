@extends('layouts.master')
@section('css')
<!--- Internal Select2 css-->
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<!---Internal Fileupload css-->
<link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
<!---Internal Fancy uploader css-->
<link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
<!--Internal Sumoselect css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
<!--Internal  TelephoneInput css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
Edit invoices
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                Edit invoices</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
            <form action="{{ route('invoices.update', ['idinvoice' => $invoice->idinvoice]) }}" method="POST" autocomplete="off">
    @method('patch')
    @csrf

    {{-- Form inputs --}}
    <!-- Invoice Number -->
    <div class="row">
        <div class="col">
            <label for="inputName" class="control-label">Invoice Number</label>
            <input type="text" class="form-control" id="inputName" name="invoice_number" title="Invoice Number" value="{{ $invoice->invoice_number }}" required>
        </div>
        <!-- Invoice Date -->
        <div class="col">
    <label>Invoice Date</label>
    <input class="form-control fc-datepicker" name="invoice_Date" placeholder="DD-MM-YYYY" type="text" value="<?php echo date('d-m-y'); ?>" required>
</div>
<!-- Due Date -->
<div class="col">
    <label>Due Date (You need to pay before)</label>
    <input class="form-control fc-datepicker" name="due_date" placeholder="DD-MM-YYYY" type="text" value="<?php echo date('d-m-y'); ?>" required>
</div>

    </div>

    {{-- Counter Reference --}}
    <div class="row">
        <div class="col">
            <label for="inputName" class="control-label">Counter Reference</label>
            <select name="Reference" class="form-control SlectBox" onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                <option value="{{ $invoice->counter->CounterReferenceid }}" selected disabled>{{ $invoice->counter->CounterReference }}</option>
                @foreach ($counters->unique('CounterReferenceid') as $counter)
                    <option value="{{ $counter->CounterReferenceid }}">{{ $counter->CounterReference }}</option>
                @endforeach
            </select>
        </div>
        {{-- Counter Type --}}
        <div class="col">
            <label for="inputName" class="control-label">Counter Type</label>
            <select name="CounterTypeCode" class="form-control SlectBox" onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                <option value="{{ $invoice->counter->counterType->CounterTypeCode }}" selected disabled>{{ $invoice->counter->counterType->CounterType }}</option>
                @foreach ($counters->unique('CounterTypeCode') as $counter)
                    <option value="{{ $counter->counterType->CounterTypeCode }}">{{ $counter->counterType->CounterType }}</option>
                @endforeach
            </select>
        </div>
        {{-- Local Label --}}
        <div class="col">
            <label for="inputName" class="control-label">Local Label</label>
            <select name="LocalLabel" class="form-control SlectBox" onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                <option value="{{ $invoice->counter->locations->LocalCode }}" selected disabled>{{ $invoice->counter->locations->LocalLabel }}</option>
                @foreach ($counters->unique('LocalCode') as $counter)
                    <option value="{{ $counter->locations->LocalCode }}">{{ $counter->locations->LocalLabel }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Discount and VAT -->
    <div class="row">
        <div class="col">
            <label for="inputName" class="control-label">Discount</label>
            <input type="text" class="form-control form-control-lg" id="Discount" value="{{ $invoice->discount }}" name="Discount" title="Discount" oninput="calculatePrice()" value="0" required>
        </div>
        <div class="col">
            <label for="inputName" class="control-label">VAT</label>
            <select name="Rate_VAT" id="Rate_VAT" class="form-control" onchange="calculatePrice()">
                <option value="{{ $invoice->rate_vat }}" selected disabled>{{ $invoice->rate_vat }}</option>
                <option value="5">5%</option>
                <option value="7">7%</option>
                <option value="10">10%</option>
            </select>
        </div>
    </div>

    <!-- Price and Total -->
    <div class="row">
        <div class="col">
            <label for="inputName" class="control-label">Price</label>
            <input type="text" class="form-control" value="{{ $invoice->value_vat }}" id="Value_VAT" name="Value_VAT" oninput="calculatePrice()">
        </div>
        <div class="col">
            <label for="inputName" class="control-label">Total</label>
            <input type="text" class="form-control" value="{{ $invoice->Total }}" id="Total" name="Total" readonly>
        </div>
        <div class="col">
            <label class="control-label" for="status">Select Status:</label>
            <select class="form-control" id="status" name="status" onchange="changeValueStatus()">
                <option value="" selected disabled></option>
                <option value="1">Paid</option>
                <option value="2">Unpaid</option>
                <option value="3">Other</option>
            </select>
        </div>
    </div>

    <br>
    {{-- 5 --}}
                    <div class="row">
                        <div class="col">
                            <label for="exampleTextarea">Note</label>
                            <textarea class="form-control" value="{{ $invoice->note }}" id="exampleTextarea" name="note" rows="3"></textarea>
                        </div>
                        </div><br>
                        <p class="text-danger">*   pdf, jpeg ,.jpg , png </p>
                        <h5 class="card-title">Attachments</h5>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="pathImage" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-height="70" />
                        </div><br>
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Edit</button>
    </div>
</form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Select2 js-->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Fileuploads js-->
<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
<!--Internal Fancy uploader js-->
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
<!--Internal  Form-elements js-->
<script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
<script src="{{ URL::asset('assets/js/select2.js') }}"></script>
<!--Internal Sumoselect js-->
<script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'dd-mm-yy'
    }).val();
</script>
<script>
  function calculatePrice() {
    // Get input values
    var discount = parseFloat(document.getElementById("Discount").value) || 0;
    var vatRate = parseFloat(document.getElementById("Rate_VAT").value) || 0;
    var priceBeforeVAT = parseFloat(document.getElementById("Value_VAT").value) || 0;

    // Calculate VAT value
    var vatValue = (priceBeforeVAT * vatRate) / 100;

    // Calculate total price
    var totalPrice = priceBeforeVAT + vatValue - discount;

    // Update Total field
    document.getElementById("Total").value = totalPrice.toFixed(2);
  }
</script>
<script>
    function changeValueStatus() {
      var select = document.getElementById("status");
      var valueStatus = select.value;

      // Update the value_Status based on the selected option
      if (valueStatus === "1") {
        value_Status = 1;
      } else if (valueStatus === "2") {
        value_Status = 2;
      } else {
        value_Status = 3;
      }

      console.log("value_Status:", value_Status);
    }
  </script>
@endsection