@extends('main')

@section('heading')
    Counselling FAQs
@endsection('heading')

@section('sub-heading')
    View All Counselling Faq
@endsection('sub-heading')

@section('card-heading-btn')
<a  href="<?php echo action('CounsellingFaqController@counselling_faq') ?>" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="Add New Counselling"><i class="fa fa-plus"></i>&nbsp; Add</a>
@endsection('card-heading-btn')

@section('content')



@include('alert_msg')

<div class="card mb-4">
    <div class="card-header">View All Counselling Faq</div>
    <div class="card-body">
        <div class="datatable table-responsive">
            <table class="table table-bordered table-striped table-hover text-center text-nowrap" id="datatabledd" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sno.</th>
                        <th>
                            Question</th>
                        <th>
                            Answer</th>
                        <th>
                            Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Sno.</th>
                        <th>
                            Question</th>
                        <th>
                            Answer</th>
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


        $('#datatabledd').DataTable({
             "processing": true,
             "sAjaxSource":'<?php echo asset('coaching_admin/view_counselling_faq_table');?>?',
             "dom": 'lBfrtip',
             "buttons": [
                {
                    extend: 'collection',
                    text: 'Export',
                    buttons: [
                        'copy',
                        'excel',
                        'csv',
                        'pdf',
                        'print'
                    ]
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
            $("#datatabledd_filter").hide();

});
</script>

@endsection('content')
