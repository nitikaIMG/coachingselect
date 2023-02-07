@extends('main')

@section('heading')
    Counsellings
@endsection('heading')

@section('sub-heading')
    Add New Counselling
@endsection('sub-heading')

@section('card-heading-btn')
<a  href="<?php echo action('CounsellingController@view_counselling') ?>" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="View All Counselling"><i class="fa fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')


<div class="card">
    <div class="card-header">Add New Counselling</div>
      {{ Form::open(array('action' => 'CounsellingController@add_counselling', 'method' => 'post','id' => 'j-forms','class'=>'j-forms','enctype'=>'multipart/form-data'))}}

          {{csrf_field()}}

        @include('alert_msg')

        <div class="card-body">
            <div class="sbp-preview">
                <div class="sbp-preview-content p-2">
                    <div class="row mx-0">
                        <div class="col-12">
                            <div class="form-group my-3">
                                <label for="type">Type*</label>
                                <select name="counselling[0][type]" class="form-control form-control-solid selectpicker show-tick" data-container="body" data-live-search="true" title="Select Type" data-hide-disabled="true" required >
                                    <option value="" disabled>Select Type</option>
                                    <option value="Career after X">Career after X</option>
                                    <option value="Career after XII">Career after XII</option>
                                    <option value="Career after graduation">Career after graduation</option>
                                    <option value="Customize Counselling">Customize Counselling</option>
                                    
                                </select>
                            </div>
                        </div>    
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Counselling Name</label>
                                <input type="text" class="form-control" name="counselling[0][name]" placeholder="Enter Counselling Name" id="firstspaceremove" required>
                            </div>
                        </div>  

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Fee</label>
                                <input type="tel" class="form-control fee" name="counselling[0][fee]" placeholder="Enter fee" required data-fee="0" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Offer Percentage</label>
                                <input class="form-control percentage" name="counselling[0][offer_percentage]" placeholder="Enter offer percentage" minlength="1" maxlength="5" type="tel"
                                data-percentage="0"
                                onkeyup="javascript: if( ! (this.value >= 0 && this.value <= 100) ) this.value = '';"
                                >
                            </div>
                        </div>                                     
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Discount Price</label>
                                <input class="form-control price" placeholder="Enter Discount Price" minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" readonly data-discount="0">
                            </div>
                        </div> 
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Final Price</label>
                                <input class="form-control price" placeholder="Enter Final Price" required minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" readonly data-price="0">
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
                        <div class="col-12">
                            <div class="form-horizontal">
                                <div class="control-group">
                                    <div class="row add-mores">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Name</label>
                                                <input type="text" class="form-control" name="specification[0][name]" required placeholder="Enter name"
                                                autocomplete="off" id="firstspaceremove" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>     
                    
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Short Description</label>

                                <textarea name="counselling[0][short_description]" class="form-control" placeholder="Enter short description" id="firstspaceremove"></textarea>
                            </div>
                        </div>              
                        
                        <div class="col-12 text-right mt-4 mb-2">
                          <button class="btn btn-sm btn-success text-uppercase"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}
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


<!-- add remove products -->

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
