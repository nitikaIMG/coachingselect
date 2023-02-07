@extends('main')

@section('heading')
States & Cities
@endsection('heading')

@section('sub-heading')
View State
@endsection('sub-heading')

@section('card-heading-btn')
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card mb-3">
  <div class="card-body">
    <div class="sbp-preview">
      <div class="sbp-preview-content">
        <form action="<?php echo action('StatecityController@state_search'); ?>" method="get" id="search">
          <?php
          $countries = "";

          if (isset($_GET['country'])) {
            $countries = $_GET['country'];
          }else{
              $countries = $country_id;
          }

          ?>
          <div class="form-body">
            <div class="row align-items-center">
              <div class="col-md">
                <div class="form-group my-3">
                  {{ Form::label('Select Country','Select Country',array('class'=>'text-bold'))}}
                  <select class="form-control selectpicker show-tick" data-container="body" title="Select Country" name="country" id="country" data-width="full" data-live-search="true">
                    <option value="">Select Country</option>
                    <?php
                    if (!empty($getallcountry->toarray())) {
                      foreach ($getallcountry as $country) {
                    ?>
                        <option value="<?php echo $country->id; ?>" <?php if ($country->id == $countries) {
                                                                      echo 'selected';
                                                                    } ?>>
                          <?php echo ucwords($country->name); ?> </option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-md-auto align-self-end">
                <button class="btn btn-sm my-3 btn-success text-uppercase"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
              </div>
              <div class="col-md-auto align-self-end">
                <a href="{{action('StatecityController@get_states')}}" class="btn btn-sm my-3 btn-warning text-uppercase"><i class="far fa-undo"></i>&nbsp; Reset</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header"> View State </div>
  <div class="card-body">

    <div class="datatable table-responsive">
      <table class="table table-bordered table-striped table-hover text-nowrap" id="dataTable1" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th class="text-align-center" width="50">
              S. No</th>
            <th>
              State name</th>
            <th>
              Action</th>

          </tr>
        </thead>
        <tbody>
          <?php
          if (!empty($getallstates)) {
            $j = 0;
            $sno = 1;
            foreach ($getallstates as $states) {  ?>
              <tr>
                <td class="font-weight-bold">
                  <?php echo $sno; ?>
                </td>
                <td>
                  <?php echo $states->name; ?>
                </td>
                <td>
                  <?php
                  $confirm = "return confirmation('Are you sure ?')";
                  $dis = action('StatecityController@updatestatus', [($states->id), '0']);
                  $ena = action('StatecityController@updatestatus', [($states->id), '1']);
                  if ($states->status == '0') {
                    $Status = '<a class="btn btn-sm mx-1 btn-outline-danger" href="' . $ena . '" onclick="' . $confirm . '">Enable</a>';
                  } else {
                    $Status = '<a class="btn btn-sm mx-1 btn-danger" href="' . $dis . '" onclick="' . $confirm . '">Disable</a>';
                  }
                  ?>
                  <div class="d-flex"> <?php echo $Status; ?>
                    <a class="btn btn-sm w-35px h-35px d-grid p-0 align-items-center justify-content-center mx-1 btn-info" aria-label="View" data-balloon-pos="up" href="<?php echo action('StatecityController@get_city', 'state' . '=' . $states->id) ?>">
                      <i class="fas fa-eye"></i>
                    </a>
                    <button type="button" class="btn btn-sm w-35px h-35px d-grid p-0 align-items-center justify-content-center mx-1 btn-success" data-toggle="modal" data-target="#exampleModalCenter{{ $states->id }}" aria-label="Edit" data-balloon-pos="up">
                    <i class="fad fa-pencil"></i>
                    </button>
                    <div class="modal fade" id="exampleModalCenter{{ $states->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter{{ $states->id }}Title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Course</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="container">
                                <form action="{{ action('StatecityController@edit_state')}}" class="form" enctype="multipart/form-data" method="post">                                
                                    {{ csrf_field() }}
                                    <input type="hidden" class="form-control" value="{{ $states->id }}" name="id">

                                      <input type="text" class="form-control" value="{{ $states->name }}" name="name" required placeholder="Enter course name">
                                      
                                      <input type="submit" class="btn btn-sm btn-primary btn-sm btn-block my-2" value="Update">
                                  </form>
                              </div>
                            </div>
                            </div>
                          </div>
                    </div>
                  </div>
                </td>
              </tr>

            <?php $sno++;
            }

          } else { ?>
            <td colspan="5" style="text-align:center;">No data available</td>
          <?php } ?>
        </tbody>
        <tfoot>
          <tr>
            <th class="text-align-center" width="50">
              S. No</th>
            <th>
              State Name</th>
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




<script>
  $('.alert').delay(3000).fadeOut();
</script>

<script>
$('#dataTable1').dataTable({
    "paging": true,
    "searching": false,
    "LengthChange": false,
    "Filter": false,
    "Info": false,
    "showNEntries" : false,
    
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
</script>

@endsection