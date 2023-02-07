@extends('main')

@section('heading')
    Offers
@endsection('heading')

@section('sub-heading')
    View All Offers
@endsection('sub-heading')

@section('card-heading-btn')
<a  href="<?php echo action('OffersController@addOffer') ?>" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right"><i class="fa fa-plus"></i>&nbsp; Add Offers</a>
@endsection('card-heading-btn')

@section('content')




<div class="card mb-4">
    <div class="card-header">View All Offers</div>
    <div class="card-body">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.css">
        <div class="datatable table-responsive">

        @include('alert_msg')

            <table class="table table-bordered table-hover text-nowrap" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sno.</th>
                        <th>Title</th>
                        <th data-toggle="tooltip" title="Minimum Amount">Min. Amt</th>
                        <th data-toggle="tooltip" title="Maximum Amount">Max. Amt</th>
                        <th>Bonus</th>
                        <th>Offer Code</th>
                        <th>Type</th>
                        <th>Max Used</th>
                        <th>Start Date</th>
                        <th>Expire Date</th>
                        <th>Is Shown</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                       <th>Sno.</th>
                        <th>Title</th>
                        <th data-toggle="tooltip" title="Minimum Amount">Min. Amt</th>
                        <th data-toggle="tooltip" title="Maximum Amount">Max. Amt</th>
                        <th>Bonus</th>
                        <th>Offer Code</th>
                        <th>Type</th>
                        <th>Max Used</th>
                        <th>Start Date</th>
                        <th>Expire Date</th>
                        <th>Is Shown</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
              <?php if(!empty($findoffers)){ ?>
                  <?php $sno=1;?>
                  <?php foreach($findoffers as $player){?>
                    
                    @php
                        $confirm = "return confirmation('Are you sure?') ";
                    
                        $new_status = ($player->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('OffersController@deleteoffer',base64_encode(serialize($player->id))) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('OffersController@deleteoffer',base64_encode(serialize($player->id))) . '" onclick="' . $confirm . '">Enable</a>';
                    @endphp

                    <tr role="row" class="odd">
                    <td class="sorting_1"><?php echo $sno;?></td>
                    <td class="sorting_1"><?php echo $player->title;?></td>
                    <td class="sorting_1"><?php echo $player->minamount;?></td>
                    <td class="sorting_1"><?php echo $player->maxamount;?></td>
                    <td class="sorting_1"><?php echo $player->bonus;?></td>
                    <td class="sorting_1"><?php echo $player->offercode;?></td>
                    <td class="sorting_1"><?php echo $player->bonus_type;?></td>
                    <td class="sorting_1"><?php echo $player->user_time;?></td>
                    
                    <td class="sorting_1"><?php echo $player->start_date;?></td>
                    <td class="sorting_1"><?php echo $player->expire_date;?></td>
                    <td class="sorting_1"><?php echo $player->is_shown;?></td>
                    <td>
                      <a href="<?php echo action('OffersController@editoffer',base64_encode(serialize($player->id)))?>" class="btn btn-sm btn-primary w-35px h-35px text-uppercase"><i class ='fas fa-pencil'></i></a>
                      <?php
                            $onclick = "delete_sweet_alert('".action('OffersController@deleteoffer',base64_encode(serialize($player->id)))."', 'Are you sure you want to delete this data?')";
                        ?>
                      @php echo $new_status; @endphp</div>
                   </td>
                </tr>
                <?php $sno++; } ?>
                <?php } else{
                  ?>
                  <tr role="row" class="odd">
                  <td colspan="8" class="text-center">No Results Available</td>
                  </tr>
                  <?php
                }?>
            </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.js"></script>
<script>

    $('#dataTable').DataTable({
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
@endsection('content')
