@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">Settings</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ LocalFamily</span>
		</div>
	</div>
	<div class="d-flex my-xl-auto right-content">


	</div>
</div>
<!-- breadcrumb -->
@endsection


@section('content')

@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif

@if (session()->has('Add'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>{{ session()->get('Add') }}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

@if (session()->has('delete'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<strong>{{ session()->get('delete') }}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

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


	<!--div-->
	<div class="col-xl-12">
		<div class="card mg-b-20">
			<div class="card-header pb-0">
				<div class="d-flex justify-content-between">
					<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">Add local family</a>

				</div>

			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="example1" class="table key-buttons text-md-nowrap">
						<thead>
							<tr>
								<th class="border-bottom-0">#</th>

								<th class="border-bottom-0">LocalFamily</th>
								<th class="border-bottom-0"></th>


							</tr>
						</thead>
						<tbody>
							<?php $i = 0 ?>

							@foreach($locality_families as $x)
							<?php $i++ ?>
							<tr>
								<td>{{ $i }}</td>

								<td>{{ $x->LocalFamily }}</td>

								<td>
									<a class="btn btn-outline-success btn-sm"  data-effect="effect-scale" data-id="{{ $x->FamilyCode }}" 
									data-district_name="{{ $x->LocalFamily }}" 
									data-toggle="modal" href="#exampleModal2" 
									title="edit">edit<i class="las la-pen"></i></a>

									<a class="btn btn-outline-danger btn-sm" data-effect="effect-scale" data-id="{{ $x->FamilyCode }}" data-district_name="{{ $x->LocalFamily }}" data-toggle="modal" href="#modaldemo9" title="delete">delete<i class="las la-trash"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Basic modal -->
	<div class="modal" id="modaldemo8">
		<div class="modal-dialog" role="document">
			<div class="modal-content modal-content-demo">
				<div class="modal-header">
					<h6 class="modal-title">Add LocalFamily</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<form action="{{ route('locality_family.store') }}" method="post">
						{{ csrf_field() }}

						<div class="form-group">
							<label for="exampleInputEmail1">LocalFamily name</label>
							<input type="text" class="form-control" id="LocalFamily" name="LocalFamily">
						</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-success">Confirm</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Basic modal -->
</div>
<!-- Edit Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="locality_family/update" method="post" autocomplete="off">
					{{ method_field('patch') }}
					{{ csrf_field() }}
					<div class="form-group">
						<input type="hidden" name="FamilyCode" id="edit_id" value="">

						<label for="edit_local_family" class="col-form-label">Local Family</label>

						<input class="form-control" name="LocalFamily" id="edit_local_family" type="text">
					</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Confirm</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- delete -->
<div class="modal" id="modaldemo9">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content modal-content-demo">
			<div class="modal-header">
				<h6 class="modal-title">Delete locality Family</h6>
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="locality_family/destroy" method="post">
			               {{ method_field('DELETE') }}
                            {{ csrf_field() }}
				<div class="modal-body">
					<div class="form-group">
						<p>Are you sure about the deletion process?</p><br>
						<input type="hidden" name="FamilyCode" id="FamilyCode" value="">
						<input class="form-control" name="LocalFamily" id="edit_local_family" type="text" readonly>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-danger">Confirm</button>
				</div>
			</form>
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

<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>



<script>
	$('#exampleModal2').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var localFamily = button.data('district_name')
		var modal = $(this)
		modal.find('.modal-body #edit_id').val(id);
		modal.find('.modal-body #edit_local_family').val(localFamily);
	});
</script>
<script>
	$('#modaldemo9').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget);
		var id = button.data('id');
		var localFamily = button.data('district_name');
		var modal = $(this);
		modal.find('.modal-body #FamilyCode').val(id);
		modal.find('.modal-body #edit_local_family').val(localFamily);
	});
</script>

@endsection