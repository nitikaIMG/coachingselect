@extends('main')

@section('heading')
    Counsellings
@endsection('heading')

@section('sub-heading')
    Edit Counselling
@endsection('sub-heading')

@section('card-heading-btn')
    <a href="<?php echo action('CounsellingController@view_counselling'); ?>"
        class="btn btn-sm btn-light font-weight-bold text-uppercase mr-2 text-primary float-right" data-toggle="tooltip"
        title="View All Counselling"><i class="fas fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

    <div class="card">
        <div class="card-header">Edit Counselling</div>
        <?php $counselling_id = $counselling->id; ?>
        <form class="card-body"
            action="<?php echo action('CounsellingController@update_counselling', base64_encode(serialize($counselling_id))); ?>"
            method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            @include('alert_msg')

            <input type="hidden" name="id" value="{{$counselling->id}}" required>

            <div class="sbp-preview">
                <div class="sbp-preview-content">
                    <div class="row mx-0">
                        <div class="col-12">
                            <div class="form-group my-3">
                                <label for="job-title">Type*</label>
                                <select name="counselling[0][type]" class="form-control form-control-solid selectpicker show-tick"
                                    data-container="body" data-live-search="true" title="Select Theme"
                                    data-hide-disabled="true" id="select_type" required>
                                    <option value="" disabled>Select Type</option>
                                    <option value="Career after X" <?php if ($counselling->type == 'Career after X') {
                                        echo 'selected';
                                        } ?>>Career after X</option>
                                    <option value="Career after XII" <?php if ($counselling->type == 'Career after XII') {
                                        echo 'selected';
                                        } ?>>Career after XII</option>
                                    <option value="Career after graduation" <?php if ($counselling->type == 'Career after graduation') {
                                        echo 'selected';
                                        } ?>>Career after graduation</option>
                                    <option value="Customize Counselling" <?php if ($counselling->type == 'Customize Counselling') {
                                        echo 'selected';
                                        } ?>>Customize Counselling</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Counselling Name</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="counselling[0][name]" 
                                    placeholder="Enter Counselling Name"
                                    required
                                    value="{{$counselling->name}}"
                                    >
                            </div>
                        </div>   

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Fee</label>
                                <input type="tel" class="form-control fee" name="counselling[0][fee]" placeholder="Enter fee" required data-fee="0" value="{{$counselling->fee}}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Offer Percentage</label>
                                <input class="form-control percentage" name="counselling[0][offer_percentage]" placeholder="Enter offer percentage" minlength="1" maxlength="5" type="tel"
                                data-percentage="0" value="{{$counselling->offer_percentage}}"
                                onkeyup="javascript: if( ! (this.value >= 0 && this.value <= 100) ) this.value = '';"
                                >
                            </div>
                        </div>     

                        @php
                            $discount_price = ($counselling->fee * $counselling->offer_percentage) / 100;
                            $final_price = ($counselling->fee - $discount_price);
                        @endphp                                
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Discount Price</label>
                                <input class="form-control price" placeholder="Enter Discount Price" minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" readonly data-discount="0" value="{{$discount_price}}">
                            </div>
                        </div> 
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Final Price</label>
                                <input class="form-control price" placeholder="Enter Final Price" required minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" readonly data-price="0" value="{{$final_price}}">
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
                            
                            @if( !empty($counselling_specification) )
                                
                                @php
                                    $i = 0;
                                @endphp

                                @foreach($counselling_specification as $specification)
                                
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
                    
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Short Description</label>

                                <textarea name="counselling[0][short_description]" class="form-control" placeholder="Enter short description">{{$counselling->short_description ?? ''}}</textarea>
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
        
        if( ! (percentage.val() >= 0 && percentage.val() <= 100) ) {
            
            percentage.val('');
            discount.val('');
            price.val(fee.val());
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