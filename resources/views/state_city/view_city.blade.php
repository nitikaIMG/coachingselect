@extends('main')

@section('heading')
States & Cities
@endsection('heading')

@section('sub-heading')
View City
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('StatecityController@get_states')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View States"><i class="fad fa-eye"></i>&nbsp; View</a>
<a href="{{action('StatecityController@add_city')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="Add City"><i class="fad fa-plus"></i>&nbsp; Add</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card mb-3">
  <div class="card-body">
    <div class="sbp-preview">
      <div class="sbp-preview-content">
        <form action="" method="get" id="search">
          <?php
          $state = "";
          $city = "";

          if (isset($_GET['state'])) {
            $state = $_GET['state'];
          }
          if (isset($_GET['city'])) {
            $city = $_GET['city'];
          }

          ?>
          <div class="form-body">
            <div class="row align-items-center">
              <div class="col-md">
                <div class="form-group">
                  {{ Form::label('Select State','Select State',array('class'=>'text-bold'))}}
                  <select class="form-control selectpicker show-tick" data-container="body" title="Select State" name="state" id="state_id">
                    <option value="">Select State</option>
                    <?php
                    if (!empty($allstates->toarray())) {
                      foreach ($allstates as $states) {
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
              <div class="col-md">
                <div class="form-group">
                  <label class="control-label">Enter City</label>
                  <input type="text" class="form-control" name="city" placeholder="Search by city" id="city_id" autocomplete="off" value="<?php echo $city; ?>">
                </div>
              </div>
              <div class="col-auto align-self-end">
                <button class="btn btn-sm my-3 btn-success text-uppercase"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
              </div>
              <div class="col-auto align-self-end">
                <a href="{{action('StatecityController@get_city')}}" class="btn btn-sm my-3 btn-warning text-uppercase"><i class="far fa-undo"></i>&nbsp; Reset</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header"> View City </div>
  <div class="card-body">

    <div class="datatable table-responsive">
      <table class="table table-bordered table-striped table-hover text-nowrap" id="allcity_datatable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th class="text-align-center" width="50">
              S. No</th>
            <th>
              City name</th>
            <th>
              Action</th>

          </tr>
        </thead>
        <tfoot>
          <tr>
            <th class="text-align-center" width="50">
              S. No</th>
            <th>
              City Name</th>
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

    var state = $('#state_id').val();
    var city = $('#city_id').val();
    $('#allcity_datatable').DataTable({
      'bFilter': false,
      "processing": true,
      "serverSide": true,
      "searching": false,
      "ajax": {
        "url": '<?php echo URL::asset('coaching_admin/get_citydatatable'); ?>?state=' + state + '&city=' + city,
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
          "data": "city"
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


<script>
  $('.alert').delay(3000).fadeOut();
</script>

@endsection