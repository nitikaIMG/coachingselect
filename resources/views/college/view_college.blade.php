@extends('main')

@section('heading')
Colleges
@endsection('heading')

@section('sub-heading')
View College
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CollegeController@add_college')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="Add College"><i class="fas fa-plus"></i>&nbsp; Add</a>
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
                    $state = "";

                    if (isset($_GET['name'])) {
                        $name = $_GET['name'];
                    }
                    if (isset($_GET['state'])) {
                        $state = $_GET['state'];
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
                    
                    $college_category_id = "";

                    if (isset($_GET['college_category_id'])) {
                        $college_category_id = $_GET['college_category_id'];
                    }

                    ?>
                    <div class="form-body">
                        <div class="row">
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    {{ Form::label('Category','Category',array('class'=>'text-bold'))}}
                                    
                                    <select name="college_category_id" id="college_category_id" class="form-control show-tick" data-width="full" data-container="body" data-live-search="true">
                                        <option value="">Select College Category</option>
                                        @if( !empty($colleges_categories) )
                                        @foreach($colleges_categories as $colleges_category)
                                        <option value="{{$colleges_category->name}}" @if($colleges_category->name == $college_category_id)
                                            selected
                                            @endif
                                            >{{$colleges_category->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {{ Form::label('Select State','Select State',array('class'=>'text-bold'))}}
                                    <select class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" title="Select State" name="state" id="state_id">
                                        <option value="">Select State</option>
                                        <?php
                                        if (!empty($getallstate->toarray())) {
                                            foreach ($getallstate as $states) {
                                        ?>
                                                <option value="<?php echo $states->id; ?>" <?php if ($states->id == $state) {
                                                                                                echo 'selected';
                                                                                            } ?>>
                                                    <?php echo ucwords($states->name); ?> </option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">College Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Search by name" id="name" autocomplete="off" value="<?php echo $name; ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Start Date</label>
                                    <input type="text"
                                    id="start_date"
                                    value="{{$start_date}}" class="form-control datetimepickerget" name="start_date" placeholder="Enter Start Date">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">End Date</label>
                                    <input type="text"
                                    id="end_date"
                                    value="{{$end_date}}" 
                                    class="form-control datetimepickerget" name="end_date" placeholder="Enter End Date">
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-auto">
                                <button class="btn btn-sm my-3 btn-success text-uppercase"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                            <div class="col-auto">
                                <a href="{{action('CollegeController@view_college')}}" class="btn btn-sm my-3 btn-warning text-uppercase"><i class="far fa-undo"></i>&nbsp; Reset</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">View College</div>
    <div class="card-body">

        <div class="datatable table-responsive">
            <table class="table table-bordered table-striped table-hover text-nowrap" id="allcollegesdatatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Is Featured</th>
                        <th>
                            College Category</th>
                        <th>
                            College Name</th>
                        <th>
                            State</th>
                        <th>
                            images</th>
                        <th>
                            Valuable</th>
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
                            College Category</th>
                        <th>
                            College Name</th>
                        <th>
                            State</th>
                        <th>
                            images</th>
                        <th>
                            Valuable</th>
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
        var state = $('#state_id').val();
        
        var college_category_id = $('#college_category_id').val();

        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        $('#allcollegesdatatable').DataTable({
            'bFilter': false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "ajax": {
                "url": "<?php echo URL::asset('coaching_admin/view_college_datatable'); ?>?name=" + name + '&state=' + state+ '&start_date=' + start_date + '&end_date=' + end_date + '&college_category_id=' + college_category_id,
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
                    "data": "is_featured"
                },
                {
                    "data": "college_category"
                },
                {
                    "data": "college_name"
                },
                {
                    "data": "state"
                },
                {
                    "data": "images"
                },
                {
                    "data": "valuable"
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