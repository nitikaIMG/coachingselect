@extends('main')

@section('heading')
Webinar
@endsection('heading')

@section('sub-heading')
Add Webinar
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('WebinarController@view_webinar')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View All Webinar"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">Add Webinar</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="{{ action('WebinarController@add_webinar') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-0">
                        <div class="row align-items-center">
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Meta Title</label>
                                    <input type="text" class="form-control" name="metatitle" placeholder="Enter Meta Title" >
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Meta Description</label>
                                    <textarea class="form-control" name="metadescription" placeholder="Enter Meta Description" ></textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Meta Keywords</label>
                                    <textarea class="form-control" name="metakeywords" placeholder="Enter Meta Keywords" ></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Webinar Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Enter Webinar Title" required>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Webinar Author</label>
                                    <input type="text" class="form-control" name="author" placeholder="Enter Webinar Author" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label">Date</label>
                                    <input type="text" class="form-control datetimepickerget" required name="date" placeholder="Enter Date">
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label">Time</label>
                                    <input type="time" class="form-control" required name="time" placeholder="Enter Time">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Select Option</label>
                                    
                                    <select 
                                    onchange="switch_between(this)"
                                    required
                                    name="type"
                                    class="form-control form-control-solid selectpicker show-tick switch mb-3" 
                                    data-id="0">
                                        <option value="">Select Url or Write Content</option>
                                        <option value="url">Url</option>
                                        <option value="content">Write Content</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12" style="display:none;" id="url_box">
                                <!-- <div class="col-md-12"> -->
                                    <div class="form-group">
                                        <label class="control-label">Url</label>
                                        <input type="url" class="form-control"
                                        name="url"
                                        id="url"
                                        placeholder="Enter URL">
                                    </div>
                                <!-- </div> -->
                            </div>
                            
                            <div class="col-md-12" style="display:none;" id="content_box">
                                    <div class="form-group">
                                        <label class="control-label">Write Content</label>

                                        <textarea 
                                        name="description"
                                        id="description"
                                        class="form-control ckeditor" placeholder="Enter description"></textarea>
                                    </div>
                            </div>
                                                        
                            <div class="col-auto align-self-end">
                                <button class="btn btn-sm btn-success my-3" type="submit"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function switch_between(element) {

            if(element.value == 'url') {  
                $('#url_box').show();
                $('#url').prop('required', true);
                $('#content_box').hide();
                $('#description').prop('required', false);
                $('#description').removeClass('required');
            } else {                
                $('#content_box').show();
                $('#description').addClass('required');
                $('#url_box').hide();
                $('#url').prop('required', false);
            }
        }
    </script>


    <script>
        CKEDITOR.replace( 'description', {
            filebrowserUploadUrl: "{{ action('BlogsController@ckeditor_image', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        
        CKEDITOR.instances.description.on("change", function() {

        });
        
    </script>
    @endsection