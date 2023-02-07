@extends('main')

@section('heading')
    Counsellings
@endsection('heading')

@section('sub-heading')
    View All Counselling
@endsection('sub-heading')

@section('card-heading-btn')
<a  href="<?php echo action('CounsellingController@counselling') ?>" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="Add New Counselling"><i class="fa fa-plus"></i>&nbsp; Add</a>
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
                    
                    $type = "";

                    if (isset($_GET['type'])) {
                        $type = $_GET['type'];
                    }


                    ?>
                    <div class="form-body">
                        <div class="row align-items-center">
                            <div class="col-md">                                
                                <div class="form-group">
                                    <label for="type">Type*</label>
                                    <select name="type" class="form-control form-control-solid selectpicker show-tick" data-container="body" data-live-search="true" title="Select Type" data-hide-disabled="true" 
                                    id="type">
                                        <option value="">Select Type</option>
                                        <option value="Career after X"
                                            @if($type == 'Career after X')
                                                selected
                                            @endif
                                        >Career after X</option>
                                        <option value="Career after XII"
                                            @if($type == 'Career after XII')
                                                selected
                                            @endif
                                        >Career after XII</option>
                                        <option value="Career after graduation"
                                            @if($type == 'Career after graduation')
                                                selected
                                            @endif
                                        >Career after graduation</option>
                                        <option value="Customize Counselling"
                                            @if($type == 'Customize Counselling')
                                                selected
                                            @endif
                                        >Customize Counselling</option>
                                        
                                    </select>
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
                                <a href="{{action('CounsellingController@view_counselling')}}" class="btn my-3 btn-sm btn-sm btn-sm btn-warning text-uppercase"><i class="far fa-undo"></i>&nbsp; Reset</a>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">View All Counselling</div>
    <div class="card-body">
        <div class="datatable table-responsive">
            <table class="table table-bordered table-striped table-hover text-center text-nowrap" id="datatabledd" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sno.</th>
                        <th>Type</th>
                        <th>
                            Name</th>
                        <th>
                            Fee</th>
                        <th>
                            Offer Percentage</th>
                        <th>
                            Created At</th>
                        <th>
                            Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Sno.</th>
                        <th>Type</th>
                        <th>
                            Name</th>
                        <th>
                            Fee</th>
                        <th>
                            Offer Percentage</th>
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

    

        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var type = $('#type').val();

        $('#datatabledd').DataTable({
             "processing": true,
             "sAjaxSource":'<?php echo asset('coaching_admin/view_counselling_table');?>?'+ 'start_date=' + start_date + '&end_date=' + end_date + '&type=' + type,
             "dom": 'lBfrtip',
             "buttons": [
                {
                    extend: 'collection',
                    text: 'Export',
                    buttons: [
                        'copy',
                        'excel',
                        'csv',
                        'pdf',
                        'print'
                    ]
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
            $("#datatabledd_filter").hide();

});
</script>

@endsection('content')
