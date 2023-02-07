@extends('main')

@section('heading')
States & Cities
@endsection('heading')

@section('sub-heading')
Edit City
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('StreamsController@view_stream')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View All City"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<style>
    #icon>.fas,
    #icon>.fa,
    #icon>.far,
    #icon>.fab,
    #icon>i {
        font-size: 50px !important;
    }
</style>



<div class="card">
    <div class="card-header">Edit City</div>

    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="{{ action('StatecityController@edit_city',$data->id) }}" method="post" enctype="multipart/form-data"
                                    >
                    @csrf
                    <div class="card-body p-0">

                        <div class="row align-items-center">
                            <div class="col-md align-self-stretch">
                                <div class="form-group">
                                    <label class="control-label">Country</label>
                                    <select class="form-control selectpicker show-tick" data-container="body" title="Select Country" name="country" id="country_id" data-width="full" data-live-search="true">
                                        <option value="">Select Country</option>
                                        <?php
                                        if (!empty($getallcountry->toarray())) {
                                          foreach ($getallcountry as $country) {
                                        ?>
                                            <option value="<?php echo $country->id; ?>" <?php if ($statedata->country_id == $country->id) {
                                                    echo "selected";
                                                } ?>>
                                              <?php echo ucwords($country->name); ?> </option>
                                        <?php
                                          }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="form-group">
                                    {{ Form::label('Select State','Select State',array('class'=>'text-bold'))}}
                                    <select class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" data-container="body" title="Select State" name="state_id" id="state_id" required="" >
                                        <option value="">Select State</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">City</label>
                                    <input type="text" class="form-control" value="{{$data->name}}" name="name" placeholder="Enter City Name" required>
                                </div>
                            </div>
                            <div class="col-md-auto align-self-end">
                                <button class="btn btn-sm btn-success my-3" type="submit"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function() {
        $('#country_id').change(function(e) {
            var x = document.getElementById("country_id").value;
            $.ajax({
                'type': 'POST',
                'url': '<?php echo asset('/coaching_admin/get_allstate'); ?>',
                'data': {
                    _token: "{{csrf_token()}}",
                    x: x
                },
                'success': function(data) {
                    $("#state_id").html(data);
                    $('#state_id').selectpicker('refresh');
                },
            });
        });
    });
</script>
 <script>
    $(document).ready(function() {
            var x = document.getElementById("country_id").value;
            var x1 = 1;
            $.ajax({
                'type': 'POST',
                'url': '<?php echo asset('/coaching_admin/get_allstate'); ?>',
                'data': {
                    _token: "{{csrf_token()}}",
                    x: x,
                    x1: x1,
                },
                'success': function(data) {
                    $("#state_id").html(data);
                    $('#state_id').selectpicker('refresh');
                },
            });
    });
</script>   
   
    @endsection