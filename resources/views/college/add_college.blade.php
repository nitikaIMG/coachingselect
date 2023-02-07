@extends('main')

@section('heading')
Colleges
@endsection('heading')

@section('sub-heading')
Add College
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CollegeController@view_college')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View All College"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')



@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">Add College</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="{{ action('CollegeController@add_college') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div id="formid">

                    </div>
                    <div class="card-body p-0">

                        <div class="row">
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="control-label">Category</label>
                                    <select name="category" id="category" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required>
                                        <option value="">Select Category</option>
                                        @if( !empty($college_category) )
                                        @foreach($college_category as $category)
                                        <option value="{{$category->name}}">{{$category->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">College Name</label>
                                    <input type="text" class="form-control" name="college_name" placeholder="Enter College Name" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Logo</label>
                                    <input type='file' name="image" id="image" accept=".png" upload-pic="No Choosen File" class="form-control" required />
                                    
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Background Image</label>
                                    <input type='file' name="background_image" id="background_image" accept=".png" upload-pic="No Choosen File" class="form-control" required />
                                    
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Brochure or pdf</label>
                                    <input type="file" class="form-control position-relative p-0" upload-pic="No Choosen File" form="exam" name="brochure_or_pdf">

                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal1" class="upload-pic-view d-none" id="pdf-eye1"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Address </label>
                                    <input type="text" class="form-control" name="address"
                                    id="address"
                                    placeholder="Enter College Address" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('Select Country','Select Country',array('class'=>'text-bold'))}}
                                    <select class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" title="Select Country" name="country_id" id="country_id" required>
                                        <option value="" disabled>Select Country</option>
                                        @if(!empty($allcountry))
                                        @foreach($allcountry as $country)
                                        <option value="{{$country->id}}"> {{$country->name}} </option>
                                        @endforeach
                                        @endif

                                    </select>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('Select State','Select State',array('class'=>'text-bold'))}}
                                    <select class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" title="Select State" name="state_id" id="state_id" required>
                                        <option value="" disabled>Select State</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('Select City','Select City',array('class'=>'text-bold'))}}
                                    <select class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" title="Select City" name="city_id" id="city_id" required>
                                        <option value="" disabled>Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('Recognition','Recognition',array('class'=>'text-bold'))}}
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="recognition" 
                                        placeholder="Enter recognition"
                                    >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Established Year </label>
                                    <select name="year" id="year"  class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true"
                                    
                                    >
                                        <option value="" disabled selected>Select Est Year</option>
                                        
                                        @foreach(range(date('Y'), 1900) as $year)
                                            <option value="{{$year}}">{{$year}}</option>
                                        @endforeach

                                    </select>    
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Total Students Enrollment </label>
                                    <input type="text" class="form-control" name="total_enrollment" placeholder="Enter Total Students Enrollment" autocomplete="off" >
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Courses </label>
                                    <div class="nav nav-pills" id="stream-tab" role="tablist">
                                        @if(!empty($allstream))

                                        <?php $sis = 0; ?>
                                        @foreach($allstream as $streams)
                                        <a class="nav-link mb-1 {{($sis==0)?'active':''}}" id="stream{{$streams->id}}-tab" data-toggle="pill" href="#stream{{$streams->id}}" role="tab" aria-controls="stream{{$streams->id}}" aria-selected="false">{{$streams->name}}</a>
                                        <?php $sis++; ?>
                                        @endforeach
                                        @endif

                                    </div>
                                    
                                    <div class="tab-content" id="stream-tabContent">
                                        @if(!empty($allstream->toArray()))
                                        <?php $si = 0; ?>
                                        @foreach($allstream as $streams)
                                        <div class="tab-pane fade {{($si==0)?'show active':''}}" id="stream{{$streams->id}}" role="tabpanel" aria-labelledby="stream{{$streams->id}}-tab">
                                            @if(!empty($allcourses->toArray()))
                                            @foreach($allcourses as $course)
                                            @if($streams->id==$course->stream_id)
                                               
                                            <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input sel_all checkbox_courses" id="customCheck{{$course->id}}" name="course[{{$streams->id}}][]" value="{{$course->id}}">
                                            <label class="custom-control-label fs-15" for="customCheck{{$course->id}}">{{$course->name}}</label>

                                            <div class="row">
                                                
                                                <div class="col-12 d-flex">
                                                
                                                    <input type="text" class=" mx-1 form-control sel_all" id="customCheck{{$course->id}}" 
                                                    onkeypress="return isNumberKey(event)"
                                                    name="course_fee[{{$streams->id}}][{{$course->id}}]" placeholder="Enter fee"/>
                                                
                                                    <input type="text" class=" mx-1 form-control sel_all" id="customCheck{{$course->id}}" 
                                                    onkeypress="return isNumberKey(event)"
                                                    name="course_seats[{{$streams->id}}][{{$course->id}}]" placeholder="Enter seats"/>
                                                
                                                    <input type="text" class=" mx-1 form-control sel_all" id="customCheck{{$course->id}}" name="course_eligibility[{{$streams->id}}][{{$course->id}}]" placeholder="Enter eligibility "/>
                                                
                                                </div>

                                            </div>

                                            </div>
                                            
                                            @endif
                                            @endforeach
                                            @endif
                                        </div>
                                        <?php $si++; ?>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Featured Course </label>
                                    <div class="nav nav-pills" id="landing-page-stream-tab" role="tablist">
                                        @if(!empty($allstream))

                                        <?php $sis = 0; ?>
                                        @foreach($allstream as $streams)
                                        <a class="nav-link mb-1 {{($sis==0)?'active':''}}" id="landing-page-stream{{$streams->id}}-tab" data-toggle="pill" href="#landing-page-stream{{$streams->id}}" role="tab" aria-controls="landing-page-stream{{$streams->id}}" aria-selected="false">{{$streams->name}}</a>
                                        <?php $sis++; ?>
                                        @endforeach
                                        @endif

                                    </div>
                                    
                                    <div class="tab-content" id="landing-page-stream-tabContent">
                                        @if(!empty($allstream->toArray()))
                                        <?php $si = 0; ?>
                                        @foreach($allstream as $streams)
                                        <div class="tab-pane fade {{($si==0)?'show active':''}}" id="landing-page-stream{{$streams->id}}" role="tabpanel" aria-labelledby="landing-page-stream{{$streams->id}}-tab">
                                            @if(!empty($allcourses->toArray()))
                                            @foreach($allcourses as $course)
                                            @if($streams->id==$course->stream_id)
                                               
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input sel_all" id="landing-page-customCheck{{$course->id}}" name="landing_page_highlight_course" value="{{$course->id}}">
                                                <label class="custom-control-label fs-15" for="landing-page-customCheck{{$course->id}}">{{$course->name}}</label>
                                            </div>
                                            
                                            @endif
                                            @endforeach
                                            @endif
                                        </div>
                                        <?php $si++; ?>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Exams Accepted </label>
                                    <div class="nav nav-pills" id="stream_exams-tab" role="tablist">
                                        @if(!empty($exams))

                                        <?php $sis = 0; ?>
                                        @foreach($exams as $streams)
                                        <a class="nav-link mb-1 {{($sis==0)?'active':''}}" id="stream_exam{{$streams[0]->sid}}-tab" data-toggle="pill" href="#stream_exam{{$streams[0]->sid}}" role="tab" aria-controls="stream_exam{{$streams[0]->sid}}" aria-selected="false">{{$streams[0]->name}}</a>
                                        <?php $sis++; ?>
                                        @endforeach
                                        @endif

                                    </div>
                                    
                                    <div class="tab-content" id="stream_exams-tabContent">
                                        @if(!empty($exams->toArray()))
                                        <?php $si = 0; ?>
                                        @foreach($exams as $streams)
                                        <div class="tab-pane fade {{($si==0)?'show active':''}}" id="stream_exam{{$streams[0]->sid}}" role="tabpanel" aria-labelledby="stream_exam{{$streams[0]->sid}}-tab">
                                            @if(!empty($streams->toArray()))
                                            @foreach($streams as $exam)
                                            @if($streams[0]->sid==$exam->sid)
                                               
                                            <div class="custom-control custom-checkbox">

                                                <input type="checkbox" class="custom-control-input sel_all checkbox_exams" id="customCheckexam{{$exam->id}}" name="exams_accepted[{{$streams[0]->sid}}][]" value="{{$exam->id}}">
                                                <label class="custom-control-label fs-15" for="customCheckexam{{$exam->id}}">{{$exam->title}}</label>
                                            
                                            </div>
                                            
                                            @endif
                                            @endforeach
                                            @endif
                                        </div>
                                        <?php $si++; ?>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Ranking </label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="ranking" 
                                        placeholder="Enter Ratings/Ranking" 
                                        autocomplete="off" >
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Reviews Ratings </label>
                                    <input 
                                    type="tel"
                                    min="1"
                                    max="5"
                                    maxlength="1"
                                    minlength="1"
                                    class="form-control" name="reviews_ratings" placeholder="Enter Reviews Ratings" oninput="this.value = this.value.replace(/[^1-5.]/g, '').replace(/(\..*)\./g, '$1');" autocomplete="off" >
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Campus size </label>
                                    <input type="text" class="form-control" name="campus_area" placeholder="Enter Campus size" autocomplete="off" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">About The College</label>

                                    <textarea name="about_college" class="form-control ckeditor" placeholder="Enter About The College" ></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Admissions</label>

                                    <textarea name="admissions_details" class="form-control ckeditor" placeholder="Enter Admissions" ></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Placements</label>

                                    <textarea name="placement_details" class="form-control ckeditor" placeholder="Enter Placements" ></textarea>
                                </div>
                            </div>



                            <div class="col-md-12">
                                <div class="row align-items-center" id="samefield2">
                                    <div class="col-md-10 form-group">
                                        <label class="control-label">Facilities </label>
                                        <select type="text" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" name="facilities[]" autocomplete="off" placeholder="Select Facilities" >
                                            <option value=""> Select Facilities </option>
                                            <?php if (!empty($allfacility)) { ?>
                                                @foreach($allfacility as $facilities)
                                                <option value="{{$facilities->id}}"> {{$facilities->name}} </option>
                                                @endforeach
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2 align-self-end">
                                        <button type="button" maxlength="5" onclick="addtype2();" class="btn btn-sm my-3 btn-primary btn-block"><b>ADD</b></button>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Photos </label>
                                    <input type="file" class="form-control" upload-pic="No Choosen File" name="images[]" multiple>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row align-items-center" id="samefield3">
                                    <div class="col-md-10 form-group">
                                        <label class="control-label">Video Title </label>
                                        <input name="videos[0][0]" class="form-control form-control-solid " type="text" placeholder="Enter youtube video title" >
                                        <label class="control-label">Video Url </label>
                                        <input name="videos[0][1]" class="form-control form-control-solid " type="url" placeholder="Enter youtube video embed url" >
                                    </div>
                                    <div class="col-md-2 align-self-end">
                                        <button type="button" maxlength="5" onclick="addtype3();" class="btn btn-sm my-3 btn-primary btn-block"><b>ADD</b></button>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Scholarship</label>

                                    <textarea name="scholarship" class="form-control ckeditor" placeholder="Enter Scholarship" ></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Cutoff of Exam</label>

                                    <textarea name="cutoff_of_exam" class="form-control ckeditor" placeholder="Enter Cutoff of Exam" ></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">News & articles</label>

                                    <textarea name="news_and_articles" class="form-control ckeditor" placeholder="Enter News & articles" ></textarea>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Mobile</label>
                                    <input placeholder="Enter Mobile Number" class="form-control form-control-solid"
                                    autocomplete="off" onkeypress="return isNumberKey(event)" pattern="[6789][0-9]{9}" minlength="10" maxlength="10" name="mobile" type="tel">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter email">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Website Link</label>
                                    <input type="url" class="form-control" name="website" placeholder="Enter website link">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Twitter Link</label>
                                    <input type="url" class="form-control" name="twitter" placeholder="Enter twitter link">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Facebook Link</label>
                                    <input type="url" class="form-control" name="facebook" placeholder="Enter facebook link">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Instagram Link</label>
                                    <input type="url" class="form-control" name="instagram" placeholder="Enter instagram link">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Youtube Link</label>
                                    <input type="url" class="form-control" name="youtube" placeholder="Enter youtube link">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Linkedin Link</label>
                                    <input type="url" class="form-control" name="linkedin" placeholder="Enter linkedin link">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col text-bold h6 text-primary mt-2">Faq</div>

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

                        <div class="row">

                            <div class="col-12">
                                <div class="form-horizontal1">
                                    <div class="control-group1">
                                        <div class="row add-mores">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Name</label>
                                                    <input type="text" class="form-control" name="faq[0][name]"  placeholder="Enter name"
                                                    autocomplete="off" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Value</label>
                                                    <input type="text" class="form-control" name="faq[0][value]"  placeholder="Enter value"
                                                    autocomplete="off" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                    
                        </div>

                        <div class="row">
                            
                            <div class="col-12 text-right">
                                <button class="btn btn-sm btn-success" type="submit"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var k = 0;

        function addtype2() {
            k++;
            $('#samefield2').append('<div class="col-md-12"><div class="row" id="dynamic2' + k + '"> <div class="col-md-10 form-group"> <label class="control-label" style="color: black">Facilities</label><select type="text" class="form-control" name="facilities[]" autocomplete="off" placeholder="Select Facilities" id="select' + k + '"> <option value=""> Select Facilities </option> <?php if (!empty($allfacility)) { ?> @foreach($allfacility as $facilities) <option value="{{$facilities->id}}"> {{$facilities->name}} </option> @endforeach <?php } ?> </select> </div>    <div class="col-md-2 align-self-end"> <button class="btn btn-sm btn-danger my-3" onclick="removefield2(' + k + ');" d-block w-100> <b>REMOVE</b> </button></div><br><br></div> </div>');

            $('#select'+k).selectpicker('refresh');
        }

        function removefield2(reid) {
            $('#dynamic2' + reid + '').remove();
        }
    </script>

    <script type="text/javascript">
        var k = 0;

        function addtype3() {
            k++;
            $('#samefield3').append('<div class="col-md-12"><div class="row" id="dynamic3' + k + '"> <div class="col-md-10 form-group"><label class="control-label">Video Title </label><input name="videos[' + k + '][0]" class="form-control form-control-solid " type="text" placeholder="Enter youtube video title" ><label class="control-label">Video Url </label><input name="videos[' + k + '][1]" class="form-control form-control-solid " type="url" placeholder="Enter youtube video embed url" ></div> <div class="col-md-2 align-self-end"> <button class="btn btn-sm btn-danger my-3" type="button" onclick="removefield3(' + k + ');" d-block w-100> <b>REMOVE</b> </button></div><br><br></div> </div>');

        }

        function removefield3(reid) {
            $('#dynamic3' + reid + '').remove();
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#country_id').change(function(e) {
                var x = document.getElementById("country_id").value;
                $.ajax({
                    'type': 'POST',
                    'url': '<?php echo asset('/coaching_admin/get_allstate'); ?>',
                    'data': {
                        _token: "{{csrf_token()}}",
                        x: x
                    },
                    'success': function(data) {
                        $("#state_id").html(data);
                        $('#state_id').selectpicker('refresh');
                    },
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#state_id').change(function(e) {
                var x = document.getElementById("state_id").value;
                $.ajax({
                    'type': 'POST',
                    'url': '<?php echo asset('/coaching_admin/get_allcity'); ?>',
                    'data': {
                        _token: "{{csrf_token()}}",
                        x: x
                    },
                    'success': function(data) {
                        $("#city_id").html(data);
                        $('#city_id').selectpicker('refresh');
                    },
                });
            });
        });
    </script>

    <script>
        var stream = [];
        var st = [];

        function myfunction() {
            var x = document.getElementById("streams_id").value;
            if (st.indexOf(x) == -1) {
                st.push(x);
                stream[x] = [];
                // stream.push(x);
            }

            $.ajax({
                'type': 'post',
                'url': '<?php echo asset('coaching_admin/get_course'); ?>',
                'data': {
                    _token: "{{csrf_token()}}",
                    x: x
                },
                'success': function(data) {

                    $('#course_id').slideDown();
                    var sf = JSON.parse(data);
                    var str = '';
                    // console.log(st);
                    for (i = 0; i < sf.length; i++) {
                        if (stream[x].indexOf(sf[i]["id"]) !== -1) {
                            $('#TABLE').append('<input type="hidden" name="course[' + x + '][]" value="' + sf[i]["id"] + '" id="' + sf[i]["id"] + x + '">');
                            str += '<tr role="row"> <th class="sorting_asc"><input type="checkbox" class="form-control sel_all" style="text-align: left;min-height:13px!important;height:3%;margin-right:13px;" id="select_all' + sf[i]["id"] + '" value="' + sf[i]["id"] + '" checked onclick="selectCourse(' + sf[i]["id"] + ',' + x + ')"></th> <th class="sorting_asc">' + sf[i]["name"] + '</th> </tr>';
                        } else {
                            str += '<tr role="row"> <th class="sorting_asc"><input type="checkbox" name="course[' + x + '][]" class="form-control sel_all" style="text-align: left;min-height:13px!important;height:3%;margin-right:13px;" id="select_all' + sf[i]["id"] + '" value="' + sf[i]["id"] + '" onclick="selectCourse(' + sf[i]["id"] + ',' + x + ')"></th> <th class="sorting_asc">' + sf[i]["name"] + '</th> </tr>';
                        }

                    }
                    $("#tbs").html(str);
                }
            })

        }

        function selectCourse(courseid, streamid) {
            if ($('#select_all' + courseid).prop("checked") == true) {
                stream[streamid].push(courseid);
                // console.log(stream[streamid]);
            } else if ($(this).prop("checked") == false) {
                console.log("Checkbox is unchecked.");
            }
        }
    </script>

    <!-- course landing page highlight selection -->
    <script>
        $(document).on('click', 'input[name="landing_page_highlight_course"]', function() {
            var radio_value = $(this).val();

            var is_checkbox_checked = $('input[type="checkbox"][value="'+radio_value+'"]').is(':checked');
        
            if(! is_checkbox_checked) {
                swal.fire({
                    title: 'Alert!',
                    text: 'Please choose first this course from all the courses'
                });

                $(this).prop('checked', false);
            }
        });

        $(document).on('click', '.checkbox_courses', function() {
            var checkbox_value = $(this).val();

            var is_checkbox_checked = $(this).is(':checked');
        
            if(! is_checkbox_checked) {
                $('input[type="radio"][value="'+checkbox_value+'"]').prop('checked', false);;
            }
        });
    </script>
        
    <!-- add remove faq -->

    <script>
        $(document).ready(function() {

            $("#addButton").click(function() {

                var id = ($('.form-horizontal1 .control-group1').length + 1).toString();
                $('.form-horizontal1').append(`<div class="control-group1">
                    <div class="row add-mores">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <input type="text" class="form-control" name="faq[${(id-1)}][name]"  placeholder="Enter name"
                                autocomplete="off" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Value</label>
                                <input type="text" class="form-control" name="faq[${(id-1)}][value]"  placeholder="Enter value"
                                autocomplete="off" type="text">
                            </div>
                        </div>
                    </div>
                </div>`);
                
            });

            $("#removeButton").click(function() {
                if ($('.form-horizontal1 .control-group1').length == 1) {
                    Swal.fire("No more to remove");
                    return false;
                }

                $(".form-horizontal1 .control-group1:last").remove();
            });
        });
    </script>


    <script>
        $(document).ready(
            function() {
                $('form').attr('target', '_blank');
            }
        );
    </script>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ config('app.GOOGLE_MAPS_API_KEY') }}"></script>

    <script type="text/javascript">
        var city;
        var state;
        var country;

        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('address'));
            google.maps.event.addListener(places, 'place_changed', function (event) {
                // console.log(event);
                // console.log(places);
                // Get place info
                
                var place = places.getPlace();

                if (!place.geometry || !place.geometry.location) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // Do whatever with the value!
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();

                geocodeLatLng(latitude,longitude);

            });
        });

        var input = document.getElementById('address');
        google.maps.event.addDomListener(input, 'keydown', function(event) { 
            if (event.keyCode === 13) { 
                event.preventDefault(); 
            }
        }); 
    </script>

    <script>
        function geocodeLatLng(lat, lng) {

            var geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(lat, lng);
            
            geocoder.geocode({
                'latLng': latlng
            }, function(results, status) {
                if (status === 'OK') {
                    if (results[1]) {
                        console.log(results);
                        for (var i = 0; i < results[0].address_components.length; i++) {
                            for (var b = 0; b < results[0].address_components[i].types.length; b++) {
                                switch (results[0].address_components[i].types[b]) {
                                    case 'locality':
                                        city = results[0].address_components[i].long_name;
                                        break;
                                    case 'administrative_area_level_1':
                                        state = results[0].address_components[i].long_name;
                                        break;
                                    case 'country':
                                        country = results[0].address_components[i].long_name;
                                        break;
                                }
                            }
                        }
                        console.log('City = ' + city + ', ' + 'State = ' +  state + ', ' + 'Country = ' +  country);

                        // return {city, state, country};

                        // set country
                        $("#country_id option").filter(function() {
                            return this.text == country; 
                        }).prop('selected', true);


                        $('#country_id').selectpicker('refresh');

                        $.ajax({
                            'type': 'POST',
                            'url': '<?php echo asset('/coaching_admin/get_allstate'); ?>',
                            'data': {
                                _token: "{{csrf_token()}}",
                                x: $('#country_id option:selected').val()
                            },
                            'success': function(data) {
                                $("#state_id").html(data);
                                $('#state_id').selectpicker('refresh');

                                // set state
                                $("#state_id option").filter(function() {
                                    return this.text == state; 
                                }).prop('selected', true);

                                $('#state_id').selectpicker('refresh');

                                $.ajax({
                                    'type': 'POST',
                                    'url': '<?php echo asset('/coaching_admin/get_allcity'); ?>',
                                    'data': {
                                        _token: "{{csrf_token()}}",
                                        x: $('#state_id option:selected').val()
                                    },
                                    'success': function(data) {
                                        $("#city_id").html(data);
                                        $('#city_id').selectpicker('refresh');
                                                
                                        // set city
                                        $("#city_id option").filter(function() {
                                            return this.text == city; 
                                        }).prop('selected', true);
                                                        

                                        $('#city_id').selectpicker('refresh');

                                    },
                                });

                            },
                        });
                    } else {
                        alert("No results found");
                    }
                } else {
                    alert("Geocoder failed due to: " + status);
                }
            });
        }
    </script>
    @endsection