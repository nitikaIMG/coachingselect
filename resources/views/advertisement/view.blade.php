@extends('main')

@section('heading')
    Advertisements
@endsection('heading')

@section('sub-heading')
    View All Advertisement
@endsection('sub-heading')

@section('card-heading-btn')
<a  href="<?php echo action('AdvertisementController@advertisement') ?>" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="Add New Advertisement"><i class="fa fa-plus"></i>&nbsp; Add</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card mb-3">
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="" method="get" id="search">
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
                                <a href="{{action('AdvertisementController@view_advertisement')}}" class="btn my-3 btn-sm btn-sm btn-sm btn-warning text-uppercase"><i class="far fa-undo"></i>&nbsp; Reset</a>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">View All Advertisement</div>
    <div class="card-body">
        <div class="datatable table-responsive">
            <table class="table table-bordered table-striped table-hover text-center text-nowrap" id="datatabledd" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sno.</th>
                        <th>Type</th>
                        <th>Coaching Name</th>
                        <th>Image</th>
                        <th>Clicks</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Sno.</th>
                        <th>Type</th>
                        <th>Coaching Name</th>
                        <th>Image</th>
                        <th>Clicks</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Actions</th>
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

        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();

        $('#datatabledd').DataTable({
             "processing": true,
             "sAjaxSource":'<?php echo asset('coaching_admin/view_advertisement_table');?>?start_date=' + start_date + '&end_date=' + end_date,
             "dom": 'lBfrtip',
            "buttons": [
                {
                    extend: 'collection',
                    text: 'Download Data',
                    buttons: [     
                        {
                            extend: 'excelHtml5',
                            text: 'EXCEL',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },            
                        {
                            extend: 'csvHtml5',
                            text: 'CSV',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                    ],
                }
            ],
            "lengthMenu": [[25, 50,100,1000,10000,100000 ], [25, 50,100,1000,10000,100000]],
        });
            $("#datatabledd_filter").hide();

});
</script>

@endsection('content')
