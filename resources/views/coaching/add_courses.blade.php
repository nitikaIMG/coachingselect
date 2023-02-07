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
    <div class="card-header">Add Coaching (Courses)</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">


                <form action="{{ action('CoachingController@add_courses') }}" method="post" enctype="multipart/form-data" id="courses_form" onSubmit="return is_courses_selected()">
                    @csrf

                    <input type="hidden" name="coaching_id" value="{{$coaching_id}}" required>

                    <div class="card-body p-0">


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Stream</label>
                                    <select id="stream_id" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required>
                                        <option value="">Select Stream</option>
                                        @if( !empty($streams) )
                                        @foreach($streams as $stream)
                                        <option value="{{$stream->id}}">{{$stream->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Course</label>
                                    <div class="datatable table-responsive">
                                        <table class="table table-bordered table-striped table-hover text-nowrap" id="view_course_dt" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th class="text-align-center" width="50">
                                                        S. No</th>
                                                    <th>
                                                        Course Name</th>
                                                    <th>
                                                        Action</th>

                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-align-center" width="50">
                                                        S. No</th>
                                                    <th>
                                                        Course Name</th>
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
                                    <label class="control-label">Selected Courses</label>
                                    <input type="hidden" name="courses" id="courses" />
                                    <table class="table table-bordered table-striped table-hover text-nowrap" id="a" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-align-center" width="50">
                                                    S. No</th>
                                                <th>
                                                    Course Name</th>
                                                <th>
                                                    Action</th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th class="text-align-center" width="50">
                                                    S. No</th>
                                                <th>
                                                    Course Name</th>
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

                    </div>

                    <div class="col-md-12 text-right">
                        <button class="btn btn-sm btn-success" type="submit" form="courses_form">
                        <i class="far fa-check-circle"></i>&nbsp;Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).on('change', '#stream_id', function() {
        var stream_id = $('#stream_id').val();

        $.fn.dataTable.ext.errMode = 'none';

        $('#view_course_dt').DataTable({
            'bFilter': false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "bDestroy": true,
            "ajax": {
                "url": "<?php echo action('CoachingController@all_courses'); ?>?stream_id=" + stream_id,
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

        $('#view_course_dt_length').css('display', 'none');
    });
</script>

<script>
    function select_course(course) {
        $.ajax({
            "url": '<?php echo action('CoachingController@select_course'); ?>',
            "type": "POST",
            "data": {
                _token: "{{csrf_token()}}",
                course: course
            },
            success: function(data) {
                var content = '';
                var courses = '';
                var i = 1;

                for (const key in data) {
                    if (data.hasOwnProperty(key)) {
                        const element = data[key];
                        var onclick_function = "deselect_course('" + element + "')";

                        content += '<tr><td>' + i + '</td><td>' + element + '</td><td class="btn btn-sm btn-danger" onclick="' + onclick_function + '" aria-label="Remove" data-balloon-pos="up"><i class="fas fa-minus"></i></td></tr>';

                        courses += element + ',';

                        i += 1;

                    }
                }
                $('#data').html(content);
                $('#courses').val(courses);
            }
        });
    }

    function deselect_course(course) {
        $.ajax({
            "url": '<?php echo action('CoachingController@deselect_course'); ?>',
            "type": "POST",
            "data": {
                _token: "{{csrf_token()}}",
                course: course
            },
            success: function(data) {
                var content = '';
                var courses = '';
                var i = 1;

                for (const key in data) {
                    if (data.hasOwnProperty(key)) {
                        const element = data[key];

                        var onclick_function = "deselect_course('" + element + "')";

                        content += '<tr><td>' + i + '</td><td>' + element + '</td><td class="btn btn-sm btn-danger" onclick="' + onclick_function + '"><i class="fas fa-minus"></i></td></tr>';

                        courses += element + ',';

                        i += 1;

                    }
                }
                $('#data').html(content);
                $('#courses').val(courses);
            }
        });
    }
</script>

<script>
    function is_courses_selected() {
        var courses = $('#courses').val();

        if (courses == '') {
            Swal.fire('Please choose courses for this coaching');
            return false;
        }

        return true;
    }
</script>
@endsection