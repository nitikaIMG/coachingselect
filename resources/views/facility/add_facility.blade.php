@extends('main')

@section('heading')
Facilities
@endsection('heading')

@section('sub-heading')
Add Facility
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('FacilityController@view_facility')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View All Facility"><i class="fad fa-eye"></i>&nbsp; View</a>
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
    <div class="card-header">Add Facility</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="{{ action('FacilityController@add_facility') }}" method="post" enctype="multipart/form-data"
                    onsubmit="return verify_icon(this)"
                >
                    @csrf
                    <div class="card-body p-0">

                        <div class="row align-items-center">

                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Facility Type</label>
                                    <select name="type" id="type" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required>
                                        <option value="" disabled selected>Select Facility Type</option>
                                        <option value="online">Online</option>
                                        <option value="classroom">Classroom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-auto align-self-stretch">
                                <div class="row h-80px w-80px ml-0 align-items-center bg-primary rounded-10 text-white">
                                    <div class="col text-center" id="icon">
                                        <i class="fad fa-icons"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Facility Icon</label>
                                    <div class="input-group">
                                        <input type="text" name="image" required oninput="show_icon(this)" class="form-control" placeholder="Enter icon code" onchange="check_icon(this)">
                                        <div class="input-group-append">
                                            <a href="https://fontawesome.com/icons?d=gallery" class="btn btn-sm btn-primary" target="_blank"><i class="fad fa-icons"></i>&nbsp; All Icons</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Facility Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Facility Name" required>
                                </div>
                            </div>
                            <div class="col-auto align-self-end">
                                <button class="btn btn-sm btn-success my-3" type="submit" onclick="return is_image_selected()"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                        </div>

                    </div>
                </form>
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
        function show_icon(element) {

            if( element.value == '') {
                $('#icon').html(
                    '<i class="fad fa-icons"></i>'
                );
            } else {
                $('#icon').html(
                    element.value
                );
            }
        }
    </script>
    
    <script>
        function check_icon(element) {

            if(! element.value.includes('<i class=')) {
                swal.fire({
                    title: 'Invalid Icon',
                    text: 'Please enter a valid icon'
                });

                element.value = '';

                $('#icon').html('<i class="fad fa-icons"></i>');
            }
        }
    </script>
    
    <script>
        function verify_icon(form) {
            var image = form.image;
            var icon = form.image.value;

            check_icon(image);

            icon = $($.parseHTML(icon));
            
            var class_name = icon.attr('class');

            if(class_name != undefined) {

                var new_icon = '<i class="' + class_name + '"></i>';

                image.value = new_icon;
            } else {
                swal.fire({
                    title: 'Invalid Icon',
                    text: 'Please enter a valid icon'
                });

                image.value = '';

                $('#icon').html('<i class="fad fa-icons"></i>');

                return false;
            }
        }
    </script>
    @endsection