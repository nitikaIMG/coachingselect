@extends('main')

@section('heading')
Streams 
@endsection('heading')

@section('sub-heading')
View Stream
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('StreamsController@add_stream')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="Add Stream"><i class="fad fa-plus"></i>&nbsp; Add</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<style>
    td>.fas,
    td>.fa,
    td>.far,
    td>.fab,
    td>i {
        font-size: 50px !important;
    }
</style>

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
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group" style="margin-left: 15px;">
                                    <label class="control-label">Stream Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Search by name" id="name" autocomplete="off" value="<?php echo $name; ?>">
                                </div>
                            </div>
                            <div class="col-md-auto align-self-end">
                                <button class="btn my-3 btn-sm btn-sm btn-sm btn-success text-uppercase"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                            <div class="col-md-auto align-self-end">
                                <a href="{{action('StreamsController@view_stream')}}" class="btn my-3 btn-sm btn-sm btn-sm btn-warning text-uppercase"><i class="far fa-undo"></i>&nbsp; Reset</a>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">View Stream</div>
    <div class="card-body">

        <div class="datatable table-responsive">
            <table class="table table-bordered table-striped table-hover text-nowrap" id="allmatches_datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Icon/Image</th>
                        <th>
                            Stream Name</th>
                        <th>
                            Action</th>

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Icon/Image</th>
                        <th>
                            Stream Name</th>
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
        $('#allmatches_datatable').DataTable({
            'bFilter': false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "ajax": {
                "url": "<?php echo action('StreamsController@view_stream_dt'); ?>?name=" + name + "&mobile=" + mobile,
                "datatype": "json",
                "type": "POST",
                "data": {
                    _token: "{{csrf_token()}}"
                }
            },
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
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "image"
                },
                {
                    "data": "name"
                },
                {
                    "data": "action"
                }
            ],
            "lengthMenu": [[25, 50,100,1000,10000,100000 ], [25, 50,100,1000,10000,100000]],
        });

    });
</script>

<script>
    function show_icon(id, element) {
        if( element.value == '') {
            $('#icon' + id).html(
                '<i class="fad fa-icons"></i>'
            );
        } else {
            $('#icon' + id).html(
                element.value
            );
        }
    }
</script>

<script>
    function check_icon(id, element) {

        if(! element.value.includes('<i class=')) {
            swal.fire({
                title: 'Invalid Icon',
                text: 'Please enter a valid icon'
            });

            element.value = '';
            $('#icon' + id).html('<i class="fad fa-icons"></i>');
        }
    }
</script>

    <script>
        function verify_icon(id, form) {
            var image = form.image;
            var icon = form.image.value;

            if(icon !== '') {
                
                check_icon(id, image);

                icon = $($.parseHTML(icon));
                
                var class_name = icon.attr('class');

                if(class_name != undefined) {

                    var new_icon = '<i class="' + class_name + '"></i>';

                    image.value = new_icon;
                } else {
                    swal.fire({
                        title: 'Invalid Icon',
                        text: 'Please enter a valid icon'
                    });

                    image.value = '';

                    $('#icon' + id).html('<i class="fad fa-icons"></i>');

                    return false;
                }
            }
        }
    </script>
@endsection