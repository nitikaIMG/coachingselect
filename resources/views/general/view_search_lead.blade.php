@extends('main')

@section('heading')
Generals
@endsection('heading')

@section('sub-heading')
View Search Lead
@endsection('sub-heading')

@section('card-heading-btn')

@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card mb-3">
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="" method="get" id="search">
                    <?php
                    $email = "";

                    if (isset($_GET['email'])) {
                        $email = $_GET['email'];
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
                                <a href="{{action('GeneralController@view_search_lead')}}" class="btn my-3 btn-sm btn-sm btn-sm btn-warning text-uppercase"><i class="far fa-undo"></i>&nbsp; Reset</a>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">View Search Lead</div>
    <div class="card-body">

        <div class="datatable table-responsive">
            <table class="table table-bordered table-striped table-hover text-nowrap" id="view_requestcallback_dt" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Text Search</th>
                        <th>
                            Found / Not Found</th>
                        <th>
                            Location</th>
                        <th>
                            Date of Search</th>
                        

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-align-center" width="50">
                            S. No</th>
                        <th>
                            Text Search</th>
                        <th>
                            Found / Not Found</th>
                        <th>
                            Location</th>
                        <th>
                            Date of Search</th>
                        
                    </tr>
                </tfoot>
                <tbody>
                    
                </tbody>

            </table>

        </div>
    </div>
</div>
 <!-- Modal -->
  <div class="modal fade" id="reqcallbackmodel" role="dialog">
    <div class="modal-dialog" style="width: 400px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Write Message</h4>
        </div>
        <div class="modal-body">
            <form action="{{asset('coaching_admin/reqcallback_mail')}}" method="post">
                @csrf
                <input type="hidden" name="id" value="" id="id">
                <textarea name="message" placeholder="Write Message" required style="width: 100%;height: 140px;"></textarea><br>
                <button class="btn btn-primary float-right">Send</button>
            </form>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <script type="text/javascript"> function showreqcallback
  (id) {
   $('#id').val(id);

   $('#reqcallbackmodel').modal('show');
}</script>
<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';

        var email = $('#email').val();
        

        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        $('#view_requestcallback_dt').DataTable({
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
            'bFilter': false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "ajax": {
                "url": "<?php echo action('GeneralController@view_search_lead_dt'); ?>?email=" + email +  '&start_date=' + start_date + '&end_date=' + end_date,
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
                    "data": "text"
                },
                {
                    "data": "is_found"
                },
                {
                    "data": "location"
                },
                {
                    "data": "created_at"
                }
            ],
        });

    });
</script>

@endsection