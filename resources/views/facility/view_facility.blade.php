@extends('main')

@section('heading')
Facilities
@endsection('heading')

@section('sub-heading')
View Facility
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('FacilityController@add_facility')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="Add Facility"><i class="fas fa-plus"></i>&nbsp; Add</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<style>
    td>.fas,
    td>.fa,
    td>.far,
    td>.fab,
    td>i {
        font-size: 50px !important;
    }
</style>

<div class="card mb-3">
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="" method="get" id="search">
                    <?php
                    $name = "";

                    if (isset($_GET['name'])) {
                        $name = $_GET['name'];
                    }

                    $type = "";

                    if (isset($_GET['type'])) {
                        $type = $_GET['type'];
                    }

                    ?>
                    <div class="form-body">
                        <div class="row align-items-center">
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Facility Type</label>
                                    <select name="type" id="type" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                        <option value="" selected>Select Type</option>
                                        <option value="online" @if($type=='online' ) selected @endif>Online</option>
                                        <option value="classroom" @if($type=='classroom' ) selected @endif>Classroom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Facility Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Search by name" id="name" autocomplete="off" value="<?php echo $name; ?>">
                                </div>
                            </div>
                            <div class="col-auto align-self-end">
                                <button class="btn my-3 btn-sm btn-sm btn-sm btn-success text-uppercase"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                            <div class="col-auto align-self-end">
                                <a href="{{action('FacilityController@view_facility')}}" class="btn my-3 btn-sm btn-sm btn-sm btn-warning text-uppercase"><i class="far fa-undo"></i>&nbsp; Reset</a>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">View Facility</div>
    <div class="card-body">

        <div class="datatable table-responsive">
            <table class="table table-bordered table-striped table-hover text-nowrap" id="view_facility_dt" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Facility Type</th>
                        <th>
                            Icon</th>
                        <th>
                            Facility Name</th>
                        <th>
                            Action</th>

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Facility Type</th>
                        <th>
                            Icon</th>
                        <th>
                            Facility Name</th>
                        <th>
                            Action</th>

                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var name = $('#name').val();
        var type = $('#type').val();
        $.fn.dataTable.ext.errMode = 'none';
        $('#view_facility_dt').DataTable({
            "processing": true,
            "serverSide": true,

            "ajax": {
                "url": "<?php echo action('FacilityController@view_facility_dt'); ?>?name=" + name + "&type=" + type,
                "datatype": "json",
                "type": "POST",
                "data": {
                    _token: "{{csrf_token()}}"
                }
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "type"
                },
                {
                    "data": "image"
                },
                {
                    "data": "name"
                },
                {
                    "data": "action"
                }
            ],
            "dom": 'lBfrtip',
            buttons: [               
                {
                    extend: 'csvHtml5',
                    text: 'Download EXCEL Data',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
            ],
            "lengthMenu": [[25, 50,100,1000,10000,100000 ], [25, 50,100,1000,10000,100000]],
        });
        $("#view_facility_dt_length").hide();
        $("#view_facility_dt_filter").hide();
    });
</script>


<script>
    $('.alert').delay(3000).fadeOut();
</script>

<script>
    function show_icon(id, element) {
        if( element.value == '') {
            $('#icon' + id).html(
                '<i class="fad fa-icons"></i>'
            );
        } else {
            $('#icon' + id).html(
                element.value
            );
        }
    }
</script>

<script>
    function check_icon(id, element) {

        if(! element.value.includes('<i class=')) {
            swal.fire({
                title: 'Invalid Icon',
                text: 'Please enter a valid icon'
            });

            element.value = '';
            $('#icon' + id).html('<i class="fad fa-icons"></i>');
        }
    }
</script>

    <script>
        function verify_icon(id, form) {
            var image = form.image;
            var icon = form.image.value;
            
            if(icon !== '') {

                check_icon(id, image);

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

                    $('#icon' + id).html('<i class="fad fa-icons"></i>');

                    return false;
                }
            }
        }
    </script>
@endsection