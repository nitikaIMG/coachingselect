@extends('main')

@section('heading')
Coachings
@endsection('heading')

@section('sub-heading')
Edit Coaching
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CoachingController@view_coaching')}}" class="btn btn-sm btn-primary mx-1" data-toggle="tooltip" title="" data-original-title="View Coaching"><i class="fad fa-eye"></i>&nbsp; View Coaching</a>
<a href="{{ action('CoachingController@view_coaching_centers_branches', 'id='.$coaching_id) }}" class="btn btn-sm btn-primary mx-1" data-toggle="tooltip" title="" data-original-title="View Coaching Branches"><i class="fad fa-eye"></i>&nbsp; View Coaching Branches</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">
        <div class="row mx-0 w-100">
            <div class="col">Edit Coaching Centers (Branch) of {{$coaching_name ?? ''}} Coaching</div>
        </div>
    </div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">

                
                <form action="{{ action('CoachingController@edit_coaching_centers_branches') }}" method="post" enctype="multipart/form-data" id="branch">
                    @csrf

                    <input type="hidden" name="id" value="{{$coaching_centers_branch->id}}" required>
                    <input type="hidden" name="coaching_id" value="{{$coaching_centers_branch->coaching_id}}" required>
                    <input type="hidden" name="coaching_centers_id" value="{{$coaching_centers_branch->coaching_centers_id}}" required>
                    
                    <div class="card-body p-0">

                        
                        <div class="form-horizontal">
                            <div class="control-group">
                                <div class="row">

                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Address</label>
                                            <input type="text" class="form-control address" name="branch[0][address]" placeholder="Enter address" required id="address0" data-element_id="0" value="{{$coaching_centers_branch->address ?? ''}}">
                                                    
                                            <input type="hidden" class="form-control" name="branch[0][latitude]" id="latitude0" value="{{$coaching_centers_branch->latitude ?? ''}}">
                                            <input type="hidden" class="form-control" name="branch[0][longitude]" id="longitude0" value="{{$coaching_centers_branch->longitude ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">Country</label>
                                            <select name="branch[0][country_id]" id="branch[0][country_id]" class="form-control selectpicker show-tick countries" data-width="full" data-container="body"
                                            data-live-search="true"
                                            required
                                            data-id="0"
                                            onchange="show_states(this)"
                                            >
                                                <option value="" selected disabled>Select Country</option>
                                                @if( !empty($countries) )
                                                @foreach($countries as $country)
                                                <option value="{{$country->id}}"
                                                <?php if ($coaching_centers_branch->country == $country->id) {
                                                    echo "selected";
                                                } ?>
                                                >{{$country->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">state</label>
                                            <select name="branch[0][state_id]" id="branch[0][state_id]" class="form-control selectpicker show-tick states" data-width="full" data-container="body"
                                            data-live-search="true"
                                            required
                                            data-id="0"
                                            data-dynamic_id="state_id_0"
                                            onchange="show_citys(this)"
                                            >
                                                <option value="" selected disabled>Select State</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">city</label>
                                            <select name="branch[0][city_id]" id="branch[0][city_id]" class="form-control selectpicker show-tick" data-width="full" data-container="body"
                                            data-live-search="true"
                                            required  
                                            data-id="0"                                          
                                            data-dynamic_id="city_id_0"
                                            >
                                                <option value="" selected disabled>Select City</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <input type="text" class="form-control" name="branch[0][name]" placeholder="Enter Name" required value="{{$coaching_centers_branch->name ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Mobile</label>
                                            <input  placeholder="Enter Mobile Number" class="form-control form-control-solid"
                                            autocomplete="off" onkeypress="return isNumberKey(event)" pattern="[789][0-9]{9}" minlength="10" maxlength="10" name="branch[0][mobile]" type="text" value="{{$coaching_centers_branch->mobile ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" class="form-control" name="branch[0][email]" placeholder="Enter email" value="{{$coaching_centers_branch->email ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Website Link</label>
                                            <input type="url" class="form-control" name="branch[0][website]" placeholder="Enter website link" value="{{$coaching_centers_branch->website ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Twitter Link</label>
                                            <input type="url" class="form-control" name="branch[0][twitter]" placeholder="Enter twitter link" value="{{$coaching_centers_branch->twitter ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Facebook Link</label>
                                            <input type="url" class="form-control" name="branch[0][facebook]" placeholder="Enter facebook link" value="{{$coaching_centers_branch->facebook ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Instagram Link</label>
                                            <input type="url" class="form-control" name="branch[0][instagram]" placeholder="Enter instagram link" value="{{$coaching_centers_branch->instagram ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Youtube Link</label>
                                            <input type="url" class="form-control" name="branch[0][youtube]" placeholder="Enter youtube link" value="{{$coaching_centers_branch->youtube ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Linkedin Link</label>
                                            <input type="url" class="form-control" name="branch[0][linkedin]" placeholder="Enter linkedin link" value="{{$coaching_centers_branch->linkedin ?? ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12 text-right">
                        <button class="btn btn-sm btn-success" type="submit" form="branch">
                        <i class="far fa-check-circle"></i>&nbsp;Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function show_citys(element) {
        var id = element.dataset.id;
        // alert(id);

        $.ajax({
            type: 'POST',
            url: '{{action("TestimonialsController@cities")}}',
            data: {
                state_id: element.value,
                _token: '{{csrf_token()}}'
            },
            success: function(data) {


                $('[data-dynamic_id="city_id_' + id + '"]').html(
                    '<option value="">Select city</option>'
                );

                data.forEach(city => {
                                     
                    var is_selected = '';

                    if("{{$coaching_centers_branch->city}}" == city.id) {
                        is_selected = 'selected';
                    }

                    $('[data-dynamic_id="city_id_' + id + '"]').append(
                        '<option value="' + city.id + '" ' + is_selected + '>' + city.name + '</option>'
                    );
                });

                $('[data-dynamic_id="city_id_' + id + '"]').selectpicker('refresh');
            }
        });
    }
</script>
<script>
    function show_states(element) {
        var id = element.dataset.id;
        $.ajax({
            type: 'POST',
            url: '{{action("TestimonialsController@states")}}',
            data: {
                country_id: element.value,
                _token: '{{csrf_token()}}'
            },
            success: function(data) {


                $('[data-dynamic_id="state_id_' + id + '"]').html(
                    '<option value="">Select state</option>'
                );

                data.forEach(state => {

                    var is_selected = '';

                    if("{{$coaching_centers_branch->state}}" == state.id) {
                        is_selected = 'selected';
                    }
                                        
                    $('[data-dynamic_id="state_id_' + id + '"]').append(
                        '<option value="' + state.id + '" ' + is_selected + '>' + state.name + '</option>'
                    );
                });

                $('[data-dynamic_id="state_id_' + id + '"]').selectpicker('refresh');

                var city = document.querySelector("select[id='branch[0][state_id]']");
                show_citys(city);
            }
        });
    }
</script>
<!-- google location -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ config('app.GOOGLE_MAPS_API_KEY') }}"></script>
    
<script>
    var input = document.getElementsByClassName('address');

    for (var x = 0; x < input.length; x++) {
        addListener(input[x]);
    }

    function addListener(el) {
        var id = el.dataset.element_id;

        var autocomplete = new google.maps.places.Autocomplete(el);

        google.maps.event.addListener(autocomplete, 'place_changed', function ()    {
        // Do whatever you want in here e.g.
        // var place = autocomplete.getPlace();
        });

        var places = new google.maps.places.Autocomplete(el);
        google.maps.event.addListener(places, 'place_changed', function (event) {
            // console.log(event);
            // console.log(places);
            // Get place info
            var place = places.getPlace();

            // Do whatever with the value!
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();

            geocodeLatLng(latitude,longitude, id);

            $('#latitude' + id).val(latitude);
            $('#longitude' + id).val(longitude);
        });

        var input = el;
        google.maps.event.addDomListener(input, 'keydown', function(event) { 
            if (event.keyCode === 13) { 
                event.preventDefault(); 
            }
        }); 
    }
</script>

<script>
    var city;
    var state;
    var country;

    function geocodeLatLng(lat, lng, id) {

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
                    $("select[id='branch["+id+"][country_id]'] option").filter(function() {
                        return this.text == country; 
                    }).prop('selected', true);

                    $("select[id='branch["+id+"][country_id]']").selectpicker('refresh');

                    $.ajax({
                        'type': 'POST',
                        'url': '<?php echo asset('/coaching_admin/get_allstate'); ?>',
                        'data': {
                            _token: "{{csrf_token()}}",
                            x: $("select[id='branch["+id+"][country_id]'] option:selected").val()
                        },
                        'success': function(data) {
                            $("select[id='branch["+id+"][state_id]']").html(data);
                            $("select[id='branch["+id+"][state_id]']").selectpicker('refresh');

                            // set state
                            $("select[id='branch["+id+"][state_id]'] option").filter(function() {
                                return this.text == state; 
                            }).prop('selected', true);

                            $("select[id='branch["+id+"][state_id]']").selectpicker('refresh');

                            $.ajax({
                                'type': 'POST',
                                'url': '<?php echo asset('/coaching_admin/get_allcity'); ?>',
                                'data': {
                                    _token: "{{csrf_token()}}",
                                    x: $("select[id='branch["+id+"][state_id]'] option:selected").val()
                                },
                                'success': function(data) {
                                    $("select[id='branch["+id+"][city_id]']").html(data);
                                    $("select[id='branch["+id+"][city_id]']").selectpicker('refresh');
                                            
                                    // set city
                                    $("select[id='branch["+id+"][city_id]'] option").filter(function() {
                                        return this.text == city; 
                                    }).prop('selected', true);
                                                    
                                    $("select[id='branch["+id+"][city_id]']").selectpicker('refresh');

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
    $(document).ready(
        function () {
            var state = document.querySelector("select[id='branch[0][country_id]']");
            show_states(state);
        }
    );
</script>
@endsection