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
            <h4 class="content-title mb-0 my-auto">Settings</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Counter</span>
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
                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">Add Counter</a>

                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>

                                <th class="border-bottom-0"> Counter Reference</th>

                                <th class="border-bottom-0"> Local Label</th>

                                <th class="border-bottom-0"> Local Address</th>

                                <th class="border-bottom-0"> Counter Type </th>

                                <th class="border-bottom-0"></th>
                                <th class="border-bottom-0"></th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($counters as $counter)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i }}</td>
                                
                                <td>
                                    <a data-CounterReferenceid="{{ $counter->CounterReference }}" href="{{ route('counter.counter-stats', ['CounterReferenceid' => $counter->CounterReferenceid]) }}" class="btn btn-outline-primary btn-sm edit-button" data-target="#edit_counter">
                                        {{ $counter->CounterReference }}  </a>
                                  </td>
                            
                              <td> {{ $counter->locations->LocalLabel }}</td>
                                <td>{{ $counter->locations->LocalAddress }}</td>
                                <td>{{ $counter->counterType->CounterType }}</td>
                                <td>
                                    <button class="btn btn-outline-success btn-sm edit-button" data-counter-reference-id="{{ $counter->CounterReferenceid }}" data-CounterReference="{{ $counter->CounterReference }}" data-LocalCode="{{ $counter->locations->LocalCode }}" data-CounterTypeCode="{{ $counter->counterType->CounterTypeCode }}" data-toggle="modal" data-target="#edit_counter">
                                        Edit
                                    </button>


                                    <button class="btn btn-outline-danger btn-sm delete-button" data-counter-reference-id="{{ $counter->CounterReferenceid }}" data-counter-reference="{{ $counter->CounterReference }}" data-toggle="modal" data-target="#modaldemo9">
                                        Delete
                                    </button>
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
                    <h6 class="modal-title">Add Counter</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('counter.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="$counter->CounterReference">Counter Reference </label>

                            <input type="text" class="form-control" name="CounterReference" id="CounterReference">
                        </div>
                        <div class="form-group">
                            <label for="LocalCode">Local Name</label>
                            <select name="LocalCode" id="LocalCode" class="custom-select" required>
                                @foreach ($locations as $location)
                                <option value="{{ $location->LocalCode }}">{{ $location->LocalLabel }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="CounterTypeCode">counter type </label>
                            <select name="CounterTypeCode" id="CounterTypeCode" class="custom-select" required>
                                @foreach ($counter_types as $counter_type)
                                <option value="{{ $counter_type->CounterTypeCode }}">{{ $counter_type->CounterType }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End Basic modal -->
</div>

<!-- edit -->
<div class="modal" id="edit_counter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit counter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="counter/update" method="post">
                    @method('patch')
                    @csrf

                    <div class="form-group">
                        <label for="CounterReference">Counter Reference </label>
                        <input type="hidden" class="form-control" name="counterReferenceId" id="counterReferenceId" value="">
                        <input type="text" class="form-control" name="CounterReference" id="CounterReference">
                    </div>
                    <div class="form-group">
                        <label for="LocalCode">Local Name</label>
                        <select name="LocalCode" id="LocalCode" class="custom-select" required>
                            @foreach ($locations as $location)
                            <option value="{{ $location->LocalCode }}">{{ $location->LocalLabel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="CounterTypeCode">Counter Type</label>
                        <select name="CounterTypeCode" id="CounterTypeCode" class="custom-select" required>
                            @foreach ($counter_types as $counter_type)
                            <option value="{{ $counter_type->CounterTypeCode }}">{{ $counter_type->CounterType }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Edit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal" id="modaldemo9">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Delete Location</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="counter/destroy" method="POST">
                @method('DELETE')
                @csrf
                <div class="modal-body">
                    <p>Are you sure about the deletion process?</p>
                    <input type="hidden" class="form-control" name="counterReferenceId" id="counterReferenceId" value="">
                    <input type="text" class="form-control" name="counterReference" id="counterReference" readonly>
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
    $('#edit_counter').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var counterReferenceId = button.data('counter-reference-id');
        var CounterReference = button.data('counterreference');
        var LocalCode = button.data('localcode');
        var CounterTypeCode = button.data('countertypecode');
        var modal = $(this);

        modal.find('.modal-body #CounterReference').val(CounterReference);
        modal.find('.modal-body #LocalCode').val(LocalCode);
        modal.find('.modal-body #CounterTypeCode').val(CounterTypeCode);
        modal.find('.modal-body #counterReferenceId').val(counterReferenceId);
    });
</script>

<script>
    $(document).ready(function() {
        $('.delete-button').click(function() {
            var counterReferenceId = $(this).data('counter-reference-id');
            var counterReference = $(this).data('counter-reference');
            $('#counterReferenceId').val(counterReferenceId);
            $('#counterReference').val(counterReference);
        });+
    });
</script>


@endsection