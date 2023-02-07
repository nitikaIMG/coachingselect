@extends('main')

@section('heading')
Coachings 
@endsection('heading')

@section('sub-heading')
Add Coaching
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CoachingController@view_coaching')}}" class="btn btn-sm btn-primary mx-1" data-toggle="tooltip" title="" data-original-title="View Coaching"><i class="fad fa-eye"></i>&nbsp; View Coaching</a>
<a href="{{ action('CoachingController@view_coaching_facility', 'id='.$coaching_id) }}" class="btn btn-sm btn-primary mx-1" data-toggle="tooltip" title="" data-original-title="View Coaching Facility"><i class="fad fa-eye"></i>&nbsp; View Coaching Facility</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">Add Coaching ("{{ $coaching_name }}") (Facility)</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">


                <form action="{{ action('CoachingController@add_facilities') }}" method="post" enctype="multipart/form-data" id="facility_form" onSubmit="return is_facility_selected()">
                    @csrf

                    <input type="hidden" name="coaching_id" value="{{$coaching_id}}" required>

                    <div class="card-body p-0">


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Facility Type</label>
                                    <select id="facility_type" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required>
                                        <option value="">Select Facility Type</option>
                                        @if( !empty($facilities) )
                                        @foreach($facilities as $facility)
                                        <option value="{{$facility->type}}">{{$facility->type}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Facility</label>
                                    <div class="datatable table-responsive">
                                        <table class="table table-bordered table-striped table-hover text-nowrap" id="view_facility_dt" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th class="text-align-center" width="50">
                                                        S. No</th>
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Selected Facility</label>
                                    <input type="hidden" name="facilities" id="facilities" />
                                    <table class="table table-bordered table-striped table-hover text-nowrap" id="a" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-align-center" width="50">
                                                    S. No</th>
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
                                                    Facility Name</th>
                                                <th>
                                                    Action</th>

                                            </tr>
                                        </tfoot>
                                        <tbody id="data">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button class="btn btn-sm btn-success" type="submit" form="facility_form">
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
    $(document).on('change', '#facility_type', function() {
        var facility_type = $('#facility_type').val();

        $.fn.dataTable.ext.errMode = 'none';

        $('#view_facility_dt').DataTable({
            'bFilter': false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "bDestroy": true,
            "ajax": {
                "url": "<?php echo action('CoachingController@all_facilities'); ?>?facility_type=" + facility_type,
                "datatype": "json",
                "type": "POST",
                "data": {
                    _token: "{{csrf_token()}}"
                }
            },
            "dom": 'lBfrtip',
            "buttons": [{
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }],
            "columns": [{
                    "data": "id",
                    orderable: false
                },
                {
                    "data": "name"
                },
                {
                    "data": "action"
                }
            ]
        });

        $('#view_facility_dt_length').css('display', 'none');
    });
</script>

<script>
    function select_facility(facility) {
        $.ajax({
            "url": '<?php echo action('CoachingController@select_facility'); ?>',
            "type": "POST",
            "data": {
                _token: "{{csrf_token()}}",
                facility: facility
            },
            success: function(data) {
                var content = '';
                var facilities = '';
                var i = 1;

                for (const key in data) {
                    if (data.hasOwnProperty(key)) {
                        const element = data[key];
                        var onclick_function = "deselect_facility('" + element + "')";

                        content += '<tr><td>' + i + '</td><td>' + element + '</td><td class="btn btn-sm w-35px h-35px d-grid p-0 align-items-center justify-content-center mx-1 btn-primary" onclick="' + onclick_function + '" aria-label="Remove" data-balloon-pos="up"><i class="fas fa-minus"></i></td></tr>';

                        facilities += element + ',';

                        i += 1;

                    }
                }
                $('#data').html(content);
                $('#facilities').val(facilities);
            }
        });
    }

    function deselect_facility(facility) {
        $.ajax({
            "url": '<?php echo action('CoachingController@deselect_facility'); ?>',
            "type": "POST",
            "data": {
                _token: "{{csrf_token()}}",
                facility: facility
            },
            success: function(data) {
                var content = '';
                var facilities = '';
                var i = 1;

                for (const key in data) {
                    if (data.hasOwnProperty(key)) {
                        const element = data[key];

                        var onclick_function = "deselect_facility('" + element + "')";

                        content += '<tr><td>' + i + '</td><td>' + element + '</td><td class="btn btn-sm w-35px h-35px d-grid p-0 align-items-center justify-content-center mx-1 btn-primary" onclick="' + onclick_function + '" aria-label="Remove" data-balloon-pos="up"><i class="fas fa-minus"></i></td></tr>';

                        facilities += element + ',';

                        i += 1;

                    }
                }
                $('#data').html(content);
                $('#facilities').val(facilities);
            }
        });
    }
</script>

<script>
    function is_facility_selected() {
        var facility = $('#facilities').val();

        if (facility == '') {
            Swal.fire('Please choose facility for this coaching');
            return false;
        }

        return true;
    }
</script>
@endsection