@extends('main')

@section('heading')
Courses
@endsection('heading')

@section('sub-heading')
View Course
@endsection('sub-heading')

@section('card-heading-btn')
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card mb-3">
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content p-3">
                <form action="" method="get" id="search">
                    <?php
                    $name = "";
                    if (isset($_GET['name'])) {
                        $name = $_GET['name'];
                    }
                    $stream_id = "";
                    if (isset($_GET['stream_id'])) {
                        $stream_id = $_GET['stream_id'];
                    }
                    ?>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group" style="margin-left: 15px;">
                                    <label class="control-label">Stream</label>
                                    <select name="stream_id" id="stream_id" class="form-control">
                                        <option value="">Select Stream</option>
                                        @if( !empty($streams) )
                                        @foreach($streams as $stream)
                                        <option value="{{$stream->id}}" @if($stream->id == $stream_id)
                                            selected
                                            @endif
                                            >{{$stream->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group" style="margin-left: 15px;">
                                    <label class="control-label">Course Name</label>
                                    <input type="text" class="form-control" name="name" style="width: 260px;" placeholder="Search by name" id="name" autocomplete="off" value="<?php echo $name; ?>">
                                </div>
                            </div>

                        </div>
                        <div class="col-12 text-right mt-4 mb-2">
                            <button class="btn btn-sm btn-success text-uppercase"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            <a href="{{action('CoursesController@view_course')}}" class="btn btn-sm btn-warning text-uppercase"><i class="far fa-undo"></i>&nbsp; Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">View Course</div>
    <div class="card-body">

        <div class="datatable table-responsive">
            <table class="table table-bordered table-striped table-hover text-nowrap" id="view_course_dt" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Stream</th>
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
                            Stream</th>
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

<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        var name = $('#name').val();
        var mobile = $('#mobile').val();
        $('#view_course_dt').DataTable({
            'bFilter': false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "ajax": {
                "url": "<?php echo action('CoursesController@view_course_dt'); ?>?name=" + name + "&mobile=" + mobile,
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
                    "data": "stream"
                },
                {
                    "data": "name"
                },
                {
                    "data": "action"
                }
            ],
            "lengthMenu": [[25, 50,100,1000,10000,100000 ], [25, 50,100,1000,10000,100000]],
        });

    });
</script>

@endsection