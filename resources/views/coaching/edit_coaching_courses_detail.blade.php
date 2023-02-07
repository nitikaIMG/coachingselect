@extends('main')

@section('heading')
Coachings
@endsection('heading')

@section('sub-heading')
Edit Coaching
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{ action('CoachingController@view_coaching_courses_detail', 'id='.$coaching_courses_detail->coaching_id) }}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View Courses details"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">
        <div class="row mx-0 w-100">
            <div class="col">Edit Coaching ("{{ $coaching_name }}") Courses (Detail)</div>
        </div>
    </div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">


                <form action="{{ action('CoachingController@edit_coaching_courses_detail') }}" method="post" enctype="multipart/form-data" id="branch">
                    @csrf

                    <input type="hidden" name="id" value="{{$coaching_courses_detail->id}}" required>

                    <div class="card-body p-0">

                        <div class="form-horizontal">
                            <div class="control-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Stream</label>
                                            <select name="stream_id" id="stream_id" class="form-control selectpicker show-tick streams" data-width="full" data-container="body"
                                            data-live-search="true"
                                            required
                                            data-id="0"
                                            onchange="show_courses(this)"
                                            >
                                                <option value=""  disabled>Select Stream</option>
                                                @if( !empty($streams) )
                                                @foreach($streams as $stream)
                                                <option value="{{$stream->id}}"
                                                    @if($coaching_courses_detail->stream_id == $stream->id)
                                                        selected
                                                    @endif
                                                >{{$stream->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Course</label>
                                            <select name="course_id" id="course_id" class="form-control selectpicker show-tick" data-width="full" data-container="body"
                                            data-live-search="true"
                                            required                                            
                                            data-id="course_id_0"
                                            >
                                                <option value="" selected disabled>Select Course</option>
                                                @if( !empty($courses) )
                                                @foreach($courses as $course)
                                                <option value="{{$course->id}}"
                                                    @if($coaching_courses_detail->course_id == $course->id)
                                                        selected
                                                    @endif
                                                >{{$course->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{$coaching_courses_detail->name}}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Offering</label>
                                            <select name="offering[]" id="offering[]" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                                <option value="">Select Offering</option>
                                                <option value="online"
                                                    @if( preg_match('/online/', $coaching_courses_detail->offering) )
                                                        selected
                                                    @endif
                                                >Online</option>
                                                <option value="classroom"
                                                    @if( preg_match('/classroom/', $coaching_courses_detail->offering) )
                                                        selected
                                                    @endif
                                                >Classroom</option>
                                            </select>
                                        </div>
                                    </div>   
                                            
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Targeting</label>
                                            <textarea class="form-control" name="targeting" 
                                            id="targeting"
                                            placeholder="Enter Targeting" >{{$coaching_courses_detail->targeting}}</textarea>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <textarea class="form-control" name="description" 
                                            id="description"
                                            placeholder="Enter description" >{{$coaching_courses_detail->description}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Batch Details</label>
                                            <textarea class="form-control" name="batch_details" 
                                            id="batch_details"
                                            placeholder="Enter batch details" >{{$coaching_courses_detail->batch_details}}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Duration</label>
                                            <input type="text" class="form-control" name="duration" placeholder="Enter duration"  value="{{$coaching_courses_detail->duration}}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Fee</label>
                                            <input type="tel" class="form-control fee" name="fee" placeholder="Enter fee" data-fee="0" value="{{$coaching_courses_detail->fee}}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Registration Fee</label>
                                            <input type="tel" class="form-control fee" name="registration_fee" placeholder="Enter registration fee"  data-fee="0" value="{{$coaching_courses_detail->registration_fee}}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Offer Percentage</label>
                                            <input class="form-control percentage" name="offer_percentage" placeholder="Enter offer percentage"  minlength="1" maxlength="5" type="tel"
                                            data-percentage="0" value="{{$coaching_courses_detail->offer_percentage}}"
                                            onkeyup="javascript: if( ! (this.value >= 0 && this.value <= 100) ) this.value = '';"
                                            >
                                        </div>
                                    </div>     

                                    @php
                                        $discount_price = ($coaching_courses_detail->fee * $coaching_courses_detail->offer_percentage) / 100;
                                        $final_price = ($coaching_courses_detail->fee - $discount_price);
                                    @endphp                                
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Discount Price</label>
                                            <input class="form-control price" placeholder="Enter Discount Price"  minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" readonly data-discount="0" value="{{$discount_price}}">
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Final Price</label>
                                            <input class="form-control price" placeholder="Enter Final Price"  minlength="10" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="tel" readonly data-price="0" value="{{$final_price}}">
                                        </div>
                                    </div> 

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Gst Inclusive Exclusive</label>
                                            <select name="gst_inclusive_exclusive" id="gst_inclusive_exclusive"  class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                                <option value="" disabled selected>Select Gst Inclusive Exclusive</option>
                                                <option value="inclusive"
                                                    @if($coaching_courses_detail->gst_inclusive_exclusive == 'inclusive')
                                                        selected
                                                    @endif
                                                >Inclusive</option>
                                                <option value="exclusive"
                                                    @if($coaching_courses_detail->gst_inclusive_exclusive == 'exclusive')
                                                        selected
                                                    @endif
                                                >Exclusive</option>
                                            </select>
                                        </div>
                                    </div> 

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Select Fee Type</label>
                                            <select name="fee_type" id="fee_type"  class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                                <option value="" disabled selected>Select Fee Type</option>
                                                
                                                <option value="lumpsum"
                                                    @if($coaching_courses_detail->fee_type == 'lumpsum')
                                                        selected
                                                    @endif
                                                >Lumpsum</option>
                                                <option value="installment"
                                                    @if($coaching_courses_detail->fee_type == 'installment')
                                                        selected
                                                    @endif
                                                >Installment</option>
                                            </select>
                                        </div>
                                    </div> 

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Is Paid</label>
                                            <select name="is_paid" id="is_paid"  class="form-control selectpicker show-tick" data-width="full" 
                                            
                                            data-container="body" data-live-search="true">
                                                <option value="">Select Is Paid</option>
                                                <option value="yes" @if($coaching_courses_detail->is_paid == 'yes')
                                                    selected
                                                    @endif
                                                    >Yes</option>
                                                <option value="no" @if($coaching_courses_detail->is_paid == 'no')
                                                    selected
                                                    @endif
                                                    >No</option>
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

@endsection