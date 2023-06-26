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
            <h4 class="content-title mb-0 my-auto">Settings</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Location</span>
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
                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">Add Location</a>

                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>

                                <th class="border-bottom-0"> Local Label</th>

                                <th class="border-bottom-0"> Local Address</th>

                                <th class="border-bottom-0"> District </th>

                                <th class="border-bottom-0"> Sub Family </th>

                                <th class="border-bottom-0"></th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($locations as $location)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $location->LocalLabel }}</td>
                                <td>{{ $location->LocalAddress }}</td>
                                <td>{{ $location->district->district_name }}</td>
                                <td>{{ $location->subFamily->SubFamily }}</td>
                                <td>
                                    <button class="btn btn-outline-success btn-sm edit-button" 
                                    data-LocalLabel="{{ $location->LocalLabel }}" data-LocalAddress="{{ $location->LocalAddress }}" 
                                    data-DistrictCode="{{ $location->district->id }}" data-SubFamilyCode="{{ $location->subFamily->SubFamilyCode }}" data-LocalCode="{{ $location->LocalCode }}" data-toggle="modal" data-target="#edit_Location">
                                        Edit
                                    </button>


                                    <button class="btn btn-outline-danger btn-sm delete-button" 
            data-locallabel="{{ $location->LocalLabel }}" 
            data-localcode="{{ $location->LocalCode }}" 
            data-toggle="modal" 
            data-target="#modaldemo9">
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
                    <h6 class="modal-title">Add Location</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('location.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="LocalLabel">LocalLabel Name</label>
                            <input type="hidden" class="form-control" name="LocalLabel" id="LocalLabel" value="">
                            <input type="text" class="form-control" name="LocalLabel" id="LocalLabel">
                        </div>
                        <div class="form-group">
                            <label for="LocalAddress">Local Address</label>
                            <input type="text" class="form-control" name="LocalAddress" id="LocalAddress">
                        </div>
                        <div class="form-group">
                            <label for="DistrictCode">Sub districts</label>
                            <select name="DistrictCode" id="DistrictCode" class="custom-select" required>
                                @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="SubFamilyCode">Sub Family</label>
                            <select name="SubFamilyCode" id="SubFamilyCode" class="custom-select" required>
                                @foreach ($subFamilies as $subFamily)
                                <option value="{{ $subFamily->SubFamilyCode }}">{{ $subFamily->SubFamily }}</option>
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
<div class="modal fade" id="edit_Location" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="location/update" method="post">
                    {{ method_field('patch') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="LocalLabel">LocalLabel Name</label>
                        <input type="hidden" class="form-control" name="LocalCode" id="LocalCode" value="">
                        <input type="text" class="form-control" name="LocalLabel" id="LocalLabel">
                    </div>
                    <div class="form-group">
                        <label for="LocalAddress">Local Address</label>
                        <input type="text" class="form-control" name="LocalAddress" id="LocalAddress">
                    </div>
                    <div class="form-group">
                        <label for="DistrictCode">Sub districts</label>
                        <select name="DistrictCode" id="DistrictCode" class="custom-select" required>
                            @foreach ($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="SubFamilyCode">Sub Family</label>
                        <select name="SubFamilyCode" id="SubFamilyCode" class="custom-select" required>
                            @foreach ($subFamilies as $subFamily)
                            <option value="{{ $subFamily->SubFamilyCode }}">{{ $subFamily->SubFamily }}</option>
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
            <form action="location/destroy" method="POST">
                @method('DELETE')
                @csrf
                <div class="modal-body">
                    <p>Are you sure about the deletion process?</p>
                    <input type="hidden" class="form-control" name="LocalCode" id="delete_LocalCode" value="">
                    <input type="text" class="form-control" name="LocalLabel" id="delete_LocalLabel" readonly>
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
    $('#edit_Location').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var LocalLabel = button.data('locallabel');
        var LocalAddress = button.data('localaddress');
        var DistrictCode = button.data('districtcode');
        var SubFamilyCode = button.data('subfamilycode');
        var LocalCode = button.data('localcode');
        var modal = $(this);

        modal.find('.modal-body #LocalLabel').val(LocalLabel);
        modal.find('.modal-body #LocalAddress').val(LocalAddress);
        modal.find('.modal-body #DistrictCode').val(DistrictCode);
        modal.find('.modal-body #SubFamilyCode').val(SubFamilyCode);
        modal.find('.modal-body #LocalCode').val(LocalCode);
    });
</script>

<script>
    $(document).ready(function () {
        $('.delete-button').click(function () {
            var LocalCode = $(this).data('localcode');
            var LocalLabel = $(this).data('locallabel');
            $('#delete_LocalCode').val(LocalCode);
            $('#delete_LocalLabel').val(LocalLabel);
        });
    });
</script>
@endsection