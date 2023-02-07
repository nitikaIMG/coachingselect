@extends('main')

@section('heading')
Coachings
@endsection('heading')

@section('sub-heading')
Add Coaching
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
            <div class="col">Add Coaching Centers (Branch) of {{$coaching_name ?? ''}} Coaching</div>
            <div class="col-auto">
                <div class="row">
                    <div class="col-auto px-0">
                        <input type='button' value='Add More' id='addButton' class="btn btn-sm btn-outline-primary font-weight-bold text-uppercase text-primary float-right" />
                    </div>
                    <div class="col-auto pl-1">
                        <input type='button' value='Remove' id='removeButton' class="btn btn-sm btn-outline-primary font-weight-bold text-uppercase text-primary float-right" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">

                
                <form action="{{ action('CoachingController@add_branch') }}" method="post" enctype="multipart/form-data" id="branch">
                    @csrf

                    <input type="hidden" name="coaching_id" value="{{$coaching_id}}" required>
                    
                    <div class="card-body p-0">

                        
                        <div class="form-horizontal">
                            <div class="control-group">
                                <div class="row">

                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Address</label>
                                            <input type="text" class="form-control address" name="branch[0][address]" placeholder="Enter address" required id="address0" data-element_id="0">
                                                    
                                            <input type="hidden" class="form-control" name="branch[0][latitude]" id="latitude0">
                                            <input type="hidden" class="form-control" name="branch[0][longitude]" id="longitude0">
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
                                                <option value="{{$country->name}}">{{$country->name}}</option>
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
                                            <input type="text" class="form-control" name="branch[0][name]" placeholder="Enter Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Mobile</label>
                                            <input placeholder="Enter Mobile Number" class="form-control form-control-solid"
                                            autocomplete="off" onkeypress="return isNumberKey(event)" pattern="[789][0-9]{9}" minlength="10" maxlength="10" name="branch[0][mobile]" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" class="form-control" name="branch[0][email]" placeholder="Enter email" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Website Link</label>
                                            <input type="url" class="form-control" name="branch[0][website]" placeholder="Enter website link">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Twitter Link</label>
                                            <input type="url" class="form-control" name="branch[0][twitter]" placeholder="Enter twitter link">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Facebook Link</label>
                                            <input type="url" class="form-control" name="branch[0][facebook]" placeholder="Enter facebook link">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Instagram Link</label>
                                            <input type="url" class="form-control" name="branch[0][instagram]" placeholder="Enter instagram link">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Youtube Link</label>
                                            <input type="url" class="form-control" name="branch[0][youtube]" placeholder="Enter youtube link">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Linkedin Link</label>
                                            <input type="url" class="form-control" name="branch[0][linkedin]" placeholder="Enter linkedin link">
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


<!-- add remove branch -->

<script>
    $(document).ready(function() {

        $("#addButton").click(function() {

            var id = ($('.form-horizontal .control-group').length + 1).toString();
            $('.form-horizontal').append(`<div class="control-group"><div class="row">
            <div class="col-md-12"><div class="form-group"><label class="control-label">Address</label><input type="text" class="form-control address" name="branch[${(id - 1)}][address]" placeholder="Enter address" required id="address${(id - 1)}" data-element_id="${(id - 1)}"><input type="hidden" class="form-control" name="branch[${(id - 1)}][latitude]" id="latitude${(id - 1)}"><input type="hidden" class="form-control" name="branch[${(id - 1)}][longitude]" id="longitude${(id - 1)}"></div></div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Country</label>
                                <select name="branch[${(id - 1)}][country_id]" id="branch[${(id - 1)}][country_id]" class="form-control selectpicker show-tick countries" data-width="full" data-container="body"
                                data-live-search="true"
                                required
                                data-id="${(id - 1)}"
                                onchange="show_states(this)"
                                >
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
                                <label class="control-label">state</label>
                                <select name="branch[${(id - 1)}][state_id]" id="branch[${(id - 1)}][state_id]" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required
                    
                                data-id="${(id - 1)}"
                                data-dynamic_id="state_id_${(id - 1)}"
                                onchange="show_citys(this)"
                                >
                                    <option value="" selected disabled>Select state</option>                                    
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">city</label>
                                <select name="branch[${(id - 1)}][city_id]" id="branch[${(id - 1)}][city_id]" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required                              
                                
                                data-id="${(id - 1)}"
                                data-dynamic_id="city_id_${(id - 1)}">
                                    <option value="" selected disabled>Select city</option>
                                </select>
                            </div>
                        </div>` + '<div class="col-md-4"><div class="form-group"><label class="control-label">Name</label><input type="text" class="form-control" name="branch[' + (id - 1) + '][name]" placeholder="Enter Name" required></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Mobile</label><input class="form-control" name="branch[' + (id - 1) + '][mobile]" placeholder="Enter mobile"  autocomplete="off" onkeypress="return isNumberKey(event)" pattern="[789][0-9]{9}" minlength="10" maxlength="10" name="branch[0][mobile]" type="text"></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Email</label><input type="email" class="form-control" name="branch[' + (id - 1) + '][email]" placeholder="Enter email" ></div></div><div class="col-md-4"><div class="form-group"><label class="control-label">Website Link</label><input type="url" class="form-control" name="branch[' + (id - 1) + '][website]" placeholder="Enter website Link" ></div></div>'+
                        `                
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Twitter Link</label>
                                <input type="url" class="form-control" name="branch[${(id - 1)}][twitter]" placeholder="Enter twitter link">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Facebook Link</label>
                                <input type="url" class="form-control" name="branch[${(id - 1)}][facebook]" placeholder="Enter facebook link">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Instagram Link</label>
                                <input type="url" class="form-control" name="branch[${(id - 1)}][instagram]" placeholder="Enter instagram link">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Youtube Link</label>
                                <input type="url" class="form-control" name="branch[${(id - 1)}][youtube]" placeholder="Enter youtube link">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Linkedin Link</label>
                                <input type="url" class="form-control" name="branch[${(id - 1)}][linkedin]" placeholder="Enter linkedin link">
                            </div>
                        </div>
                        `
                        +'</div></div>');

                        $('.selectpicker').selectpicker('refresh');

                        var address = document.getElementById('address' + (id - 1));

                        addListener(address);


        });

        $("#removeButton").click(function() {
            if ($('.form-horizontal .control-group').length == 1) {
                Swal.fire("No more to remove");
                return false;
            }

            $(".form-horizontal .control-group:last").remove();
        });
    });
</script>

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
                                        
                    $('[data-dynamic_id="city_id_' + id + '"]').append(
                        '<option value="' + city.name + '">' + city.name + '</option>'
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
        // alert(id);
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
                                        
                    $('[data-dynamic_id="state_id_' + id + '"]').append(
                        '<option value="' + state.name + '">' + state.name + '</option>'
                    );
                });

                $('[data-dynamic_id="state_id_' + id + '"]').selectpicker('refresh');
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

                    // set country
                    $("select[id='branch["+id+"][country_id]'] option").filter(function() {
                        return this.text == country; 
                    }).prop('selected', true);

                    $("select[id='branch["+id+"][country_id]']").selectpicker('refresh');

                    console.log(
                        $("select[id='branch["+id+"][country_id]']")
                    );

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
@endsection