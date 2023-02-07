@extends('main')

@section('heading')
Colleges
@endsection('heading')

@section('sub-heading')
View College Video
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CollegeController@view_college')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View All College"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card mb-3 d-none">
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
            <div class="row align-items-end ">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header"> View College Video </div>
  <div class="card-body">

    <div class="datatable table-responsive">
      <table class="table table-bordered table-striped table-hover text-nowrap" id="view_Exam_dt" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th class="text-align-center" width="50">
              S. No</th>
            <th>
              Video</th>
            <th>
              Action</th>

          </tr>
        </thead>
        <tbody>
          <?php
          if (!empty($getimage->videos)) {
            $vid = explode('{$}', $getimage->videos);
            $j = 0;
            $sno = 1;
            foreach ($vid as $key => $vidss) {  ?>
            
              @if( !empty($vidss) )
              <tr>
                <td class="font-weight-bold">
                  <?php echo $sno; ?>
                </td>
                <td>
                  <video width="300" height="200" controls>
                    <source src="<?php echo asset('public/college_video/' . $vidss) ?>" type="video/mp4"> </video>
                </td>
                <td>
                  <a href="{{asset('coaching_admin/delete_colgvideo/'.$key.'/'.$cid)}}" onclick="return confirmation(`Do you want to delete Video?`);" class="btn-sm btn-danger btn">Delete</a>
                </td>
              </tr>

            <?php $sno++;
              $j++; ?>

              @endif
            <?php
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
              Video</th>
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

@endsection