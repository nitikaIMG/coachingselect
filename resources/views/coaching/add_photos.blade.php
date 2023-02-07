@extends('main')

@section('heading')
Coachings
@endsection('heading')

@section('sub-heading')
Add Coaching
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CoachingController@view_coaching')}}" class="btn btn-sm btn-primary mx-1" data-toggle="tooltip" title="" data-original-title="View Coaching"><i class="fad fa-eye"></i>&nbsp; View Coaching</a>
<a href="{{ action('CoachingController@view_coaching_photos', 'id='.$coaching_id) }}" class="btn btn-sm btn-primary mx-1" data-toggle="tooltip" title="" data-original-title="View Coaching Photos"><i class="fad fa-eye"></i>&nbsp; View Coaching Photos</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">Add Coaching ("{{ $coaching_name }}") (Photos)</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">


                <form action="{{ action('CoachingController@add_photos') }}" method="post" enctype="multipart/form-data" id="photos">
                    @csrf

                    <input type="hidden" name="coaching_id" value="{{$coaching_id}}" required>

                    <div class="card-body p-0">

                        <div class="row align-items-center">
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Image (Single/Multiple)</label>
                                    <input type="file" class="form-control" name="image[]" multiple="true" style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File" required id="file-input1">
                                    <a  data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-info mt-1 float-right text-white d-none" id="view_photos_id"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            
                            <div class="col-auto align-self-end">
                                <button class="btn btn-sm my-3 btn-success" type="submit" form="photos">
                                <i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection