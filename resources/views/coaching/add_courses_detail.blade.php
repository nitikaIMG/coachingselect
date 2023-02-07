@extends('main')

@section('heading')
Coachings ("{{ $coaching_name }}")
@endsection('heading')

@section('sub-heading')
Add Coaching
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CoachingController@view_coaching')}}" class="btn btn-sm btn-primary mx-1" data-toggle="tooltip" title="" data-original-title="View Coaching"><i class="fad fa-eye"></i>&nbsp; View Coaching</a>
<a href="{{ action('CoachingController@view_coaching_courses_detail', 'id='.$coaching_id) }}" class="btn btn-sm btn-primary mx-1" data-toggle="tooltip" title="" data-original-title="View Courses detail"><i class="fad fa-eye"></i>&nbsp; View Courses detail</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">
        <div class="row mx-0 w-100">
            <div class="col">Add Coaching ("{{ $coaching_name }}") Courses (Detail)</div>
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
    </div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">


                <form action="{{ action('CoachingController@add_courses_detail') }}" method="post" enctype="multipart/form-data" id="branch">
                    @csrf

                    <input type="hidden" name="coaching_id" value="{{$coaching_id}}" required>

                    <div class="card-body p-0">


                                <div class="form-horizontal">
                                    <div class="control-group">
                                        <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Stream</label>
                                            <select name="courses_detail[0][stream_id]" id="courses_detail[0][stream_id]" class="form-control selectpicker show-tick streams" data-width="full" data-container="body"
                                            data-live-search="true"
                                            required
                                            data-id="0"
                                            onchange="show_courses(this)"
                                            >
                                                <option value="" selected disabled>Select Stream</option>
                                                @if( !empty($streams) )
                                                @foreach($streams as $stream)
                                                <option value="{{$stream->id}}">{{$stream->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Course</label>
                                            <select name="courses_detail[0][course_id]" id="courses_detail[0][course_id]" class="form-control selectpicker show-tick" data-width="full" data-container="body"
                                            data-live-search="true"
                                            required                                            
                                            data-id="course_id_0"
                                            >
                                                <option value="" selected disabled>Select Course</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Course Name</label>
                                            <input type="text" class="form-control" name="courses_detail[0][name]" placeholder="Enter Course Name" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Offering</label>
                                            <select name="courses_detail[0][offering][]" id="courses_detail[0][offering][]" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                                <option value="">Select Offering</option>
                                                <option value="online">Online</option>
                                                <option value="classroom">Classroom</option>        
                                            </select>
                                        </div>
                                    </div>   
                                            
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Targeting</label>
                                            <textarea class="form-control" name="courses_detail[0][targeting]" 
                                            id="courses_detail[0][targeting]"
                                            placeholder="Enter Targeting" ></textarea>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <textarea class="form-control" name="courses_detail[0][description]" 
                                            id="courses_detail[0][description]"
                                            placeholder="Enter description" ></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Batch Details</label>
                                            <textarea class="form-control" name="courses_detail[0][batch_details]" 
                                            id="courses_detail[0][batch_details]"
                                            placeholder="Enter batch details" ></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Duration</label>
                                            <input type="text" class="form-control" name="courses_detail[0][duration]" placeholder="Enter duration" >
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Fee</label>
                                            <input type="tel" class="form-control fee" name="courses_detail[0][fee]" placeholder="Enter fee" data-fee="0" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Registration Fee</label>
                                            <input type="tel" class="form-control fee" name="courses_detail[0][registration_fee]" placeholder="Enter registration fee"  data-fee="0" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Offer Percentage</label>
                                            <input class="form-control percentage" name="courses_detail[0][offer_percentage]" placeholder="Enter offer percentage"  minlength="1" maxlength="5" type="tel"
                                            data-percentage="0" onkeyup="javascript: if( ! (this.value >= 0 && this.value <= 100) ) this.value = '';"
                                            >
                                        </div>
                                    </div>                                     
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Discount Price</label>
                                            <input class="form-control price" placeholder="Enter Discount Price"  minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" readonly data-discount="0">
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Final Price</label>
                                            <input class="form-control price" placeholder="Enter Final Price"  minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" readonly data-price="0">
                                        </div>
                                    </div> 

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Gst Inclusive Exclusive</label>
                                            <select name="courses_detail[0][gst_inclusive_exclusive]" id="courses_detail[0][gst_inclusive_exclusive]"  class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                                <option value="" disabled selected>Select Gst Inclusive Exclusive</option>
                                                <option value="inclusive">Gst Inclusive</option>
                                                <option value="exclusive">Gst Exclusive</option>
                                            </select>
                                        </div>
                                    </div> 

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Select Fee Type</label>
                                            <select name="courses_detail[0][fee_type]" id="courses_detail[0][fee_type]"  class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                                <option value="" disabled selected>Select Fee Type</option>
                                                <option value="lumpsum">Fee in Lumpsum</option>
                                                <option value="installment">Fee in Installment</option>
                                            </select>
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Is Paid</label>
                                            <select name="courses_detail[0][is_paid]" id="courses_detail[0][is_paid]"  class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                                <option value="">Select Is Paid</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                    </div>
                                             
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12 text-right">
                        <button class="btn btn-sm btn-success" type="submit" form="branch">
                        <i class="far fa-check-circle"></i>&nbsp;Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- add remove branch -->

<script>
    $(document).ready(function() {

        $("#addButton").click(function() {

            var id = ($('.form-horizontal .control-group').length + 1).toString();
            $('.form-horizontal').append(`
                <div class="control-group">
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Stream</label>
                                <select name="courses_detail[${(id - 1)}][stream_id]" id="courses_detail[${(id - 1)}][stream_id]" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required
                                data-id="${(id - 1)}"
                                onchange="show_courses(this)"
                                >
                                    <option value="" selected disabled>Select Stream</option>
                                    @if( !empty($streams) )
                                    @foreach($streams as $stream)
                                    <option value="{{$stream->id}}">{{$stream->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Course</label>
                                <select name="courses_detail[${(id - 1)}][course_id]" id="courses_detail[${(id - 1)}][course_id]" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required                              
                                data-id="course_id_${(id - 1)}">
                                    <option value="" selected disabled>Select Course</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <input type="text" class="form-control" name="courses_detail[${(id - 1)}][name]" placeholder="Enter Name" >
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Offering</label>
                                <select name="courses_detail[${(id - 1)}][offering][]" id="courses_detail[${(id - 1)}][offering][]"  class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                    <option value="">Select Offering</option>
                                    <option value="online">Online</option>
                                    <option value="classroom">Classroom</option>
                                </select>
                            </div>
                        </div>   
                                
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Targeting</label>
                                <textarea class="form-control" name="courses_detail[${(id - 1)}][targeting]" 
                                id="courses_detail[${(id - 1)}][targeting]"
                                placeholder="Enter Targeting" ></textarea>
                            </div>
                        </div> 

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea class="form-control" name="courses_detail[${(id - 1)}][description]" 
                                id="courses_detail[${(id - 1)}][description]"
                                placeholder="Enter description" ></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Batch Details</label>
                                <textarea class="form-control" name="courses_detail[${(id - 1)}][batch_details]" 
                                id="courses_detail[${(id - 1)}][batch_details]"
                                placeholder="Enter batch details" ></textarea>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Duration</label>
                                <input type="text" class="form-control" name="courses_detail[${(id - 1)}][duration]" placeholder="Enter duration" >
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Fee</label>
                                <input type="tel" class="form-control fee" name="courses_detail[${(id - 1)}][fee]" placeholder="Enter fee"  data-fee="${(id - 1)}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Registration Fee</label>
                                <input type="tel" class="form-control fee" name="courses_detail[${(id - 1)}][registration_fee]" placeholder="Enter registration fee"  data-fee="${(id - 1)}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Offer Percentage</label>
                                <input class="form-control percentage" name="courses_detail[${(id - 1)}][offer_percentage]" placeholder="Enter offer percentage"  minlength="1" maxlength="5" type="tel"
                                data-percentage="${(id - 1)}" onkeyup="javascript: if( ! (this.value >= 0 && this.value <= 100) ) this.value = '';"
                                >
                            </div>
                        </div>  

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Discount Price</label>
                                <input class="form-control price" placeholder="Enter Discount Price"  minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" readonly data-discount="${(id - 1)}">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Final Price</label>
                                <input class="form-control price" placeholder="Enter Final Price"  minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" readonly
                                data-price="${(id - 1)}"
                                >
                            </div>
                        </div> 
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Gst Inclusive Exclusive</label>
                                <select name="courses_detail[${(id - 1)}][gst_inclusive_exclusive]" id="courses_detail[${(id - 1)}][gst_inclusive_exclusive]"  class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                    <option value="" disabled selected>Select Gst Inclusive Exclusive</option>
                                    <option value="inclusive">Gst Inclusive</option>
                                    <option value="exclusive">Gst Exclusive</option>
                                </select>
                            </div>
                        </div> 

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Select Fee Type</label>
                                <select name="courses_detail[${(id - 1)}][fee_type]" id="courses_detail[${(id - 1)}][fee_type]"  class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                    <option value="" disabled selected>Select Fee Type</option>
                                    <option value="lumpsum">Fee in Lumpsum</option>
                                    <option value="installment">Fee in Installment</option>
                                </select>
                            </div>
                        </div> 
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Is Paid</label>
                                <select name="courses_detail[${(id - 1)}][is_paid]" id="courses_detail[${(id - 1)}][is_paid]"  class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                    <option value="">Select Is Paid</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                                    
                    </div>
                </div>
            `);

            // $(`#courses_detail[${(id - 1)}][gst_inclusive_exclusive]`).selectpicker('refresh');
            // $(`#courses_detail[${(id - 1)}][fee_type]`).selectpicker('refresh');
            // $(`#courses_detail[${(id - 1)}][offering]`).selectpicker('refresh');
            
            $('.selectpicker').selectpicker('refresh');
            
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

<script>
    function show_courses(element) {
        var id = element.dataset.id;

        $.ajax({
            type: 'POST',
            url: '{{action("ExamsController@stream_course")}}',
            data: {
                stream_id: element.value,
                type: 'coaching',
                _token: '{{csrf_token()}}'
            },
            success: function(data) {


                $('[data-id="course_id_' + id + '"]').html(
                    '<option value="">Select Course</option>'
                );

                data.forEach(course => {
                                        
                    $('[data-id="course_id_' + id + '"]').append(
                        '<option value="' + course.id + '">' + course.name + '</option>'
                    );
                });

                $('[data-id="course_id_' + id + '"]').selectpicker('refresh');
            }
        });
    }
</script>

@endsection