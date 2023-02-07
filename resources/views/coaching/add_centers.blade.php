@extends('main')

@section('heading')
Coachings 
@endsection('heading')

@section('sub-heading')
Add Coaching
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{ action('CoachingController@view_coaching_centers', 'id='.$coaching_id) }}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View Coaching Centers"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">Add Coaching ("{{ $coaching_name }}") (Centers)</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content p-4">


                <form action="{{ action('CoachingController@add_centers') }}" method="post" enctype="multipart/form-data" id="centers_form" onSubmit="return is_centers_selected()">
                    @csrf

                    <input type="hidden" name="coaching_id" value="{{$coaching_id}}" required>

                    <div class="card-body">


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">State</label>
                                    <select id="state_id" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required>
                                        <option value="">Select State</option>
                                        @if( !empty($states) )
                                        @foreach($states as $state)
                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Center</label>
                                    <div class="datatable table-responsive">
                                        <table class="table table-bordered table-striped table-hover text-nowrap" id="view_center_dt" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th class="text-align-center" width="50">
                                                        S. No</th>
                                                    <th>
                                                        Center Name</th>
                                                    <th>
                                                        Action</th>

                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-align-center" width="50">
                                                        S. No</th>
                                                    <th>
                                                        Center Name</th>
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
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Selected Centers</label>
                                    <input type="hidden" name="centers" id="centers" />
                                    <table class="table table-bordered table-striped table-hover text-nowrap" id="a" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-align-center" width="50">
                                                    S. No</th>
                                                <th>
                                                    Center Name</th>
                                                <th>
                                                    Action</th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th class="text-align-center" width="50">
                                                    S. No</th>
                                                <th>
                                                    Center Name</th>
                                                <th>
                                                    Action</th>

                                            </tr>
                                        </tfoot>
                                        <tbody id="data">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-sm btn-success" type="submit" form="centers_form"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                        </div>

                    </div>


                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).on('change', '#state_id', function() {
        var state_id = $('#state_id').val();

        $.fn.dataTable.ext.errMode = 'none';

        $('#view_center_dt').DataTable({
            'bFilter': false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "bDestroy": true,
            "ajax": {
                "url": "<?php echo action('CoachingController@all_centers'); ?>?state_id=" + state_id,
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

        $('#view_center_dt_length').css('display', 'none');
    });
</script>

<script>
    function select_center(center) {
        $.ajax({
            "url": '<?php echo action('CoachingController@select_center'); ?>',
            "type": "POST",
            "data": {
                _token: "{{csrf_token()}}",
                center: center
            },
            success: function(data) {
                var content = '';
                var centers = '';
                var i = 1;

                for (const key in data) {
                    if (data.hasOwnProperty(key)) {
                        const element = data[key];
                        var onclick_function = "deselect_center('" + element + "')";

                        content += '<tr><td>' + i + '</td><td>' + element + '</td><td class="btn btn-sm w-35px h-35px d-grid p-0 align-items-center justify-content-center mx-1 btn-primary" onclick="' + onclick_function + '" aria-label="Remove" data-balloon-pos="up"><i class="fas fa-minus"></i></td></tr>';

                        centers += element + ',';

                        i += 1;

                    }
                }
                $('#data').html(content);
                $('#centers').val(centers);
            }
        });
    }

    function deselect_center(center) {
        $.ajax({
            "url": '<?php echo action('CoachingController@deselect_center'); ?>',
            "type": "POST",
            "data": {
                _token: "{{csrf_token()}}",
                center: center
            },
            success: function(data) {
                var content = '';
                var centers = '';
                var i = 1;

                for (const key in data) {
                    if (data.hasOwnProperty(key)) {
                        const element = data[key];

                        var onclick_function = "deselect_center('" + element + "')";

                        content += '<tr><td>' + i + '</td><td>' + element + '</td><td class="btn btn-sm w-35px h-35px d-grid p-0 align-items-center justify-content-center mx-1 btn-primary" onclick="' + onclick_function + '" aria-label="Remove" data-balloon-pos="up"><i class="fas fa-minus"></i></td></tr>';

                        centers += element + ',';

                        i += 1;

                    }
                }
                $('#data').html(content);
                $('#centers').val(centers);
            }
        });
    }
</script>

<script>
    function is_centers_selected() {
        var centers = $('#centers').val();

        if (centers == '') {
            Swal.fire('Please choose centers for this coaching');
            return false;
        }

        return true;
    }
</script>
@endsection