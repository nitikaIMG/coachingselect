@extends('main')

@section('heading')
Coachings
@endsection('heading')

@section('sub-heading')
View Coaching Course (Detail)
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CoachingController@view_coaching')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right mx-1" data-toggle="tooltip" title="" data-original-title="View Coaching"><i class="fad fa-eye"></i>&nbsp; View Coaching</a>

<a href="{{action('CoachingController@add_courses_detail', 'id=' . $coaching_id)}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right mx-1" data-toggle="tooltip" title="" data-original-title="Add Courses Detail"><i class="fas fa-plus"></i>&nbsp; Add Courses Detail</a>
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

                    <input type="hidden" name="id" value="{{$coaching_id}}">

                    <div class="form-body">
                        <div class="row align-items-center">
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Course (Detail) Name</label>
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
                                <a href="{{action('CoachingController@view_coaching_courses_detail')}}?id={{$coaching_id}}" class="btn btn-sm my-3 btn-warning text-uppercase"><i class="far fa-undo"></i>&nbsp; Reset</a>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">View Coaching ("{{ $coaching_name }}") Course (Detail)</div>
    <div class="card-body">

        <div class="datatable table-responsive">
            <table class="table table-bordered table-striped table-hover text-nowrap" id="allmatches_datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Is Featured</th>
                        <th>
                            Course</th>
                        <th>
                            Name</th>
                        <th>
                            Fee</th>
                        <th>
                            Offer Percentage</th>
                        <th>
                            Is Paid</th>
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
                            Is Featured</th>
                        <th>
                            Course</th>
                        <th>
                            Name</th>
                        <th>
                            Fee</th>
                        <th>
                            Offer Percentage</th>
                        <th>
                            Is Paid</th>
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
        $('#allmatches_datatable').DataTable({
            'bFilter': false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "ajax": {
                "url": "<?php echo action('CoachingController@view_coaching_courses_detail_dt'); ?>?name=" + name + "&mobile=" + mobile+ '&start_date=' + start_date + '&end_date=' + end_date,
                "datatype": "json",
                "type": "POST",
                "data": {
                    _token: "{{csrf_token()}}",
                    coaching_id: "{{$coaching_id}}",
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
                    "data": "is_featured"
                },
                {
                    "data": "coaching_courses_name"
                },
                {
                    "data": "name"
                },
                {
                    "data": "fee"
                },
                {
                    "data": "offer_percentage"
                },
                {
                    "data": "is_paid"
                },
                {
                    "data": "created_at"
                },
                {
                    "data": "action"
                },
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


<script>
    $(document).on('submit', '.is_featured', function(event) {
            event.preventDefault();

            if(
                $(this).children('button').hasClass('active')
            ) {
                $(this).children('button').removeClass('active')
            } else {
                $(this).children('button').addClass('active')
            }

            var action  = this.action;

            $.ajax({
                "url": action,
                "datatype": "json",
                "type": "POST",
                "data": {
                    _token: "{{csrf_token()}}",
                }
            });

            return false;
        }
    );
</script>


@endsection