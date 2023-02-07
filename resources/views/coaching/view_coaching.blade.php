@extends('main')

@section('heading')
Coachings
@endsection('heading')

@section('sub-heading')
View Coaching
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CoachingController@add_coaching')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="Add Coaching"><i class="fas fa-plus"></i>&nbsp; Add</a>
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
                    $added_from = "";

                    if (isset($_GET['added_from'])) {
                        $added_from = $_GET['added_from'];
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

                    $city = "";

                    if (isset($_GET['city'])) {
                        $city = $_GET['city'];
                    }

                    $offering = "";

                    if (isset($_GET['offering'])) {
                        $offering = $_GET['offering'];
                    }

                    $course = "";

                    if (isset($_GET['course'])) {
                        $course = $_GET['course'];
                    }

                    $is_paid = "";

                    if (isset($_GET['is_paid'])) {
                        $is_paid = $_GET['is_paid'];
                    }

                    $is_featured = "";

                    if (isset($_GET['is_featured'])) {
                        $is_featured = $_GET['is_featured'];
                    }


                    ?>
                    <div class="form-body">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Coaching Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Search by name" id="name" autocomplete="off" value="<?php echo $name; ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Added From</label>
                                    <select name="added_from" id="added_from" class="form-control  show-tick" data-width="full" data-container="body" data-live-search="true">
                                        <option value="" selected>Added From</option>
                                        <option value="admin" @if($added_from=='admin' ) selected @endif>admin</option>
                                        <option value="website" @if($added_from=='website' ) selected @endif>website</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Start Date</label>
                                    <input type="text"
                                    id="start_date"
                                    value="{{$start_date}}" class="form-control datetimepickerget" name="start_date" placeholder="Enter Start Date">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">End Date</label>
                                    <input type="text"
                                    id="end_date"
                                    value="{{$end_date}}" 
                                    class="form-control datetimepickerget" name="end_date" placeholder="Enter End Date">
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Offering</label>
                                    <select name="offering" id="offering" class="form-control  show-tick" data-width="full" data-container="body" data-live-search="true">
                                        <option value="" selected>Offering</option>
                                        <option value="online" @if($offering=='online' ) selected @endif>online</option>
                                        <option value="classroom" @if($offering=='classroom' ) selected @endif>classroom</option>
                                        <option value="tutor" @if($offering=='tutor' ) selected @endif>tutor</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">City</label>
                                    <input type="text" class="form-control" name="city" placeholder="Search by city" id="city" autocomplete="off" value="<?php echo $city; ?>">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Course</label>
                                    <select name="course" id="course" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                        <option value="" selected disabled>Select Course</option>
                                        @if( !empty($courses) )
                                            @foreach($courses as $c)
                                            <option value="{{$c->name}}"
                                                @if($c->name == $course)
                                                    selected
                                                @endif    
                                            >{{$c->name}}</option>
                                            @endforeach
                                        @endif    
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Is Paid</label>
                                    <select name="is_paid" id="is_paid" class="form-control  show-tick" data-width="full" data-container="body" data-live-search="true">
                                        <option value="" selected>Is Paid</option>
                                        <option value="yes" @if($is_paid=='yes' ) selected @endif>yes</option>
                                        <option value="no" @if($is_paid=='no' ) selected @endif>no</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Is Featured</label>
                                    <select name="is_featured" id="is_featured" class="form-control  show-tick" data-width="full" data-container="body" data-live-search="true">
                                        <option value="" selected>Is Featured</option>
                                        <option value="1" @if($is_featured=='1' ) selected @endif>yes</option>
                                        <option value="0" @if($is_featured=='0' ) selected @endif>no</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-auto align-self-end">
                                <button class="btn btn-sm my-3 btn-success text-uppercase"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                            <div class="col-auto align-self-end">
                                <a href="{{action('CoachingController@view_coaching')}}" class="btn btn-sm my-3 btn-warning text-uppercase"><i class="far fa-undo"></i>&nbsp; Reset</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row w-100 align-items-center mx-0">
            <div class="col-md col-12 mb-md-0 mb-2 text-md-left text-center">View Coaching</div>
            
        </div>
    </div>
    <div class="card-body">

        <div class="datatable table-responsive">
            <table id="view_coaching_dt" class="table table-bordered table-striped table-hover text-nowrap display" cellspacing="0" width="100%" role="grid" aria-describedby="demo-dt-basic_info" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-align-center" width="50">
                            S.no</th>
                        <th>
                            Name</th>
                        <th>
                            Featured</th>

                        <th>
                            Source</th>
                        <th>
                            Logo</th>
                        <th>
                            Offering</th>

                        <th>
                            Created</th>
                        <th>
                            Action</th>
                        <th>
                            Center</th>
                        <th>
                            Paid</th>
                        <th>
                            Reviews    
                        </th>
                        
                        <th>
                            Courses</th>
                        <th>
                            Faculty</th>
                        <th>
                            Results</th>
                        <th>
                            Photos</th>
                        <th>
                            Videos</th>
                        <th>
                            Facility</th>
                        <th>
                            Centers</th>
                        <th>
                            Testimonials</th>
                        <th>
                            Reviews</th>

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-align-center" width="50">
                            S.no</th>
                        <th>
                            Name</th>
                        <th>
                            Featured</th>

                        <th>
                            Source</th>
                        <th>
                            Logo</th>
                        <th>
                            Offering</th>

                        <th>
                            Created</th>
                        <th>
                            Action</th>
                        <th>
                            Center</th>
                        <th>
                            Paid</th>
                        <th>
                            Reviews    
                        </th>
                        <th>
                            Courses</th>
                        <th>
                            faculty</th>
                        <th>
                            Results</th>
                        <th>
                            Photos</th>
                        <th>
                            Videos</th>
                        <th>
                            Facility</th>
                        <th>
                            Centers</th>
                        <th>
                            Testimonials</th>
                        <th>
                            Reviews</th>

                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script>
    $(document).ready(function (){

        // Handle click on "Expand All" button
        $('#btn-show-all-children').on('click', function(){
            // Expand row details
            table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
        });

        // Handle click on "Collapse All" button
        $('#btn-hide-all-children').on('click', function(){
            // Collapse row details
            table.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        var name = $('#name').val();
        var added_from = $('#added_from').val();
        

        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();

        var city = $('#city').val();
        var offering = $('#offering').val();
        var course = $('#course').val();
        var is_paid = $('#is_paid').val();
        var is_featured = $('#is_featured').val();

        $('#view_coaching_dt').DataTable({
            'bFilter': false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            'responsive': true,
            "ajax": {
                "url": "<?php echo action('CoachingController@view_coaching_dt'); ?>?name=" + name + "&added_from=" + added_from+ '&start_date=' + start_date + '&end_date=' + end_date + '&city=' + city+ '&offering=' + offering+ '&course=' + course+ '&is_paid=' + is_paid+ '&is_featured=' + is_featured,
                "datatype": "json",
                "type": "POST",
                "data": {
                    _token: "{{csrf_token()}}",
                }
            },
            "dom": 'lBfrtip',
            "buttons": [{
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'excel',
                    'csv',
                ]
            }],
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "name"
                },
                {
                    "data": "is_featured"
                },
                {
                    "data": "added_from"
                },
                {
                    "data": "image",
                    orderable: false
                },

                {
                    "data": "offering"
                },
                {
                    "data": "created_at"
                },
                {
                    "data": "enable_disable"
                },
                {
                    "data": "center"
                },
                {
                    "data": "is_paid_member"
                },
                {
                    "data": "is_pending_reviews"
                },

                {
                    "data": "courses",
                    orderable: false
                },
                {
                    "data": "faculty",
                    orderable: false
                },
                {
                    "data": "results",
                    orderable: false
                },
                {
                    "data": "photos",
                    orderable: false
                },
                {
                    "data": "videos",
                    orderable: false
                },
                {
                    "data": "facility",
                    orderable: false
                },
                {
                    "data": "centers",
                    orderable: false
                },
                {
                    "data": "testimonials",
                    orderable: false
                },
                {
                    "data": "reviews",
                    orderable: false
                },
            ],
            "createdRow": function( row, data, dataIndex ) {
                if(data.is_pending_reviews != 0) {
                    $(row).addClass('bg bg-warning text-white');
                }

                if(data.is_pending_request == 1) {
                    $(row).addClass('bg bg-pink text-white');
                }

                $(row).find('td:eq(0)').addClass('text-dark');
            },
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


    $('#preloader_admin').hide();
</script>
@endsection