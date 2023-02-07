@extends('main')

@section('heading')
Testimonials
@endsection('heading')

@section('sub-heading')
Add Testimonial
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('TestimonialsController@view_testimonial')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View all Testimonials"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">Add Testimonial</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="{{ action('TestimonialsController@add_testimonial') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-0">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <input type="file" class="form-control" style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File" name="image" required>
                                
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Stars</label>
                                    <input type="text" class="form-control" name="stars" placeholder="Enter Stars" required maxlength="3" onkeyup="return is_correct_stars()" onkeypress="return isNumberKey(event)">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Country</label>
                                    <select name="country" id="country_id" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required>
                                        <option value="" selected disabled>Select Country</option>
                                        @if( !empty($countries) )
                                        @foreach($countries as $country)
                                        <option value="{{$country->name}}">{{$country->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">State</label>
                                    <select name="state" id="state_id" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required>
                                        <option value="" selected disabled>Select State</option>
                                        @if( !empty($states) )
                                        @foreach($states as $state)
                                        <option value="{{$state->name}}">{{$state->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">City</label>
                                    <select name="city" id="city_id" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required>
                                        <option value="" selected disabled>Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Description</label>

                                    <textarea name="description"
                                    id="description"
                                     class="form-control ckeditor required" required placeholder="Enter description"></textarea>
                                </div>
                            </div>
                            <div class="col-12 text-right">
                                <button class="btn btn-sm btn-success" type="submit"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).on('change', '#country_id', function() {
            $.ajax({
                type: 'POST',
                url: '{{action("TestimonialsController@states")}}',
                data: {
                    country_id: $(this).val(),
                    _token: '{{csrf_token()}}'  
                },
                success: function(data) {

                    $('#state_id').html(
                        '<option value="">Select State</option>'
                    );

                    data.forEach(element => {
                        $('#state_id').append(
                            '<option value="' + element.name + '">' + element.name + '</option>'
                        );
                    });

                    $('#state_id').selectpicker('refresh');
                }
            });
        });
    </script>
    <script>
        $(document).on('change', '#state_id', function() {
            $.ajax({
                type: 'POST',
                url: '{{action("TestimonialsController@cities")}}',
                data: {
                    state_id: $(this).val(),
                    _token: '{{csrf_token()}}'  
                },
                success: function(data) {

                    $('#city_id').html(
                        '<option value="">Select City</option>'
                    );

                    data.forEach(element => {
                        $('#city_id').append(
                            '<option value="' + element.name + '">' + element.name + '</option>'
                        );
                    });

                    $('#city_id').selectpicker('refresh');
                }
            });
        });
    </script>

    <script>
        function is_correct_stars() {
            var stars = $('input[name="stars"]').val();
            
            if( !(stars <= 5) ) {
                // swal.fire('Invalid stars');

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