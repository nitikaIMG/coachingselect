@extends('main')

@section('heading')
Coachings
@endsection('heading')

@section('sub-heading')
Add Coaching
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CoachingController@view_coaching')}}" class="btn btn-sm btn-primary mx-1" data-toggle="tooltip" title="" data-original-title="View Coaching"><i class="fad fa-eye"></i>&nbsp; View Coaching</a>
<a href="{{ action('CoachingController@view_coaching_videos', 'id='.$coaching_id) }}" class="btn btn-sm btn-primary mx-1" data-toggle="tooltip" title="" data-original-title="View Coaching Videos"><i class="fad fa-eye"></i>&nbsp; View Coaching Videos</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">
        <div class="row mx-0 w-100">
            <div class="col">Add Coaching ("{{ $coaching_name }}") (Videos)</div>
            <div class="col-auto">
                <div class="row">
                    <div class="col-auto px-0">
                        <input type='button' value='Add More' id='addButton' class="btn btn-sm btn-outline-primary font-weight-bold text-uppercase text-primary float-right" />
                    </div>
                    <div class="col-auto pl-1">
                        <input type='button' value='Remove' id='removeButton' class="btn btn-sm btn-outline-primary font-weight-bold text-uppercase text-primary float-right"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">


                <form action="{{ action('CoachingController@add_videos') }}" method="post" enctype="multipart/form-data" id="videos">
                    @csrf

                    <input type="hidden" name="coaching_id" value="{{$coaching_id}}" required>

                    <div class="card-body p-0">

                        <div class="form-horizontal">
                            <div class="control-group">

                                <div class="row add-mores">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Video</label>
                                            <input type="url" class="form-control" name="videos[0][video]" required placeholder="Enter youtube video embed url">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Title</label>
                                            <input type="text" class="form-control" name="videos[0][title]" placeholder="Enter title">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <button class="btn btn-sm btn-success" type="submit" form="videos">
                            <i class="far fa-check-circle"></i>&nbsp;Submit</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- add remove videos -->

<script>
    $(document).ready(function() {

        $("#addButton").click(function() {

            var id = ($('.form-horizontal .control-group').length + 1).toString();
            $('.form-horizontal').append('<div class="control-group"><div class="row"><div class="col-md-6"><div class="form-group"><label class="control-label">Video</label><input type="url" class="form-control" name="videos[' + (id - 1) + '][video]" required placeholder="Enter youtube video embed url"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label class="control-label">Title</label> <input type="text" class="form-control" name="videos[' + (id - 1) + '][title]" placeholder="Enter title"> </div> </div> </div></div>');
            
            CKEDITOR.replace('videos[' + (id - 1) + '][description]');
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