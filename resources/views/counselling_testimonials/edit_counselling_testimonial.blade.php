@extends('main')

@section('heading')
Counselling Testimonials
@endsection('heading')

@section('sub-heading')
Edit Counselling Testimonial
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CounsellingTestimonialsController@view_counselling_testimonial')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View all Counselling Testimonials"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')
<div class="card">
    <div class="card-header">Edit Testimonial</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="{{ action('CounsellingTestimonialsController@edit_counselling_testimonial') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{$testimonial->id}}">
                    <div class="card-body p-0">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{$testimonial->name}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @php

                                    $image = asset('public/counselling_testimonials/'. $testimonial->image);

                                    if(! @GetImageSize($image) )
                                    $image = asset('public/logo.png');

                                    @endphp
                                    <label class="control-label">Image</label>
                                    <input type="file" class="form-control uploaded" style="--upload-pic:url({{$image}});" upload-pic="" name="image">
                                
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Stars</label>
                                    <input type="text" class="form-control" name="stars" placeholder="Enter Stars" value="{{$testimonial->stars}}" required maxlength="3" onchange="return is_correct_stars()" onkeypress="return isNumberKey(event)">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Country</label>
                                    <select name="country" id="country_id" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required>
                                        <option value="" selected disabled> Select Country</option>
                                        @if( !empty($countries) )
                                        @foreach($countries as $country)
                                        <option <?php if ($testimonial->country == $country->name) {
                                                    echo "selected";
                                                } ?> value="{{$country->name}}"> {{$country->name}}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">State</label>
                                    <select name="state" id="state_id" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required>
                                        <option value="{{$testimonial->state}}" selected disabled>Select State</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">City</label>
                                    <select name="city" id="city_id" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required>
                                        <option value="{{$testimonial->city}}" selected disabled>Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Description</label>

                                    <textarea 
                                    name="description" 
                                    id="description" 
                                    class="form-control ckeditor" required 
                                    placeholder="Enter description">{{$testimonial->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button class="btn btn-sm btn-success" type="submit"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(
        function() {
            $('input[name="selectall"]').each(
                function() {
                    var id = $(this).attr('id');

                    var count = $('.' + id).length - 1;

                    var checked_checkbox = $('.' + id + ':checked').length;

                    if (checked_checkbox == count) {
                        $(this).prop('checked', true);
                    }
                }
            )
        }
    );
</script>
<script>
    function states() {

        $.ajax({
            type: 'POST',
            url: '{{action("TestimonialsController@states")}}',
            data: {
                country_id: $('#country_id').val(),
                _token: '{{csrf_token()}}'
            },
            success: function(data) {

                $('#state_id').html(
                    '<option value="">Select State</option>'
                );

                data.forEach(element => {

                    var state_id = '{{$testimonial->state}}';

                    var is_selected = '';
                    if (state_id == element.name) {
                        is_selected = 'selected';
                    }

                    $('#state_id').append(
                        '<option value="' + element.name + '" ' + is_selected + '>' + element.name + '</option>'
                    );
                });

                $('#state_id').selectpicker('refresh');
                cities();
            }
        });
    }

    states();

    $(document).on('change', '#country_id', function() {
        states();
    });
</script>
<script>
    function cities() {

        $.ajax({
            type: 'POST',
            url: '{{action("TestimonialsController@cities")}}',
            data: {
                state_id: $('#state_id').val(),
                _token: '{{csrf_token()}}'
            },
            success: function(data) {

                $('#city_id').html(
                    '<option value="">Select City</option>'
                );

                data.forEach(element => {

                    var city_id = '{{$testimonial->city}}';

                    var is_selected = '';
                    if (city_id == element.name) {
                        is_selected = 'selected';
                    }

                    $('#city_id').append(
                        '<option value="' + element.name + '" ' + is_selected + '>' + element.name + '</option>'
                    );
                });

                $('#city_id').selectpicker('refresh');
            }
        });
    }

    // cities();

    $(document).on('change', '#state_id', function() {
        cities();
    });
</script>

    <script>
        function is_correct_stars() {
            var stars = $('input[name="stars"]').val();
            
            if( !(stars >= 0.5 && stars <= 5) ) {
                swal.fire('Invalid stars');

                $('input[name="stars"]').val('');

                return false;
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