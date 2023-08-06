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
					<h4 class="card-title mg-b-0">invoices Table</h4>
					<i class="mdi mdi-dots-horizontal text-gray"></i>
					<h6 class="card-subtitle mb-2 text-muted">: SORT BY </h6>
					<i class="fa fa-sort" aria-hidden="true"></i>
				
					 <a  href="{{ route('invoices.sortPaid', ['order' => 'asc', 'column' => 'LocalLabel']) }}" class="card-link"> Local Label ASC</a>
					<i class="fa fa-sort" aria-hidden="true"></i>
					<a href="{{ route('invoices.sortPaid', ['order' => 'desc', 'column' => 'LocalLabel']) }}" class="card-link"> Local Label DESC</a>
				
					<a  href="{{ route('invoices.sortUnpaidDueDate', ['order' => 'asc', 'column' => 'due_date']) }}" class="card-link"> Date ASC</a>
					<i class="fa fa-sort" aria-hidden="true"></i>
					<a href="{{ route('invoices.sortUnpaidDueDate', ['order' => 'desc', 'column' => 'due_date']) }}" class="card-link"> Date DESC</a>
					
				</div>
				
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="example" class="table key-buttons text-md-nowrap">
						<thead>
							<tr>
								<th class="border-bottom-0">#</th>

								<th class="border-bottom-0">invoice_number</th>

								<th class="border-bottom-0">invoice_Date</th>

								<th class="border-bottom-0">due_date</th>

								<th class="border-bottom-0">Counter Reference</th>

								<th class="border-bottom-0">Counter type </th>

								<th class="border-bottom-0">Local Label</th>

								<th class="border-bottom-0">discount</th>

								<th class="border-bottom-0">rate_vat</th>



								<th class="border-bottom-0">Total</th>

								<th class="border-bottom-0">status</th>

								<th class="border-bottom-0">note</th>

								<th class="border-bottom-0">Created_by</th>
								<th class="border-bottom-0"></th>
								<th class="border-bottom-0"></th>


							</tr>
						</thead>
						<tbody>
							<?php $i = 0; ?>
							@foreach ($invoices as $invoice)
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
								<td><a data-idinvoice="{{ $invoice->idinvoice }}" href="{{ route('invoices.edit', ['idinvoice' => $invoice->idinvoice]) }}" class="btn btn-outline-success btn-sm edit-button" data-target="#edit_counter">
    Edit
</a>




									<button data-idinvoice="{{ $invoice->idinvoice }}" class="btn btn-outline-danger btn-sm delete-button" data-toggle="modal" data-target="#modaldemo9">
										Delete
									</button>
								</td>
								<td></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!--/div-->
</div>

<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
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
@endsection