@extends('main')

@section('heading')
Webinar
@endsection('heading')

@section('sub-heading')
View Webinar
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('WebinarController@add_webinar')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="Add Webinar"><i class="fas fa-plus"></i>&nbsp; Add</a>
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
                    <div class="form-body">
                        <div class="row align-items-center">
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Webinar Title</label>
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
                                <a href="{{action('WebinarController@view_webinar')}}" class="btn btn-sm my-3 btn-warning text-uppercase"><i class="far fa-undo"></i>&nbsp; Reset</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">View Webinar</div>
    <div class="card-body">

        <div class="datatable table-responsive">
            <table class="table table-bordered table-striped table-hover text-nowrap" id="view_webinar_dt" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Webinar Title</th>
                        <th>
                            URL</th>
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
                            Webinar Title</th>
                        <th>
                            URL</th>
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
        var name = $('#name').val();
        

        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();

        $.fn.dataTable.ext.errMode = 'none';
        $('#view_webinar_dt').DataTable({
            "processing": true,
            "serverSide": true,

            "ajax": {
                "url": "<?php echo action('WebinarController@view_webinar_dt'); ?>?name=" + name+ '&start_date=' + start_date + '&end_date=' + end_date,
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
                    "data": "title"
                },
                {
                    "data": "url"
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
            "fnDrawCallback": function( oSettings ) {
                ck_editor();
                date_init();
            },
        });
        $("#view_webinar_dt_length").hide();
        $("#view_webinar_dt_filter").hide();
    });
</script>


<script>
    $('.alert').delay(3000).fadeOut();
</script>

<script>
    function switch_between(element) {

        if(element.value == 'url') {  
            $('#url_box' + element.dataset.id).show();
            $('#url' + element.dataset.id).prop('required', true);
            $('#content_box' + element.dataset.id).hide();
            $('#description' + element.dataset.id).prop('required', false);
        } else {                
            $('#content_box' + element.dataset.id).show();
            $('#url_box' + element.dataset.id).hide();
            $('#url' + element.dataset.id).prop('required', false);
        }
    }
</script>

<script>
        function ck_editor() {
            
            $('textarea').each(function(){  
                
                try {
                    var editor = CKEDITOR.instances[$(this).attr('id')];
                    if (editor) { editor.destroy(true); }

                    CKEDITOR.replace($(this).attr('id'), {
                        filebrowserUploadUrl: "{{ action('BlogsController@ckeditor_image', ['_token' => csrf_token() ])}}",
                        filebrowserUploadMethod: 'form'
                    });
                } catch(error) {

                }
            });
            
        }
</script>

<script>
        function date_init() {
            
            $('input[name="date"]').each(function(){  
                
                $.datetimepicker.setLocale('en');
                
                $(this).datetimepicker({
                    lang: 'en',
                    formatDate: 'd.m.Y',
                    step: 5,
                    startDate: new Date(),
                    format:'Y/m/d'
                });
            });
            
        }
</script>
@endsection