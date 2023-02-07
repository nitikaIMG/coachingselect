@extends('main')

@section('heading')
Colleges
@endsection('heading')

@section('sub-heading')
Add College
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CollegeController@view_college')}}" class="btn btn-sm btn-primary mx-1" data-toggle="tooltip" title="" data-original-title="View College"><i class="fad fa-eye"></i>&nbsp; View College</a>
<a href="{{ action('CollegeController@view_college_valuable', 'id='.$college_id) }}" class="btn btn-sm btn-primary mx-1" data-toggle="tooltip" title="" data-original-title="View College Valuable"><i class="fad fa-eye"></i>&nbsp; View College Valuable</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">
        <div class="row mx-0 w-100">
            <div class="col">Add College ("{{ $college_name }}") (Valuable)</div>
            <div class="col-auto">
                <div class="row">
                    <div class="col-auto px-0">
                        <input type='button' value='Add More' id='addButton' class="btn btn-sm btn-outline-primary font-weight-bold text-uppercase text-primary float-right" />
                    </div>
                    <div class="col-auto pl-1">
                        <input type='button' value='Remove' id='removeButton' class="btn btn-sm btn-outline-primary font-weight-bold text-uppercase text-primary float-right" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content p-4">


                <form action="{{ action('CollegeController@add_valuable') }}" method="post" enctype="multipart/form-data" id="valuable">
                    @csrf

                    <input type="hidden" name="college_id" value="{{$college_id}}" required>

                    <div class="card-body">

                        <div class="form-horizontal">
                            <div class="control-group">
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Image</label>
                                            <input type="file" class="form-control" name="valuable[0][image]" required style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <input type="text" class="form-control" name="valuable[0][name]" placeholder="Enter Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <textarea class="form-control" name="valuable[0][description]" placeholder="Enter description" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12 text-right">
                        <button class="btn btn-sm btn-success" type="submit" form="valuable">
                        <i class="far fa-check-circle"></i>&nbsp;Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- add remove valuable -->

<script>
    $(document).ready(function() {

        $("#addButton").click(function() {

            var id = ($('.form-horizontal .control-group').length + 1).toString();
            $('.form-horizontal').append('<div class="control-group"><div class="row"><div class="col-md-6"><div class="form-group"><label class="control-label">Image</label><input type="file" class="form-control" name="valuable[' + (id - 1) + '][image]" required style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File"></div></div><div class="col-md-6"><div class="form-group"><label class="control-label">Name</label><input type="text" class="form-control" name="valuable[' + (id - 1) + '][name]" placeholder="Enter Name" required></div></div><div class="col-md-12"> <div class="form-group"> <label class="control-label">description</label> <textarea class="form-control" name="valuable[' + (id - 1) + '][description]" required placeholder="Enter description"></textarea> </div> </div></div></div>');

         $('.selectpicker').selectpicker('refresh');                                                                                                              
        });

        $("#removeButton").click(function() {
            if ($('.form-horizontal .control-group').length == 1) {
                Swal.fire("No more to remove");
                return false;
            }

            $(".form-horizontal .control-group:last").remove();
        });
    });
</script>

@endsection