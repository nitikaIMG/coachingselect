@extends('main')

@section('heading')
Coachings
@endsection('heading')

@section('sub-heading')
Edit Coaching
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CoachingController@view_coaching')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View Coaching"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">Edit Coaching</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="{{ action('CoachingController@edit_coaching') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-0">

                        <input type="hidden" class="form-control" name="id" required value="{{$coaching->id}}">


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter name" required value="{{$coaching->name}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @php
                                    
                                    $image = asset('public/coaching/'. $coaching->image);

                                    if(! @GetImageSize($image) )
                                    $image = asset('public/logo.png');

                                    @endphp
                                    <label class="control-label">Image</label>
                                    <input type="file" class="form-control uploaded" style="--upload-pic:url({{$image}});" upload-pic="" name="image">
                                    
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Address </label>
                                    <input type="text" class="form-control" name="address" placeholder="Enter Address" value="{{$coaching->address}}" id="address" autocomplete="off">
                                    
                                    <input type="hidden" class="form-control" name="latitude" id="latitude" value="{{$coaching->latitude ?? ''}}">
                                    <input type="hidden" class="form-control" name="longitude" id="longitude" value="{{$coaching->longitude ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('Select Country','Select Country',array('class'=>'text-bold'))}}
                                    <select class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" data-container="body" title="Select Country" name="country_id" id="country_id" >
                                        <option value="">Select Country</option>
                                        @if(!empty($allcountry))
                                        @foreach($allcountry as $country)
                                        <option <?php if ($coaching->country_id == $country->id) {
                                                    echo "selected";
                                                } ?> value="{{$country->id}}"> {{$country->name}}
                                        </option>
                                        @endforeach
                                        @endif

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('Select State','Select State',array('class'=>'text-bold'))}}
                                    <select class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" data-container="body" title="Select State" name="state_id" id="state_id" >
                                        <option value="">Select State</option>
                                        @if(!empty($allstate))
                                        @foreach($allstate as $state)
                                        <option <?php if ($coaching->state_id == $state->id) {
                                                    echo "selected";
                                                } ?> value="{{$state->id}}"> {{$state->name}}
                                        </option>
                                        @endforeach
                                        @endif

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('Select City','Select City',array('class'=>'text-bold'))}}
                                    <select class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" title="Select City" name="city_id" id="city_id" value="" >
                                        <option id="city2" value="{{$coaching->city_id ?? ''}}">Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Offering</label>
                                    <select name="offering[]" id="offering" required class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" multiple>
                                        <option value="online" 
                                            @if( preg_match('/online/', $coaching->offering) )
                                                selected
                                            @endif
                                            >Online</option>
                                        <option value="classroom" 
                                            @if( preg_match('/classroom/', $coaching->offering) )
                                                selected
                                            @endif
                                            >Classroom</option>
                                        <option value="tutor" 
                                            @if( preg_match('/tutor/', $coaching->offering) )
                                                selected
                                            @endif
                                            >Tutor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Est yr</label>
                                    <select name="est_yr" id="est_yr"  class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                        <option value="" disabled selected>Select Est Year</option>
                                        
                                        @foreach(range(date('Y'), 1950) as $year)
                                            <option value="{{$year}}" 
                                                @if($coaching->est_yr == $year)
                                                selected
                                                @endif
                                            >{{$year}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea class="form-control ckeditor" name="description" 
                                    id="description"
                                    placeholder="Enter Description" >{{$coaching->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Scholarship</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control py-4" aria-label="Enter Scholarship" name="scholarship" maxlength="8" placeholder="Enter Scholarship"  oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" 
                                        onchange="return is_correct_percentage()"
                                        value="{{$coaching->scholarship}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text p-1">
                                                <select name="scholarship_type" id="scholarship_type"  class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" 
                                                onchange="return is_correct_percentage()">
                                                    <option value="per" @if($coaching->scholarship_type == 'per')
                                                        selected
                                                        @endif
                                                        >Per</option>
                                                    <option value="rs" @if($coaching->scholarship_type == 'rs')
                                                        selected
                                                        @endif
                                                        >Rs</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Avg Fees</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₹</span>
                                        </div>
                                        <input type="text" class="form-control py-4" aria-label="Enter Avg Fees" name="avg_fees" placeholder="Enter Avg Fees"  minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" value="{{$coaching->avg_fees}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Batch Size</label>
                                    <input type="text" class="form-control" name="batch_size" placeholder="Enter Batch Size"  maxlength="8" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" value="{{$coaching->batch_size}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Faculty Student Ratio</label>
                                    <input type="text" class="form-control py-4" aria-label="Enter Faculty Student Ratio" name="faculty_student_ratio" placeholder="Enter Faculty Student Ratio"  minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9:]/g,'');" type="tel" value="{{$coaching->faculty_student_ratio}}">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Is Paid Member</label>
                                    <select name="is_paid_member" id="is_paid_member"  class="form-control selectpicker show-tick" data-width="full" 
                                    required
                                    data-container="body" data-live-search="true">
                                        <option value="">Select Is Paid Member</option>
                                        <option value="yes" @if($coaching->is_paid_member == 'yes')
                                            selected
                                            @endif
                                            >Yes</option>
                                        <option value="no" @if($coaching->is_paid_member == 'no')
                                            selected
                                            @endif
                                            >No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Super Specialty</label>
                                    <input type="text" class="form-control" name="super_specialty" placeholder="Enter Super Specialty"  value="{{$coaching->super_specialty ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tagline</label>
                                    <input type="text" class="form-control" name="tagline" placeholder="Enter Tagline"  value="{{$coaching->tagline ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">No. of Branches</label>
                                    <input type="text" class="form-control" name="number_of_branches" placeholder="Enter No. of Branches"  maxlength="8" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" value="{{$coaching->number_of_branches ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Mobile</label>
                                    <input type="tel" class="form-control" name="mobile" minlength=10 maxlength=10 oninput="this.value=this.value.replace(/[^0-9]/g,'');" placeholder="Enter Mobile Number" pattern="[6789][0-9]{9}" value="{{$coaching->mobile}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{$coaching->email}}" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Enter Password" value="{{$coaching->decrypted_password}}">
                                    <label class="control-label">{{$coaching->decrypted_password}}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Is Verified</label>
                                    <select name="is_verified" id="is_verified"  class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                        <option value="">Select Is Verified</option>
                                        <option value="yes" @if($coaching->is_verified == 'yes')
                                            selected
                                            @endif
                                            >Yes</option>
                                        <option value="no" @if($coaching->is_verified == 'no')
                                            selected
                                            @endif
                                            >No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button class="btn btn-sm btn-success" type="submit"
                                onClick="return check_title_description_minimum_length()"
                                ><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <script>
        function check_title_description_minimum_length() {

        }
    </script>

    <script>
        
        CKEDITOR.instances.description.on("key", function() {

            var txt = CKEDITOR.instances.description.getData();
            
            if(txt.length > 3000) {
              swal.fire({
                title: 'Alert',
                'text': 'Limit Exceed'
              });

              return false;
            }
        });
    </script>
    
    <script>
        function check_ratio() {
            var faculty_student_ratio = $('input[name="faculty_student_ratio"]').val();

            if(! faculty_student_ratio.includes(':')) {
                swal.fire('Invalid faculty student ratio');

                $('input[name="faculty_student_ratio"]').val('');

                return false;
            }
            
            $('input[name="faculty_student_ratio"]').val(
                $('input[name="faculty_student_ratio"]').val().replace(' ', '')
            );

            if(
                faculty_student_ratio.split(':').length > 2
                ||
                faculty_student_ratio.split(':').length < 1
            ) {
               swal.fire('Invalid faculty student ratio');

                $('input[name="faculty_student_ratio"]').val('');

                return false; 
            }

            var is_correct = true;

            faculty_student_ratio.split(':').map(
                function(element) {
                    if(element == '') {
                        is_correct = false;
                    }
                }
            );

            if(! is_correct) {
                swal.fire('Invalid faculty student ratio');

                $('input[name="faculty_student_ratio"]').val('');

                return false;
            }
        }
    </script>
    
    <script>
        function is_correct_percentage() {
            var scholarship = $('input[name="scholarship"]').val();
            var scholarship_type = $('select[name="scholarship_type"]').val();

            if(scholarship_type == 'per') {


                if( !(scholarship >= 1 && scholarship <= 100) ) {
                    swal.fire('Invalid scholarship percentage');

                    $('input[name="scholarship"]').val('');

                    return false;
                }

            }
        }
    </script>
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
            $('#state_id').change(function(e) {
                var x = document.getElementById("state_id").value;
                $.ajax({
                    'type': 'POST',
                    'url': '<?php echo asset('/coaching_admin/get_allcity'); ?>',
                    'data': {
                        _token: "{{csrf_token()}}",
                        x: x
                    },
                    'success': function(data) {
                        $("#city_id").html(data);
                        $('#city_id').selectpicker('refresh');
                    },
                });
            });
        })

        var x = document.getElementById("state_id").value;
        var x1 = document.getElementById("city2").value;

        $.ajax({
            'type': 'POST',
            'url': '<?php echo asset('/coaching_admin/get_allcity'); ?>',
            'data': {
                _token: "{{csrf_token()}}",
                x: x,
                x1: x1
            },
            success: function(data) {
                $("#city_id").html(data);
            }
        });
    </script>
    <script>
        $(document).ready(
            function() {
                $('#offering').selectpicker({
                    maxOptions:2
                });
            }
        );
    </script>
    
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ config('app.GOOGLE_MAPS_API_KEY') }}"></script>

    <script type="text/javascript">
        var city;
        var state;
        var country;

        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('address'));
            google.maps.event.addListener(places, 'place_changed', function (event) {

                var place = places.getPlace();

                if (!place.geometry || !place.geometry.location) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // Do whatever with the value!
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();

                geocodeLatLng(latitude,longitude);

                $('#latitude').val(latitude);
                $('#longitude').val(longitude);
                
                $('#latitude').attr('value', latitude);
                $('#longitude').attr('value', longitude);

            });
        });

        var input = document.getElementById('address');
        google.maps.event.addDomListener(input, 'keydown', function(event) { 
            if (event.keyCode === 13) { 
                event.preventDefault(); 
            }
        }); 
    </script>

    <script>
        function geocodeLatLng(lat, lng) {

            var geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(lat, lng);
            
            geocoder.geocode({
                'latLng': latlng
            }, function(results, status) {
                if (status === 'OK') {
                    if (results[1]) {
                        console.log(results);
                        for (var i = 0; i < results[0].address_components.length; i++) {
                            for (var b = 0; b < results[0].address_components[i].types.length; b++) {
                                switch (results[0].address_components[i].types[b]) {
                                    case 'locality':
                                        city = results[0].address_components[i].long_name;
                                        break;
                                    case 'administrative_area_level_1':
                                        state = results[0].address_components[i].long_name;
                                        break;
                                    case 'country':
                                        country = results[0].address_components[i].long_name;
                                        break;
                                }
                            }
                        }
                        console.log('City = ' + city + ', ' + 'State = ' +  state + ', ' + 'Country = ' +  country);

                        // return {city, state, country};

                        // set country
                        $("#country_id option").filter(function() {
                            return this.text == country; 
                        }).prop('selected', true);

                        $('#country_id').selectpicker('refresh');

                        $.ajax({
                            'type': 'POST',
                            'url': '<?php echo asset('/coaching_admin/get_allstate'); ?>',
                            'data': {
                                _token: "{{csrf_token()}}",
                                x: $('#country_id option:selected').val()
                            },
                            'success': function(data) {
                                $("#state_id").html(data);
                                $('#state_id').selectpicker('refresh');

                                // set state
                                $("#state_id option").filter(function() {
                                    return this.text == state; 
                                }).prop('selected', true);

                                $('#state_id').selectpicker('refresh');

                                $.ajax({
                                    'type': 'POST',
                                    'url': '<?php echo asset('/coaching_admin/get_allcity'); ?>',
                                    'data': {
                                        _token: "{{csrf_token()}}",
                                        x: $('#state_id option:selected').val()
                                    },
                                    'success': function(data) {
                                        $("#city_id").html(data);
                                        $('#city_id').selectpicker('refresh');
                                                
                                        // set city
                                        $("#city_id option").filter(function() {
                                            return this.text == city; 
                                        }).prop('selected', true);
                                                        
                                        $('#city_id').selectpicker('refresh');

                                    },
                                });

                            },
                        });
                    } else {
                        alert("No results found");
                    }
                } else {
                    alert("Geocoder failed due to: " + status);
                }
            });
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
    
    <script>
        $(document).ready(function () {
        
            if( 
                window.location.href.toString().includes('profile') 
            ) {

            } else {
                setTimeout(() => {
                    $('input').attr("readonly", 'readonly');
                    $('input[readonly]').css("backgroundColor", 'transparent');
                    
                    $('input').attr("onfocus", "this.removeAttribute('readonly')");
                }, 100);
            }            
        });
   </script>
@endsection