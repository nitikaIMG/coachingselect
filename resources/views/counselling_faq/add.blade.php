@extends('main')

@section('heading')
    Counselling FAQs
@endsection('heading')

@section('sub-heading')
    Add New Counselling Faq
@endsection('sub-heading')

@section('card-heading-btn')
<a  href="<?php echo action('CounsellingFaqController@view_counselling_faq') ?>" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="View All Counselling Faq"><i class="fa fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')


<div class="card">
    <div class="card-header">
        <div class="col">Add New Counselling Faq</div>
        <div class="col-auto">
            <div class="row">
                <div class="col-auto px-0">
                    <input type='button' value='Add More' id='addButton' class="btn btn-sm btn-outline-primary font-weight-bold text-uppercase text-primary float-right" />
                </div>
                <div class="col-auto pl-1">
                    <input type='button' value='Remove' id='removeButton' class="btn btn-sm btn-outline-primary font-weight-bold text-uppercase text-primary float-right" />
                </div>
            </div>
        </div>
    </div>
      {{ Form::open(array('action' => 'CounsellingFaqController@add_counselling_faq', 'method' => 'post','id' => 'j-forms','class'=>'j-forms','enctype'=>'multipart/form-data'))}}

          {{csrf_field()}}

        @include('alert_msg')

        <div class="card-body">
            <div class="sbp-preview">
                <div class="sbp-preview-content p-2">
                    <div class="row mx-0">
                        
                        <div class="col-12">
                            <div class="form-horizontal">
                                <div class="control-group">
                                    <div class="row add-mores">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Question</label>
                                                <input type="text" class="form-control" name="faq[0][name]" required placeholder="Enter question"
                                                autocomplete="off" type="text" id="firstspaceremove">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Answer</label>
                                                <input type="text" class="form-control" name="faq[0][value]" required placeholder="Enter answer"
                                                autocomplete="off" type="text" id="firstspaceremove">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>     
                        
                        <div class="col-12 text-right mt-4 mb-2">
                          <button class="btn btn-sm btn-success text-uppercase"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    {{ Form::open() }}
</div>


<script>

    $(document).on('input', '.fee', function() {

        var data_id = $(this).data('fee');
    
        var fee = $('[data-fee=' + data_id + ']');
        var percentage = $('[data-percentage=' + data_id + ']');
        var discount = $('[data-discount=' + data_id + ']');
        var price = $('[data-price=' + data_id + ']');

        final_price(fee, percentage, discount, price);
    });

    $(document).on('input', '.percentage', function() {

        var data_id = $(this).data('percentage');
    
        var fee = $('[data-fee=' + data_id + ']');
        var percentage = $('[data-percentage=' + data_id + ']');
        var discount = $('[data-discount=' + data_id + ']');
        var price = $('[data-price=' + data_id + ']');

        final_price(fee, percentage, discount, price);
    });

    function final_price(fee, percentage, discount, price) {
        
        if(fee.val() == '') {
            swal.fire('Please enter fee');

            fee.val('');
            percentage.val('');
            discount.val('');
            price.val('');
            return false;
        }

        if(percentage.val() == '' && fee.val() != '') {
            price.val(fee.val());

            return;
        }

        var discount_price = (fee.val() * percentage.val()) / 100;
        var final_price = (fee.val() - discount_price);
        
        discount.val(discount_price);
        price.val(final_price);
    }

</script>


<!-- add remove products -->

<script>
    $(document).ready(function() {

        $("#addButton").click(function() {

            var id = ($('.form-horizontal .control-group').length + 1).toString();
            $('.form-horizontal').append(`<div class="control-group">
                <div class="row add-mores">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Question</label>
                            <input type="text" class="form-control" name="faq[${(id-1)}][name]" required placeholder="Enter question"
                            autocomplete="off" type="text" id="firstspaceremove">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Answer</label>
                            <input type="text" class="form-control" name="faq[${(id-1)}][value]" required placeholder="Enter answer"
                            autocomplete="off" type="text" id="firstspaceremove">
                        </div>
                    </div>
                </div>
            </div>`);
            
        });

        $("#removeButton").click(function() {
            if ($('.form-horizontal .control-group').length == 1) {
                Swal.fire("No more to remove");
                return false;
            }

            $(".form-horizontal .control-group:last").remove();
        });
    });
</script>
@endsection('content')
