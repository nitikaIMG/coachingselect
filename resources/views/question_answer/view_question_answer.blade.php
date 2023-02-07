@extends('main')

@section('heading')
Study Material
@endsection('heading')

@section('sub-heading')
View Question Answer
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('QuestionAnswerController@add_question_answer', 'id='.$question_paper_subject_id)}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="Add Question Answer"><i class="fad fa-plus"></i>&nbsp; Add</a>
<a href="{{action('FreePreparationToolController@view_question_paper_subjects')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right mx-2" data-toggle="tooltip" title="" data-original-title="View Paper Name"><i class="fad fa-eye"></i>&nbsp; View</a>
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


                    ?>
                    <div class="form-body">
                        <div class="row align-items-center">

                            <input type="hidden" name="id" value="{{$question_paper_subject_id}}">

                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Question Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Search by name" id="name" autocomplete="off" value="<?php echo $name; ?>">
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
                            <button class="btn btn-sm my-3 btn-success text-uppercase"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                        </div>
                        <div class="col-auto align-self-end">
                            <a href="{{action('QuestionAnswerController@view_question_answer')}}?id={{$question_paper_subject_id}}" class="btn btn-sm my-3 btn-warning text-uppercase"><i class="far fa-undo"></i>&nbsp; Reset</a>
                        </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">View Question ({{ $course_name ?? ''}} --> {{ $subject_name ?? ''}})</div>
    <div class="card-body">

        <div class="datatable table-responsive">
            <table class="table table-bordered table-striped table-hover text-nowrap" id="view_question_paper_subjects_dt" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Paper Name</th>
                        <th>
                            Question</th>
                        <th>
                            Answer</th>
                        <th>
                            Marks</th>
                        <th>
                            Negative Marks</th>
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
                            Paper Name</th>
                        <th>
                            Question</th>
                        <th>
                            Answer</th>
                        <th>
                            Marks</th>
                        <th>
                            Negative Marks</th>
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
        $.fn.dataTable.ext.errMode = 'none';
        var name = $('#name').val();
        var mobile = $('#mobile').val();

        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();

        $('#view_question_paper_subjects_dt').DataTable({
            'bFilter': false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "ajax": {
                "url": "<?php echo action('QuestionAnswerController@view_question_answer_dt'); ?>?name=" + name + "&mobile=" + mobile+ '&start_date=' + start_date + '&end_date=' + end_date,
                "datatype": "json",
                "type": "POST",
                "data": {
                    _token: "{{csrf_token()}}",
                    question_paper_subject_id: "{{$question_paper_subject_id}}"
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
                    "data": "question_paper_subjects"
                },
                {
                    "data": "question"
                },
                {
                    "data": "answer"
                },
                {
                    "data": "marks"
                },
                {
                    "data": "negative_marks"
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

    });
</script>

@endsection