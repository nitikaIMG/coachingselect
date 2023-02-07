@extends('main')

@section('heading')
    Advertisements
@endsection('heading')

@section('sub-heading')
    Edit Advertisement
@endsection('sub-heading')

@section('card-heading-btn')
    <a href="<?php echo action('AdvertisementController@view_advertisement'); ?>"
        class="btn btn-sm btn-light font-weight-bold text-uppercase mr-2 text-primary float-right" data-toggle="tooltip"
        title="View All Advertisement"><i class="fas fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

    <div class="card">
        <div class="card-header">Edit Advertisement</div>
        <?php $advertisement_id = $advertisement->id; ?>
        <form class="card-body"
            action="<?php echo action('AdvertisementController@update_advertisement', base64_encode(serialize($advertisement_id))); ?>"
            method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            @include('alert_msg')

            <div class="sbp-preview">
                <div class="sbp-preview-content">
                    <div class="row mx-0">
                        <div class="col-12">
                            <div class="form-group my-3">
                                <label for="job-title">Type*</label>
                                <select name="type" class="form-control form-control-solid selectpicker show-tick"
                                    data-container="body" data-live-search="true" title="Select Theme"
                                    data-hide-disabled="true" id="select_type">
                                    <option value="">Select Type</option>
                                    <option value="small" <?php if ($advertisement->type == 'small') {
                                        echo 'selected';
                                        } ?>>Small Size for sidebar</option>
                                    <option value="full" <?php if ($advertisement->type == 'full') {
                                        echo 'selected';
                                        } ?>>Full Size</option>
                                    <?php
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group my-3">
                                <label for="job-title">Select Coaching*</label>
                                <select name="coaching_id" class="form-control form-control-solid selectpicker show-tick"
                                    data-container="body" data-live-search="true" title="Select Coaching"
                                    data-hide-disabled="true" id="select_coaching">
                                    <option value="">Select Coaching</option>
                                    @if(!empty($advertisement->coaching_id))
                                    @foreach($data as $value)
                                    <option value="{{$value->id}}" <?php if ($advertisement->coaching_id == $value->id) {
                                        echo 'selected';
                                        } ?>>{{$value->name}}</option>
                                    @endforeach
                                    @else
                                    @foreach($data as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                @php

                                $image = asset('public/'. $advertisement->image);

                                if(! @GetImageSize($image) )
                                $image = asset('public/logo.png');

                                @endphp
                                <label class="control-label">Image</label>
                                <input type="file" class="form-control uploaded" style="--upload-pic:url({{$image}});" upload-pic="" name="image">
                            
                                <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                                
                                <p class="text-danger fs-12 mt-2">
                                    Note: 
                                    <br/>
                                    Small Ads: Image Resolution 350 X 290
                                    <br/>
                                    Full Ads: Image Resolution 1200 X 280 
                                </p>
                            </div>
                        </div>                            
                        
                        <div class="col-12">
                            <div class="form-group">
                                {{ Form::label('Link','Link',array('class'=>'control-label text-bold'))}}<br>
                                <input name="url" class="form-control form-control-solid " type="url" placeholder="Enter link: example=http://www.google.com" value="{{$advertisement->url ?? ''}}" required>
                            </div>
                        </div>
                        
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label">Start Date</label>
                                <input 
                                value="{{$advertisement->start_date ?? ''}}"
                                type="text" class="form-control datetimepickerget" name="start_date" placeholder="Enter Start Date">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label">End Date</label>
                                <input 
                                value="{{$advertisement->end_date ?? ''}}"
                                type="text" 
                                class="form-control datetimepickerget" name="end_date" placeholder="Enter End Date">
                            </div>
                        </div>
                        
                    </div>

                <div class="col-12 text-right mt-4 mb-2">
                    <button class="btn btn-sm btn-success text-uppercase"><i
                            class="far fa-check-circle"></i>&nbsp;Submit</button>
                </div>
            </div>
    </form>
    </div>

@endsection('content')
