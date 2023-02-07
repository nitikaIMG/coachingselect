@extends('main')

@section('heading')
    Plans
@endsection('heading')

@section('sub-heading')
    Edit plan
@endsection('sub-heading')

@section('card-heading-btn')
    <a href="<?php echo action('PlanController@view_plan'); ?>"
        class="btn btn-sm btn-light font-weight-bold text-uppercase mr-2 text-primary float-right" data-toggle="tooltip"
        title="View All Plan"><i class="fas fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

    <div class="card">
        <div class="card-header">Edit Plan</div>
        <?php $plan_id = $plan->id; ?>
        <form class="card-body"
            action="<?php echo action('PlanController@update_plan', base64_encode(serialize($plan_id))); ?>"
            method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            @include('alert_msg')

            <input type="hidden" name="id" value="{{$plan->id}}" required>

            <div class="sbp-preview">
                <div class="sbp-preview-content">
                    <div class="row mx-0">
                        <div class="col-12">
                            <div class="form-group my-3">
                                <label for="job-title">Type*</label>
                                <select name="plan[0][type]" class="form-control form-control-solid selectpicker show-tick"
                                    data-container="body" data-live-search="true" title="Select Theme"
                                    data-hide-disabled="true" id="select_type" required>
                                    <option value="" disabled>Select Type</option>
                                    <option value="3 Months" <?php if ($plan->type == '3 Months') {
                                        echo 'selected';
                                        } ?>>3 Months</option>
                                    <option value="6 Months" <?php if ($plan->type == '6 Months') {
                                        echo 'selected';
                                        } ?>>6 Months</option>
                                    <option value="Month" <?php if ($plan->type == 'Month') {
                                        echo 'selected';
                                        } ?>>Month</option>
                                    <option value="Year" <?php if ($plan->type == 'Year') {
                                    echo 'selected';
                                    } ?>>Year</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Plan Name</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="plan[0][name]" 
                                    placeholder="Enter Plan Name"
                                    required
                                    value="{{$plan->name}}"
                                    >
                            </div>
                        </div>   

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Fee</label>
                                <input type="tel" class="form-control fee" name="plan[0][fee]" placeholder="Enter fee in ₹" required data-fee="0" value="{{$plan->fee}}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                            </div>
                        </div>                        

                        <div class="row col-12">
                            <div class="col">
                                <div class="form-group">
                                    <label class="control-label">Specification</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="row">
                                    <div class="col-auto px-0">
                                        <input type='button' value='Add More' id='addButton' class="btn btn-sm btn-outline-primary font-weight-bold text-uppercase text-primary float-right" />
                                    </div>
                                    <div class="col-auto pl-1">
                                        <input type='button' value='Remove' id='removeButton' class="btn btn-sm btn-outline-primary font-weight-bold text-uppercase text-primary float-right"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 form-horizontal">
                            
                            @if( !empty($plan_specification) )
                                
                                @php
                                    $i = 0;
                                @endphp

                                @foreach($plan_specification as $specification)
                                
                                <div class="control-group">
                                    <div class="row add-mores">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Name</label>
                                                <input type="text" class="form-control" name="specification[{{$i}}][name]" required placeholder="Enter name"
                                                autocomplete="off" type="text" value="{{$specification->name}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        
                                    @php
                                        $i += 1;
                                    @endphp
                                @endforeach
                            @endif

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

<!-- add remove plan -->

<script>
    $(document).ready(function() {

        $("#addButton").click(function() {

            var id = ($('.form-horizontal .control-group').length + 1).toString();
            $('.form-horizontal').append(`<div class="control-group">
                <div class="row add-mores">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input type="text" class="form-control" name="specification[${(id-1)}][name]" required placeholder="Enter name"
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