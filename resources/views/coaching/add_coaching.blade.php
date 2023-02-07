@extends('main')

@section('heading')
Coachings
@endsection('heading')

@section('sub-heading')
Add Coaching
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CoachingController@view_coaching')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View Coaching"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">Add Coaching (General Information)</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">


                <form action="{{ action('CoachingController@add_coaching') }}" method="post" enctype="multipart/form-data" id="coaching">
                    @csrf

                    <div class="card-body p-0">

                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Coaching Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter coaching name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <input type='file' name="image" id="image" accept=".png" upload-pic="No Choosen File" class="form-control" />
                                    
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Address </label>
                                    <input type="text" class="form-control" name="address" placeholder="Enter Address" id="address">
                                    <input type="hidden" class="form-control" name="latitude" id="latitude">
                                    <input type="hidden" class="form-control" name="longitude" id="longitude">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('Select Country','Select Country',array('class'=>'text-bold'))}}
                                    <select class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" title="Select Country" name="country_id" id="country_id">
                                        <option value="" disabled>Select Country</option>
                                        @if(!empty($allcountry))
                                        @foreach($allcountry as $country)
                                        <option value="{{$country->id}}"> {{$country->name}} </option>
                                        @endforeach
                                        @endif

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('Select State','Select State',array('class'=>'text-bold'))}}
                                    <select class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" title="Select State" name="state_id" id="state_id">
                                        <option value="" disabled>Select State</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('Select City','Select City',array('class'=>'text-bold'))}}
                                    <select class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" title="Select City" name="city_id" id="city_id">
                                        <option value="" disabled>Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Offering</label>
                                    <select name="offering[]" id="offering" required class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" multiple>
                                        <option value="online">Online</option>
                                        <option value="classroom">Classroom</option>
                                        <option value="tutor">Tutor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Est yr</label>
                                    <select name="est_yr" id="est_yr"  class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                        <option value="" disabled selected>Select Est Year</option>
                                        
                                        @foreach(range(date('Y'), 1950) as $year)
                                            <option value="{{$year}}">{{$year}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea class="form-control ckeditor" name="description" 
                                    id="description"
                                    placeholder="Enter Description" ></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Scholarship</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control py-4" aria-label="Enter Scholarship" name="scholarship" placeholder="Enter Scholarship" 
                                        onchange="return is_correct_percentage()"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'');" maxlength="8" type="tel">
                                        <span class="input-group-text p-1">
                                            <select name="scholarship_type" id="scholarship_type"  class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" 
                                            onchange="return is_correct_percentage()">
                                                <option value="per"
                                                >Per</option>
                                                <option value="rs"
                                                >Rs</option>
                                            </select>
                                        </span>
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
                                        <input type="text" class="form-control py-4" aria-label="Enter Avg Fees" name="avg_fees" placeholder="Enter Avg Fees"  minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel">
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Batch Size</label>
                                    <input type="text" class="form-control" name="batch_size" placeholder="Enter Batch Size"  maxlength="8" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Faculty Student Ratio</label>
                                        <input type="text" class="form-control py-4" aria-label="Enter Faculty Student Ratio" name="faculty_student_ratio" placeholder="Enter Faculty Student Ratio"  minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9:]/g,'');" type="tel">
              
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Is Paid Member</label>
                                    <select name="is_paid_member" id="is_paid_member" required class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                        <option value="">Select Is Paid Member</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Super Specialty</label>
                                    <input type="text" class="form-control" name="super_specialty" placeholder="Enter Super Specialty">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tagline</label>
                                    <input type="text" class="form-control" name="tagline" placeholder="Enter Tagline" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">No. of Branches</label>
                                    <input type="text" class="form-control" name="number_of_branches" placeholder="Enter No. of Branches"  maxlength="8" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Mobile</label>
                                    <input type="tel" class="form-control" name="mobile" minlength=10 maxlength=10 oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" placeholder="Enter Mobile Number" pattern="[6789][0-9]{9}" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter Email" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Enter Password" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Is Verified</label>
                                    <select name="is_verified" id="is_verified" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                        <option value="">Select Is Verified</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button 
                                class="btn btn-sm btn-success" type="submit"
                                form="coaching"
                                onClick="return check_title_description_minimum_length()"
                                >
                                <i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function is_image_selected() {
        if (
            $('input[name="image"]').val() == ''
        ) {
            Swal.fire('Image is required');
            return false;
        }
    }
</script>


    <script>
        function check_title_description_minimum_length() {
            
            var modals = [];

            if(CKEDITOR.instances.description.getData() != '') {

                if(
                    $.trim(CKEDITOR.instances.description.getData()).length < 250
                ) {
                    
                    if(
                        $.trim(CKEDITOR.instances.description.getData()).length < 250
                    ) {
                        modals.push({
                            title: 'Alert',
                            text: 'Description should be minimum of 250 characters'
                        });
                    }

                    swal.queue(modals);
                    return false;
                }

                return true;
            }

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
    function show_citys(element) {
        var id = element.dataset.id;

        $.ajax({
            type: 'POST',
            url: '{{action("TestimonialsController@cities")}}',
            data: {
                state_id: element.value,
                _token: '{{csrf_token()}}'
            },
            success: function(data) {


                $('[data-id="city_id_' + id + '"]').html(
                    '<option value="">Select city</option>'
                );

                data.forEach(city => {
                                        
                    $('[data-id="city_id_' + id + '"]').append(
                        '<option value="' + city.id + '">' + city.name + '</option>'
                    );
                });

                $('[data-id="city_id_' + id + '"]').selectpicker('refresh');
            }
        });
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