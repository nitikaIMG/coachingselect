@extends('main')

@section('heading')
Coachings 
@endsection('heading')

@section('sub-heading')
Add Coaching
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CoachingController@view_coaching')}}" class="btn btn-sm btn-primary mx-1" data-toggle="tooltip" title="" data-original-title="View Coaching"><i class="fad fa-eye"></i>&nbsp; View Coaching</a>

<a href="{{ action('CoachingController@view_coaching_faculty', 'id='.$coaching_id) }}" class="btn btn-sm btn-primary mx-1" data-toggle="tooltip" title="" data-original-title="View Coaching Faculty"><i class="fad fa-eye"></i>&nbsp; View Coaching Faculty</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">
        <div class="row mx-0 w-100">
            <div class="col">Add Coaching ("{{ $coaching_name }}") (Faculty)</div>
            <div class="col-auto">
                <div class="row">
                    <div class="col-auto px-0">
                        <input type='button' value='Add More' id='addButton' class="btn btn-sm btn-outline-secondary font-weight-bold text-uppercase text-primary float-right mx-1" />
                    </div>
                    <div class="col-auto pl-1">
                        <input type='button' value='Remove' id='removeButton' class="btn btn-sm btn-outline-secondary font-weight-bold text-uppercase text-primary float-right mx-1" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">


                <form action="{{ action('CoachingController@add_faculty') }}" method="post" enctype="multipart/form-data" id="faculty">
                    @csrf

                    <input type="hidden" name="coaching_id" value="{{$coaching_id}}" required>

                    <div class="card-body p-0">


                        <div class="form-horizontal">
                            <div class="control-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Image</label>
                                            <input type="file" class="form-control" name="faculty[0][image]" style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <input type="text" required class="form-control" name="faculty[0][name]" placeholder="Enter Name" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Designation</label>
                                            <input type="text" class="form-control" name="faculty[0][designation]" placeholder="Enter designation">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Education</label>
                                            <input type="text" class="form-control" name="faculty[0][education]" placeholder="Enter education">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Experience</label>
                                            <input type="text" class="form-control" name="faculty[0][experience]" placeholder="Enter experience">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">linkedin Link</label>
                                            <input type="text" class="form-control" name="faculty[0][link]" placeholder="Enter linkedin link"
                                            onchange="return is_linkedin_url(this)"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12 text-right">
                        <button class="btn btn-sm btn-success" type="submit" form="faculty">
                        <i class="far fa-check-circle"></i>&nbsp;Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- add remove faculty -->

<script>
    $(document).ready(function() {

        $("#addButton").click(function() {

            var id = ($('.form-horizontal .control-group').length + 1).toString();
            $('.form-horizontal').append('<div class="control-group"><div class="row"><div class="col-md-4"><div class="form-group"><label class="control-label">Image</label><input type="file" class="form-control" name="faculty[' + (id - 1) + '][image]"  style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File"></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Name</label><input type="text" class="form-control" name="faculty[' + (id - 1) + '][name]" placeholder="Enter Name" required></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Designation</label><input type="text" class="form-control" name="faculty[' + (id - 1) + '][designation]" placeholder="Enter designation"></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">education</label><input type="text" class="form-control" name="faculty[' + (id - 1) + '][education]" placeholder="Enter education"></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Experience</label><input type="text" class="form-control" name="faculty[' + (id - 1) + '][experience]" placeholder="Enter experience"></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Linkedin Link</label><input type="text" class="form-control" name="faculty[' + (id - 1) + '][link]" placeholder="Enter Linkedin Link" onchange="return is_linkedin_url(this)"></div></div></div></div>');
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

<script>
    function is_linkedin_url(element) {
        
        if( ! element.value.includes('linkedin.com') ) {
            swal.fire({
                title: 'Alert',
                text: 'Please enter a valid linkedin link'
            });

            element.value = '';
        }
    }
</script>

@endsection