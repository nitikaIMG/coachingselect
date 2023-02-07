@extends('main')

@section('heading')
Colleges
@endsection('heading')

@section('sub-heading')
Add College Videos
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CollegeController@view_colgvideo', $id)}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View All College"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">Add College Videos</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="{{ action('CollegeController@add_colgvideo',$id) }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="colgid" value="{{$id}}">
                    @csrf
                    <div id="formid">

                    </div>
                    <div class="card-body p-0">

                        <div class="row align-items-center">
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Videos </label>
                                    <input type="file" upload-pic="No Choosen File" class="form-control" name="videos[]" multiple required>
                                </div>
                            </div>
                            <div class="col-auto text-right align-self-end">
                                <button class="btn btn-sm btn-success my-3" type="submit"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>


    @endsection