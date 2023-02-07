@extends('main')

@section('heading')
Blogs 
@endsection('heading')

@section('sub-heading')
View Blog
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('BlogsController@view_blog')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View blog"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card mb-3">
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="" method="get" id="search">
                    <?php
                    $comment = "";

                    if (isset($_GET['comment'])) {
                        $comment = $_GET['comment'];
                    }

                    ?>
                    <div class="form-body">
                        <div class="row align-items-center">
                            <input type="hidden" name="id" value="{{$blog_id}}">
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Blog comment</label>
                                    <input type="text" class="form-control" name="comment" placeholder="Search by comment" id="comment" autocomplete="off" value="<?php echo $comment; ?>">
                                </div>
                            </div>
                            <div class="col-auto align-self-end">
                                <button class="btn btn-sm my-3 btn-success text-uppercase"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                            <div class="col-auto align-self-end">
                                <a href="{{action('BlogsController@view_blog_comments', 'id='. $blog_id)}}" class="btn btn-sm my-3 btn-warning text-uppercase"><i class="far fa-undo"></i>&nbsp; Reset</a>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">View Blog Comments</div>
    <div class="card-body">

        <div class="datatable table-responsive">
            <table class="table table-bordered table-striped table-hover text-nowrap" id="view_blog_dt" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Student Name</th>
                        <th>
                            Comment</th>
                        <th>
                            Action</th>

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Student Name</th>
                        <th>
                            Comment</th>
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

        var comment = $('#comment').val();
        var mobile = $('#mobile').val();
        $('#view_blog_dt').DataTable({
            'bFilter': false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "ajax": {
                "url": "<?php echo action('BlogsController@view_blog_comments_dt'); ?>?comment=" + comment + "&mobile=" + mobile,
                "datatype": "json",
                "type": "POST",
                "data": {
                    _token: "{{csrf_token()}}",
                    blog_id: "{{$blog_id}}"
                }
            },
            "columns": [{
                    "data": "id",
                    orderable: false
                },
                {
                    "data": "student_name"
                },
                {
                    "data": "comment"
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
                if(data.is_pending_comments == "0") {
                    $(row).addClass('bg bg-warning');
                }
            },
            "lengthMenu": [[25, 50,100,1000,10000,100000 ], [25, 50,100,1000,10000,100000]],
        });

    });
</script>

@endsection