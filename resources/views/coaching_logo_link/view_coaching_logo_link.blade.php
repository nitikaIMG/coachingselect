@extends('main')

@section('heading')
Coaching Logo Link Manager
@endsection('heading')

@section('sub-heading')
View Coaching Logo Link
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CoachingLogoLinkController@add_coaching_logo_link')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="Add Coaching Logo Link"><i class="fas fa-plus"></i>&nbsp; Add</a>
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
                    <div class="form-body">
                        <div class="row align-items-center">
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Coaching Logo Link Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Search by name" id="name" autocomplete="off" value="<?php echo $name; ?>">
                                </div>
                            </div>
                            <div class="col-auto align-self-end">
                                <button class="btn btn-sm my-3 btn-success text-uppercase"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                            <div class="col-auto align-self-end">
                                <a href="{{action('CoachingLogoLinkController@view_coaching_logo_link')}}" class="btn btn-sm my-3 btn-warning text-uppercase"><i class="far fa-undo"></i>&nbsp; Reset</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">View Coaching Logo Link</div>
    <div class="card-body">

        <div class="datatable table-responsive">
            <table class="table table-bordered table-striped table-hover text-nowrap" id="view_coaching_logo_link_dt" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Coaching Logo Link Name</th>
                        <th>
                            Image</th>
                        <th>
                            URL</th>
                        <th>
                            Action</th>

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Coaching Logo Link Name</th>
                        <th>
                            Image</th>
                        <th>
                            URL</th>
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
        var name = $('#name').val();

        $.fn.dataTable.ext.errMode = 'none';
        $('#view_coaching_logo_link_dt').DataTable({
            "processing": true,
            "serverSide": true,

            "ajax": {
                "url": "<?php echo action('CoachingLogoLinkController@view_coaching_logo_link_dt'); ?>?name=" + name,
                "datatype": "json",
                "type": "POST",
                "data": {
                    _token: "{{csrf_token()}}"
                }
            },
            "columns": [{
                    "data": "id",
                    orderable: false
                },
                {
                    "data": "name"
                },
                {
                    "data": "image"
                },
                {
                    "data": "url"
                },
                {
                    "data": "action"
                }
            ],
            "lengthMenu": [[25, 50,100,1000,10000,100000 ], [25, 50,100,1000,10000,100000]],
        });
        $("#view_coaching_logo_link_dt_length").hide();
        $("#view_coaching_logo_link_dt_filter").hide();
    });
</script>


<script>
    $('.alert').delay(3000).fadeOut();
</script>

@endsection