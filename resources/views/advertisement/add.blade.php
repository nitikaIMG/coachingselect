@extends('main')

@section('heading')
    Advertisements
@endsection('heading')

@section('sub-heading')
    Add New Advertisement
@endsection('sub-heading')

@section('card-heading-btn')
<a  href="<?php echo action('AdvertisementController@view_advertisement') ?>" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="View All Advertisement"><i class="fa fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')


<div class="card">
    <div class="card-header">Add New Advertisement</div>
      {{ Form::open(array('action' => 'AdvertisementController@add_advertisement', 'method' => 'post','id' => 'j-forms','class'=>'j-forms','enctype'=>'multipart/form-data'))}}

          {{csrf_field()}}

        @include('alert_msg')

        <div class="card-body">
            <div class="sbp-preview">
                <div class="sbp-preview-content p-2">
                    <div class="row mx-0">
                        <div class="col-12">
                            <div class="form-group my-3">
                                <label for="type">Type*</label>
                                <select name="type" class="form-control form-control-solid selectpicker show-tick" data-container="body" data-live-search="true" title="Select Type" data-hide-disabled="true" required >
                                    <option value="">Select Type</option>
                                    <option value="small">Small Size for sidebar</option>
                                    <option value="full">Full Size</option>
                                  </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group my-3">
                                <label for="coaching_id">Select Coaching*</label>
                                <select name="coaching_id" class="form-control form-control-solid selectpicker show-tick" data-container="body" data-live-search="true" title="Select Coaching " data-hide-disabled="true">
                                    <option value="">Select Coaching</option>
                                    @foreach($data as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>

                        
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label">Image</label>
                                <input type="file" class="form-control" style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File" name="image" required>
                                
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
                            <div class="form-group" id="link">
                                {{ Form::label('Link','Link',array('class'=>'control-label text-bold'))}}<br>
                                <input name="url" class="form-control form-control-solid " type="url" placeholder="Enter link: example=http://www.google.com" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label">Start Date</label>
                                <input type="text" class="form-control datetimepickerget" name="start_date" placeholder="Enter Start Date">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label">End Date</label>
                                <input type="text" 
                                class="form-control datetimepickerget" name="end_date" placeholder="Enter End Date">
                            </div>
                        </div>
                        <div class="col-12 text-right mt-4 mb-2">
                          <button class="btn btn-sm btn-success text-uppercase"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}
</div>

@endsection('content')
