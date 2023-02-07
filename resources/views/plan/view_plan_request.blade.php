@extends('main')

@section('heading')
Plan Requests
@endsection('heading')

@section('sub-heading')
View Plan Request
@endsection('sub-heading')


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
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Coaching name</label>
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
                                <button class="btn my-3 btn-sm btn-sm btn-sm btn-success text-uppercase"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                            <div class="col-auto align-self-end">
                                <a href="{{action('PlanController@view_plan_request')}}" class="btn my-3 btn-sm btn-sm btn-sm btn-warning text-uppercase"><i class="far fa-undo"></i>&nbsp; Reset</a>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">View Plan Request</div>
    <div class="card-body">

        <div class="datatable table-responsive">
            <table class="table table-bordered table-striped table-hover text-nowrap" id="view_enterprise_dt" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Coaching Name</th>
                        <th>
                            Mobile</th>
                        <th>
                            Email</th>
                        <th>
                            Plan Name</th>
                        <th>
                            Type</th>
                        <th>
                            Fee</th>
                        <th>
                            Requested Date</th>

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Coaching Name</th>
                        <th>
                            Mobile</th>
                        <th>
                            Email</th>
                        <th>
                            Plan Name</th>
                        <th>
                            Type</th>
                        <th>
                            Fee</th>
                        <th>
                            Requested Date</th>

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
        $('#view_enterprise_dt').DataTable({
            'bFilter': false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "ajax": {
                "url": "<?php echo action('PlanController@view_plan_request_dt'); ?>?name=" + name + "&mobile=" + mobile+ '&start_date=' + start_date + '&end_date=' + end_date,
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
                    "data": "coaching_name"
                },
                {
                    "data": "mobile"
                },
                {
                    "data": "email"
                },
                {
                    "data": "name"
                },
                {
                    "data": "type"
                },
                {
                    "data": "fee"
                },
                {
                    "data": "created_at"
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

@endsection