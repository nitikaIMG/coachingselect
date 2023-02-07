@extends('main')

@section('heading')
Coachings
@endsection('heading')

@section('sub-heading')
View Coaching Course
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CoachingController@view_coaching')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View Coaching"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

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

                    $stream_id = "";

                    if (isset($_GET['stream_id'])) {
                        $stream_id = $_GET['stream_id'];
                    }

                    ?>

                    <input type="hidden" name="id" value="{{$coaching_id}}">

                    <div class="form-body">
                        <div class="row align-items-center">
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Stream</label>
                                    <select name="stream_id" id="stream_id" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
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

                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Coaching Course Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Search by name" id="name" autocomplete="off" value="<?php echo $name; ?>">
                                </div>
                            </div>
                            <div class="col-auto align-self-end">
                                <button class="btn btn-sm my-3 btn-success text-uppercase"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                            <div class="col-auto align-self-end">
                                <a href="{{action('CoachingController@view_coaching_courses')}}?id={{$coaching_id}}" class="btn btn-sm my-3 btn-warning text-uppercase"><i class="far fa-undo"></i>&nbsp; Reset</a>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">View Coaching Course</div>
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
        var stream_id = $('#stream_id').val();
        $('#view_course_dt').DataTable({
            'bFilter': false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "ajax": {
                "url": "<?php echo action('CoachingController@view_coaching_courses_dt'); ?>?name=" + name + "&stream_id=" + stream_id,
                "datatype": "json",
                "type": "POST",
                "data": {
                    _token: "{{csrf_token()}}",
                    coaching_id: "{{$coaching_id}}"
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
                    "data": "id"
                },
                {
                    "data": "stream"
                },
                {
                    "data": "name"
                },
                {
                    "data": "action",
                    orderable: false
                }
            ],
            "lengthMenu": [[25, 50,100,1000,10000,100000 ], [25, 50,100,1000,10000,100000]],
        });

    });
</script>

@endsection