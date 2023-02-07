@extends('main')

@section('heading')
Courses
@endsection('heading')

@section('sub-heading')
Add Course
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CoursesController@view_course')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View All Courses"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">Add Course</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="{{ action('CoursesController@add_course') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <?php
                    $stream_id = "";
                    if (isset($_GET['stream_id'])) {
                        $stream_id = $_GET['stream_id'];
                    }
                    ?>
                    <div class="card-body p-0">

                        <div class="row align-items-center">
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Stream</label>
                                    <select name="stream_id" data-width="full" data-container="body" data-live-search="true" id="stream_id" class="form-control selectpicker show-tick" required>
                                        <option value="">Select Stream</option>
                                        @if( !empty($streams) )
                                        @foreach($streams as $stream)
                                        <option value="{{$stream->id}}" @if($stream->id == $stream_id)
                                            selected
                                            @endif
                                            >{{$stream->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Type</label>
                                    <select name="type" data-width="full" data-container="body" data-live-search="true" id="type" class="form-control selectpicker show-tick" required>
                                        <option value="">Select Type</option>
                                        <option value="coaching">Coaching</option>
                                        <option value="college">College</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Course Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Course Name" required>
                                </div>
                            </div>
                            <div class="col-md-auto align-self-end">
                                <button class="btn btn-sm my-3 btn-success" type="submit"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    @endsection