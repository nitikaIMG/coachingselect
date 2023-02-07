@extends('main')

@section('heading')
Blogs 
@endsection('heading')

@section('sub-heading')
View Blog
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('BlogsController@add_blog')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="Add blog"><i class="fas fa-plus"></i>&nbsp; Add</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

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

                    $blog_category_id = "";

                    if (isset($_GET['blog_category_id'])) {
                        $blog_category_id = $_GET['blog_category_id'];
                    }

                    $tag = "";

                    if (isset($_GET['tag'])) {
                        $tag = $_GET['tag'];
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
                                    <label class="control-label">Category</label>
                                    <select name="blog_category_id" id="blog_category_id" class="form-control selectpicker show-tick" data-width="auto" data-container="body" data-live-search="true">
                                        <option value="">Select Blog Category</option>
                                        @if( !empty($blogs_categories) )
                                        @foreach($blogs_categories as $blogs_category)
                                        <option value="{{$blogs_category->id}}" @if($blogs_category->id == $blog_category_id)
                                            selected
                                            @endif
                                            >{{$blogs_category->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Blog title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Search by title" id="title" autocomplete="off" value="<?php echo $title; ?>">
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Blog tag</label>
                                    <input type="text" class="form-control" name="tag" placeholder="Search by tag" id="tag" autocomplete="off" value="<?php echo $tag; ?>">
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
                                <button class="btn my-3 btn-sm btn-success text-uppercase"><i class="far fa-check-circle"></i>&nbsp;Submit</button>    
                            </div>
                            <div class="col-auto align-self-end">
                                <a href="{{action('BlogsController@view_blog')}}" class="btn my-3 btn-sm btn-warning text-uppercase"><i class="far fa-undo"></i>&nbsp; Reset</a>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">View Blog</div>
    <div class="card-body">

        <div class="datatable table-responsive">
            <table class="table table-bordered table-striped table-hover text-nowrap" id="view_blog_dt" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Category</th>
                        <th>
                            Image</th>
                        <th>
                            Blog Title</th>
                        <th>
                            Views</th>
                        <th>
                            Likes</th>
                        <th>
                            Comments</th>
                        <th>
                            Written By</th>
                        <th>
                            Email</th>
                        <th>
                            Phone</th>
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
                            Category</th>
                        <th>
                            Image</th>
                        <th>
                            Blog Title</th>
                        <th>
                            Views</th>
                        <th>
                            Likes</th>
                        <th>
                            Comments</th>
                        <th>
                            Written By</th>
                        <th>
                            Email</th>
                        <th>
                            Phone</th>
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

        var title = $('#title').val();
        var blog_category_id = $('#blog_category_id').val();
        var tag = $('#tag').val();        

        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();

        $('#view_blog_dt').DataTable({
            'bFilter': false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "ajax": {
                "url": "<?php echo action('BlogsController@view_blog_dt'); ?>?title=" + title + "&blog_category_id=" + blog_category_id + "&tag=" + tag + '&start_date=' + start_date + '&end_date=' + end_date,
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
                    "data": "category"
                },
                {
                    "data": "image"
                },
                {
                    "data": "title"
                },
                {
                    "data": "views"
                },
                {
                    "data": "likes"
                },
                {
                    "data": "comments"
                },
                {
                    "data": "written_by"
                },
                {
                    "data": "email"
                },
                {
                    "data": "phone"
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
            "createdRow": function( row, data, dataIndex ) {
                if(data.is_pending_comments != 0) {
                    $(row).addClass('bg bg-warning');
                }
            },
            "lengthMenu": [[25, 50,100,1000,10000,100000 ], [25, 50,100,1000,10000,100000]],
        });

    });
</script>

@endsection