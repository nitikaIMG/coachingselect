@extends('main')

@section('heading')
Coachings
@endsection('heading')

@section('sub-heading')
Add Coaching
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CoachingController@view_coaching')}}" class="btn btn-sm btn-primary mx-1" data-toggle="tooltip" title="" data-original-title="View Coaching"><i class="fad fa-eye"></i>&nbsp; View Coaching</a>
<a href="{{ action('CoachingController@view_coaching_results', 'id='.$coaching_id) }}" class="btn btn-sm btn-primary mx-1" data-toggle="tooltip" title="" data-original-title="View Coaching Results"><i class="fad fa-eye"></i>&nbsp; View Coaching Results</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">
        <div class="row mx-0 w-100">
            <div class="col">Add Coaching ("{{ $coaching_name }}") (Results)</div>
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


                <form action="{{ action('CoachingController@add_results') }}" method="post" enctype="multipart/form-data" id="results">
                    @csrf

                    <input type="hidden" name="coaching_id" value="{{$coaching_id}}" >

                    <div class="card-body">

                        <div class="form-horizontal">
                            <div class="control-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Course</label>
                                            <select class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true"  name="results[0][coaching_courses_id]" required>
                                                <option value="">Select Course</option>
                                                @if( !empty($coaching_courses) )
                                                @foreach($coaching_courses as $coaching_course)
                                                <option value="{{$coaching_course->id}}">{{$coaching_course->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Image</label>
                                            <input type="file" class="form-control" name="results[0][image]"  style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <input type="text" class="form-control" name="results[0][name]" placeholder="Enter Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Rank</label>
                                            <input type="text" class="form-control" name="results[0][rank]" placeholder="Enter Rank">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Category</label>
                                            <input type="text" class="form-control" name="results[0][category]" placeholder="Enter Category">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Year</label>
                                            <select name="results[0][year]" id="results[0][year]"  class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                                <option value="" disabled selected>Select Year</option>
                                                
                                                @foreach(range(date('Y'), 1970) as $year)
                                                    <option value="{{$year}}">{{$year}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12 text-right">
                        <button class="btn btn-sm btn-success" type="submit" form="results">
                        <i class="far fa-check-circle"></i>&nbsp;Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- add remove results -->

<script>
    $(document).ready(function() {

        $("#addButton").click(function() {

            var id = ($('.form-horizontal .control-group').length + 1).toString();
            $('.form-horizontal').append('<div class="control-group"><div class="row"><div class="col-md-4"><div class="form-group"><label class="control-label">Course</label><select class="form-control" required required name="results[' + (id - 1) + '][coaching_courses_id]"><option value="">Select Course</option><?php if (!empty($coaching_courses)) { foreach ($coaching_courses as $coaching_course) { ?><option value="<?php echo $coaching_course->id; ?>"><?php echo $coaching_course->name; ?></option><?php }} ?></select> </div> </div><div class="col-md-4"><div class="form-group"><label class="control-label">Image</label><input type="file" class="form-control" name="results[' + (id - 1) + '][image]"  style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File"></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Name</label><input type="text" class="form-control" name="results[' + (id - 1) + '][name]" placeholder="Enter Name" required></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Rank</label><input type="text" class="form-control" name="results[' + (id - 1) + '][rank]" placeholder="Enter Rank"></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Category</label><input type="text" class="form-control" name="results[' + (id - 1) + '][category]" placeholder="Enter Category"> </div> </div> <div class="col-md-4"><div class="form-group"><label class="control-label">Year</label><select name="results[' + (id - 1) + '][year]" id="results[' + (id - 1) + '][year]"  class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true"><option value="" disabled selected>Select Year</option><?php foreach(range(date('Y'), 1970) as $year) { ?><option value="<?php echo $year; ?>"><?php echo $year; ?></option><?php } ?></select></div></div></div></div>');

            $('select').selectpicker('refresh');

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