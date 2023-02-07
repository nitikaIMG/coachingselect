@extends('main')

@section('heading')
Exams
@endsection('heading')

@section('sub-heading')
View Exam
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('ExamsController@add_exam')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="Add Exam"><i class="fas fa-plus"></i>&nbsp; Add</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')
<style type="text/css">
    .dataTables_filter{
        display: none;
    }
</style>
<div class="card mb-3">
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="" method="get" id="search">
                    <?php
                    $title = "";

                    if (isset($_GET['title'])) {
                        $title = $_GET['title'];
                    }

                    ?>
                    <?php
                    $start_date = "";

                    if (isset($_GET['start_date'])) {
                        $start_date = $_GET['start_date'];
                    }
                    
                    $end_date = "";

                    if (isset($_GET['end_date'])) {
                        $end_date = $_GET['end_date'];
                    }
                    $stream_id = "";

                    if (isset($_GET['stream_id'])) {
                        $stream_id = $_GET['stream_id'];
                    }


                    ?>
                    <div class="form-body">
                        <div class="row align-items-center">
                            <div class="col">
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
                            <div class="col">
                                <div class="form-group">
                                    <label class="control-label">Exam title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Search by title" id="title" autocomplete="off" value="<?php echo $title; ?>">
                                </div>
                            </div>
                            
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Start Date</label>
                                    <input type="text"
                                    id="start_date"
                                    value="{{$start_date}}" class="form-control datetimepickerget" name="start_date" placeholder="Enter Start Date">
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">End Date</label>
                                    <input type="text"
                                    id="end_date"
                                    value="{{$end_date}}" 
                                    class="form-control datetimepickerget" name="end_date" placeholder="Enter End Date">
                                </div>
                            </div>
                            <div class="col-auto align-self-end">
                                <button class="btn btn-sm btn-sm my-3 btn-sm btn-success text-uppercase"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                            <div class="col-auto align-self-end">
                                <a href="{{action('ExamsController@view_exam')}}" class="btn btn-sm btn-sm my-3 btn-sm btn-warning text-uppercase"><i class="far fa-undo"></i>&nbsp; Reset</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">View Exam</div>
    <div class="card-body">

        <div class="datatable table-responsive">
            <table class="table table-bordered table-striped table-hover text-nowrap" id="view_Exam_dt" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Stream</th>
                        <th>
                            Course</th>
                        <th>
                            Image</th>
                        <th>
                            Exam Title</th>
                        <th>
                            Created At</th>
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
                            Course</th>
                        <th>
                            Image</th>
                        <th>
                            Exam Title</th>
                        <th>
                            Created At</th>
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
        var title = $('#title').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var stream_id = $('#stream_id').val();

        $.fn.dataTable.ext.errMode = 'none';
        $('#view_Exam_dt').DataTable({
            "processing": true,
            "serverSide": true,

            "ajax": {
                "url": "<?php echo action('ExamsController@view_exam_dt'); ?>?title=" + title + '&start_date=' + start_date + '&end_date=' + end_date +'&stream_id='+stream_id,
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
                    "data": "stream"
                },
                {
                    "data": "course"
                },
                {
                    "data": "image"
                },
                {
                    "data": "title"
                },
                {
                    "data": "created_at"
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
        $("#view_exam_dt_length").hide();
        $("#view_exam_dt_filter").hide();
    });
</script>


<script>
    $('.alert').delay(3000).fadeOut();
</script>



<script>
    $(document).on('change', '#stream_id', function() {
        $.ajax({
            type: 'POST',
            url: '{{action("ExamsController@stream_course")}}',
            data: {
                stream_id: $(this).val(),
                _token: '{{csrf_token()}}'
            },
            success: function(data) {

                $('#course_id').html(
                    '<option value="">Select Course</option>'
                );

                data.forEach(element => {
                    $('#course_id').append(
                        '<option value="' + element.id + '">' + element.name + '</option>'
                    );
                });

                $('#course_id').selectpicker('refresh');
            }
        });
    });
</script>

@endsection