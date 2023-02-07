@extends('main')

@section('heading')
    Counselling FAQs
@endsection('heading')

@section('sub-heading')
    Edit Counselling Faq
@endsection('sub-heading')

@section('card-heading-btn')
    <a href="<?php echo action('CounsellingFaqController@view_counselling_faq'); ?>"
        class="btn btn-sm btn-light font-weight-bold text-uppercase mr-2 text-primary float-right" data-toggle="tooltip"
        title="View All Counselling Faq"><i class="fas fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

    <div class="card">
        <div class="card-header">Edit Counselling Faq</div>
        <?php $counselling_faq_id = $counselling_faq->id; ?>
        <form class="card-body"
            action="<?php echo action('CounsellingFaqController@update_counselling_faq', base64_encode(serialize($counselling_faq_id))); ?>"
            method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            @include('alert_msg')

            <input type="hidden" name="id" value="{{$counselling_faq->id}}" required>

            <div class="sbp-preview">
                <div class="sbp-preview-content">
                    <div class="row mx-0">
                        
                        <div class="col-12 form-horizontal">
                                @php
                                    $i = 0;
                                @endphp

                            <div class="control-group">
                                <div class="row add-mores">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <input type="text" class="form-control" name="faq[{{$i}}][name]" required placeholder="Enter name"
                                            autocomplete="off" type="text" value="{{$counselling_faq->name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Value</label>
                                            <input type="text" class="form-control" name="faq[{{$i}}][value]" required placeholder="Enter value"
                                            autocomplete="off" type="text" value="{{$counselling_faq->value}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                                   
                        </div>      
                    

                    </div>

                <div class="col-12 text-right mt-4 mb-2">
                    <button class="btn btn-sm btn-success text-uppercase"><i
                            class="far fa-check-circle"></i>&nbsp;Submit</button>
                </div>
            </div>
    </form>
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

<!-- add remove counselling -->

<script>
    $(document).ready(function() {

        $("#addButton").click(function() {

            var id = ($('.form-horizontal .control-group').length + 1).toString();
            $('.form-horizontal').append(`<div class="control-group">
                <div class="row add-mores">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input type="text" class="form-control" name="faq[${(id-1)}][name]" required placeholder="Enter name"
                            autocomplete="off" type="text">
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