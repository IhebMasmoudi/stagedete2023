@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ invoices List</span>
		</div>
	</div>

</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">

  <!--div-->
  <div class="col-xl-12">
    <div class="card mg-b-20">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between">
          <h4 class="card-title mg-b-0">Invoices Table</h4>
          <i class="mdi mdi-dots-horizontal text-gray"></i>
        </div>
        <div class="d-flex justify-content-between">
          <a href="{{ route('invoices.create') }}" class="modal-effect btn btn-sm btn-primary" style="color:white">
            <i class="fas fa-plus"></i>&nbsp; Add invoices</a>
            <h6 class="card-subtitle mb-2 text-muted">: SORT BY </h6>
            <i class="fa fa-sort" aria-hidden="true"></i>
        
            <a  href="{{ route('invoices.sort', ['order' => 'asc', 'column' => 'LocalLabel']) }}" class="card-link"> Local Label ASC</a>
            <i class="fa fa-sort" aria-hidden="true"></i>
            <a href="{{ route('invoices.sort', ['order' => 'desc', 'column' => 'LocalLabel']) }}" class="card-link"> Local Label DESC</a>
        
            <a  href="{{ route('invoices.sortDueDate', ['order' => 'asc', 'column' => 'due_date']) }}" class="card-link"> Date ASC</a>
            <i class="fa fa-sort" aria-hidden="true"></i>
            <a href="{{ route('invoices.sortDueDate', ['order' => 'desc', 'column' => 'due_date']) }}" class="card-link"> Date DESC</a>
        
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
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
                <th class="border-bottom-0">Invoice</th>
                <th class="border-bottom-0">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($invoices as $invoice)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $invoice->invoice_number }}</td>
                <td>{{ $invoice->invoice_Date }}</td>
                <td>{{ $invoice->due_date }}</td>
                <td>
  <button class="btn btn-light open-modal" data-counter-id="{{ $invoice->counter->CounterReferenceid }}">
    {{ $invoice->counter->CounterReference }}
  </button>
</td>

                <td>{{ $invoice->counter->counterType->CounterType }}</td>
                <td>
                  
                  
                      {{ $invoice->counter->locations->LocalLabel }}
                 
              </td>

             
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
                  <a data-idinvoice="{{ $invoice->idinvoice }}"
                    href="{{ route('invoices.edit', ['idinvoice' => $invoice->idinvoice]) }}"
                    class="btn btn-outline-success btn-sm edit-button" data-target="#edit_counter">
                    Edit
                  </a>
                  <button data-idinvoice="{{ $invoice->idinvoice }}" class="btn btn-outline-danger btn-sm delete-button" data-toggle="modal" data-target="#modaldemo9">
                    Delete
                  </button>
                  <a data-idinvoice="{{ $invoice->idinvoice }}" href="{{ route('invoices.printInvoice', ['idinvoice' => $invoice->idinvoice]) }}" class="btn btn-outline-primary btn-sm edit-button" data-target="#edit_counter">
                    Print
                  </a>
                </td>
              </tr>
              <!-- Image Modal for this specific invoice -->
              <div class="modal fade" id="imageModal{{ $loop->iteration }}" tabindex="-1" role="dialog"
                aria-labelledby="imageModalLabel{{ $loop->iteration }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="imageModalLabel{{ $loop->iteration }}">Image</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body text-center">
                      <img src="{{ asset('storage/app'). '/' . $invoice->pathImage }}" alt="test" class="img-fluid">
                    </div>
                  </div>
                </div>
              </div>
              @empty
              <tr>
                <td colspan="15">No invoices found.</td>
              </tr>
              @endforelse
            </tbody>
            <tfoot>
              <tr>
                <th colspan="9" class="text-right">Total:</th>
                <th colspan="5">
                  @php
                    $totalAmount = $invoices->sum('Total');
                  @endphp
                  {{ $totalAmount }}
                </th>
                <th colspan="1"></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
 <!--/div-->
 <div class="modal fade" id="counter-info-modal" tabindex="-1" role="dialog" aria-labelledby="counter-info-modal-label"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="counter-info-modal-label">Counter Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Counter Reference:</td>
              <td><span id="modal-counter-reference"></span></td>
            </tr>
            <tr>
              <td>Counter Type:</td>
              <td><span id="modal-counter-type"></span></td>
            </tr>
            <tr>
              <td>Local Label:</td>
              <td><span id="modal-local-label"></span></td>
            </tr>
            <!-- Add more counter information fields here as needed -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!-- Container closed -->
@endsection

@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script>
$(document).ready(function() {
  $('.open-modal').on('click', function() {
    var counterId = $(this).data('counter-id');
     $.ajax({
      url: '{{ route('getCounterInfo') }}',
      type: 'GET',
      data: { CounterReferenceid: counterId },
      success: function(response) {
        console.log(response);
        // Populate the pop-up modal with the counter information
        $('#modal-counter-reference').text(response.CounterReference);
        $('#modal-counter-type').text(response.counterType);
        $('#modal-local-label').text(response.LocalLabel);
        // Add more lines here to populate other fields in the modal if needed

         // Show the pop-up modal
         $('#counter-info-modal').modal('show');
      },
      error: function(xhr) {
        // Handle any errors that occur during the AJAX request
        console.log(xhr.responseText);
      }
    });
  });
});
</script>


@endsection