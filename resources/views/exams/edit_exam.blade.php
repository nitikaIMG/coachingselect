@extends('main')

@section('heading')
Exams
@endsection('heading')

@section('sub-heading')
Edit Exam
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('ExamsController@view_exam')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View all Exam"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')
<div class="card mb-4">
    <div class="card-header">Overview</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form 
                    action="{{ action('ExamsController@edit_exam') }}" method="post" enctype="multipart/form-data" id="exam">
                    @csrf
                    <div class="card-body p-0">

                        <input type="hidden" name="id" value="{{$exam->id}}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Stream</label>
                                    <select form="exam" name="stream_id" id="stream_id" class="form-control selectpicker show-tick"
                                    data-width="full" data-container="body" data-live-search="true" required>
                                        <option value="">Select Stream</option>
                                        @if( !empty($streams) )
                                        @foreach($streams as $stream)
                                        <option value="{{$stream->id}}" @if($stream->id == $exam->stream_id)
                                            selected
                                            @endif
                                            >{{$stream->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Course</label>
                                    <select form="exam" name="course_id" id="course_id" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required>
                                        <option value="">Select Course</option>
                                        @if( !empty($courses) )
                                        @foreach($courses as $course)
                                        <option value="{{$course->id}}" @if($course->id == $exam->course_id)
                                            selected
                                            @endif
                                            >{{$course->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input type="text" class="form-control" form="exam" value="{{$exam->title}}" name="title" placeholder="Enter Title" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    @php

                                    $image = asset('public/exams/'. $exam->image);

                                    if(! @GetImageSize($image) )
                                    $image = asset('public/logo.png');

                                    @endphp
                                    <label class="control-label">Image</label>
                                    <input type="file" class="form-control uploaded" style="--upload-pic:url({{$image}});" upload-pic="" name="image">
                                
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Brochure or pdf</label>
                                    <input type="file" class="form-control 
                                    @if( !empty($exam->brochure_or_pdf) )
                                    uploaded
                                    @endif
                                    " 
                                    @if( !empty($exam->brochure_or_pdf) )
                                        upload-pic=""
                                    @else
                                        upload-pic="No Choosen File"
                                    @endif name="brochure_or_pdf">
                                    
                                    @if( !empty($exam->brochure_or_pdf) )
                                        <a href='{{asset("public/exams/".$exam->brochure_or_pdf)}}' target="_blank" class="upload-pic-view"><i class="fad fa-eye"></i></a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Short Description</label>

                                    <textarea form="exam" name="short_description" class="form-control" required placeholder="Enter short description"  required>{{$exam->short_description}}</textarea>
                                </div>
                            </div>
             
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">Quick Summary</div>
    <div class="card-body">
        <h3 class="my-4">1. Important Dates</h3>
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <div class="card-body p-0">

                    <div class="row">

                        <div class="col-md">
                            <div class="form-group">
                                <label class="control-label">Registration Begins</label>
                                <input type="text" class="form-control " form="exam" value="{{$exam->registration_begins ?? ''}}" name="registration_begins" placeholder="Enter Registration Begins" >
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label class="control-label">Last Date for Application</label>
                                <input type="text" class="form-control " form="exam" value="{{$exam->registration_end ?? ''}}" name="registration_end" placeholder="Enter Last Date for Application" >
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label class="control-label">Admit Card Release</label>
                                <input type="text" class="form-control " form="exam" value="{{$exam->admit_card_release ?? ''}}" name="admit_card_release" placeholder="Enter Admit Card Release" >
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label class="control-label">Exam Date</label>
                                <input type="text" class="form-control " form="exam" value="{{$exam->exam_date ?? ''}}" name="exam_date" placeholder="Enter Exam Date" >
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label class="control-label">Results Date</label>
                                <input type="text" class="form-control " form="exam" value="{{$exam->results_date ?? ''}}" name="results_date" placeholder="Enter Results Date" >
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <h3 class="my-4">2. Exam Details</h3>
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <div class="card-body p-0">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Exam Website</label>
                                <input form="exam" value="{{$exam->url ?? ''}}" name="url" class="form-control ckeditor"  placeholder="Enter Url" type="url">
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Mode of Exam</label>
                                <select form="exam" name="mode_of_exam" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                    <option value="" selected disabled>Select Mode of Exam</option>
                                    <option value="Online"
                                        @if($exam->mode_of_exam == "Online")
                                            selected
                                        @endif
                                    >Online</option>
                                    <option value="Classroom"
                                        @if($exam->mode_of_exam == "Classroom")
                                            selected
                                        @endif
                                    >Classroom</option>
                                    <option value="Online & Classroom (Both)"
                                        @if($exam->mode_of_exam == "Online & Classroom (Both)")
                                            selected
                                        @endif
                                    >Online & Classroom (Both)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Exam Fee</label>
                                <input class="form-control" form="exam" value="{{$exam->exam_fee ?? ''}}" name="exam_fee" placeholder="Enter Exam Fee"
                                type="text" 
                                >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Reservation available</label>
                                <input type="text" class="form-control" form="exam" value="{{$exam->reservation_available ?? ''}}" name="reservation_available"  placeholder="Enter Reservation available">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Exam Frequency</label>
                                <input type="text" class="form-control" form="exam" value="{{$exam->exam_frequency ?? ''}}" name="exam_frequency"  placeholder="Enter Exam Frequency">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Exam Duration</label>
                                <input type="text" class="form-control" form="exam" value="{{$exam->exam_duration ?? ''}}" name="exam_duration"  placeholder="Enter Exam Duration">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Conducted By</label>
                                <input type="text" class="form-control" form="exam" value="{{$exam->conducted_by ?? ''}}" name="conducted_by"  placeholder="Enter Conducted By">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Programs</label>
                                <input type="text" class="form-control" form="exam" value="{{$exam->programs ?? ''}}" name="programs"  placeholder="Enter Programs">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Exam Language</label>
                                <select form="exam" name="exam_language[]" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" multiple>
                                    <option value="" disabled>Select Exam Language</option>
                                    <option value="Hindi"
                                        @if(preg_match("/Hindi/", $exam->exam_language) )
                                            selected
                                        @endif
                                    >Hindi</option>
                                    <option value="English"
                                        @if(preg_match("/English/", $exam->exam_language) )
                                            selected
                                        @endif
                                    >English</option>
                                    <option value="Malayalam"
                                    
                                        @if(preg_match("/Malayalam/", $exam->exam_language) )
                                            selected
                                        @endif

                                    >Malayalam</option>
                                    <option value="Urdu"
                                    
                                        @if(preg_match("/Urdu/", $exam->exam_language) )
                                            selected
                                        @endif

                                    >Urdu</option>
                                    <option value="Telugu"
                                    
                                        @if(preg_match("/Telugu/", $exam->exam_language) )
                                            selected
                                        @endif

                                    >Telugu</option>
                                    <option value="Tamil"
                                    
                                        @if(preg_match("/Tamil/", $exam->exam_language) )
                                            selected
                                        @endif

                                    >Tamil</option>
                                    <option value="Sindhi"
                                    
                                        @if(preg_match("/Sindhi/", $exam->exam_language) )
                                            selected
                                        @endif

                                    >Sindhi</option>
                                    <option value="Sanskrit"
                                    
                                        @if(preg_match("/Sanskrit/", $exam->exam_language) )
                                            selected
                                        @endif

                                    >Sanskrit</option>
                                    <option value="Punjabi"
                                    
                                        @if(preg_match("/Punjabi/", $exam->exam_language) )
                                            selected
                                        @endif

                                    >Punjabi</option>
                                    <option value="Marathi"
                                    
                                        @if(preg_match("/Marathi/", $exam->exam_language) )
                                            selected
                                        @endif

                                    >Marathi</option>
                                    <option value="Nepali"
                                    
                                        @if(preg_match("/Nepali/", $exam->exam_language) )
                                            selected
                                        @endif

                                    >Nepali</option>
                                    <option value="Kashmiri"
                                    
                                        @if(preg_match("/Kashmiri/", $exam->exam_language) )
                                            selected
                                        @endif

                                    >Kashmiri</option>
                                    <option value="Kannada"
                                    
                                        @if(preg_match("/Kannada/", $exam->exam_language) )
                                            selected
                                        @endif

                                    >Kannada</option>
                                    <option value="Gujarati"
                                    
                                        @if(preg_match("/Gujarati/", $exam->exam_language) )
                                            selected
                                        @endif

                                    >Gujarati</option>
                                    <option value="Bengali"
                                    
                                        @if(preg_match("/Bengali/", $exam->exam_language) )
                                            selected
                                        @endif

                                    >Bengali</option>
                                    <option value="Assamee"
                                    
                                        @if(preg_match("/Assamee/", $exam->exam_language) )
                                            selected
                                        @endif

                                    >Assamee</option>
                                    <option value="Uriya"
                                    
                                        @if(preg_match("/Uriya/", $exam->exam_language) )
                                            selected
                                        @endif

                                    >Uriya</option>
                                </select>
                            </div>
                        </div>
             
                    </div>

                </div>

            </div>
        </div>

        <h3 class="my-4">3. Eligibilty</h3>
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <div class="card-body p-0">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Min Age</label>
                                <input type="text"  class="form-control" form="exam" value="{{$exam->min_age ?? ''}}" name="min_age" placeholder="Enter Min Age">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Max Age</label>
                                <input type="text"  class="form-control" form="exam" value="{{$exam->max_age ?? ''}}" name="max_age" placeholder="Enter Max Age">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">No of attempts</label>
                                <input type="text"  class="form-control" form="exam" value="{{$exam->no_of_attempts ?? ''}}" name="no_of_attempts" placeholder="Enter No of attempts">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Qualifying Exam and Marks Required</label>
                                <input type="text" class="form-control" form="exam" value="{{$exam->qualifying_exam_and_marks_required ?? ''}}" name="qualifying_exam_and_marks_required" placeholder="Enter Qualifying Exam and Marks Required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Last Qualifying Exam Subjects</label>
                                <input type="text"  class="form-control" form="exam" value="{{$exam->last_qualifying_exam_subjects ?? ''}}" name="last_qualifying_exam_subjects" placeholder="Enter Last Qualifying Exam Subjects">
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <h3 class="my-4">4. Marking Scheme, Pattern and Cut off</h3>
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <div class="card-body p-0">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Exam Type</label>
                                <input type="text"  class="form-control" form="exam" value="{{$exam->exam_type ?? ''}}" name="exam_type" placeholder="Enter Exam Type">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Stages</label>
                                <input type="number"  class="form-control" form="exam" value="{{$exam->stages ?? ''}}" name="stages" placeholder="Enter Stages">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Negative Marking</label>
                                <input type="text"  class="form-control" form="exam" value="{{$exam->negative_marking ?? ''}}" name="negative_marking" placeholder="Enter Negative Marking">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">No of Questions</label>
                                <input type="text"  class="form-control" form="exam" value="{{$exam->no_of_questions ?? ''}}" name="no_of_questions" placeholder="Enter No of Questions">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Maximum Marks</label>
                                <input type="text"  class="form-control" form="exam" value="{{$exam->maximum_marks ?? ''}}" name="maximum_marks" placeholder="Enter Maximum Marks">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Cutoff</label>
                                <input type="text"  class="form-control" form="exam" value="{{$exam->cutoff ?? ''}}" name="cutoff" placeholder="Enter Cutoff">
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

<div class="card mb-4">
    <div class="card-header">Syllabus</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">

                <div class="card-body p-0">

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <textarea form="exam" 
                                name="syllabus" 
                                id="syllabus" 
                                class="form-control ckeditor" placeholder="Enter Syllabus" >{{$exam->syllabus ?? ''}}</textarea>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">Mocks</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">

                <div class="card-body p-0">

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <textarea form="exam" 
                                name="mocks" 
                                id="mocks" 
                                class="form-control ckeditor" placeholder="Enter Mocks" >{{$exam->mocks ?? ''}}</textarea>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">Reservation Criteria</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">

                <div class="card-body p-0">

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <textarea form="exam" 
                                name="reservation_criteria" 
                                id="reservation_criteria" 
                                class="form-control ckeditor" placeholder="Enter Reservation Criteria" >{{$exam->reservation_criteria ?? ''}}</textarea>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">Latest Exam Updates</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">

                <div class="card-body p-0">

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <textarea form="exam" 
                                name="latest_exam_updates" 
                                id="latest_exam_updates" 
                                class="form-control ckeditor" placeholder="Enter Latest Exam Updates" >{{$exam->latest_exam_updates ?? ''}}</textarea>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">Exam Centers & Information</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">

                <div class="card-body p-0">

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <textarea form="exam" 
                                name="miscellaneous_information" 
                                id="miscellaneous_information" 
                                class="form-control ckeditor" placeholder="Enter Exam Centers & Information" >{{$exam->miscellaneous_information ?? ''}}</textarea>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">Frequently Asked Questions</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">

                <div class="card-body p-0">

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <textarea form="exam"  
                                name="faq" 
                                id="faq" 
                                class="form-control ckeditor" placeholder="Enter Faq">{{$exam->faq ?? ''}}</textarea>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="card-footer bg-transparent text-right border-0">
        <button class="btn btn-sm btn-success" type="submit" form="exam"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
    </div>
</div>

<script>
    function stream_course() {
        $.ajax({
            type: 'POST',
            url: '{{action("ExamsController@stream_course")}}',
            data: {
                stream_id: $('#stream_id').val(),
                _token: '{{csrf_token()}}'
            },
            success: function(data) {

                $('#course_id').html(
                    '<option value="">Select Course</option>'
                );

                data.forEach(element => {

                    var course_id = '{{$exam->course_id}}';

                    var is_selected = '';
                    if (course_id == element.id) {
                        is_selected = 'selected';
                    }

                    $('#course_id').append(
                        '<option value="' + element.id + '" ' + is_selected + '>' + element.name + '</option>'
                    );
                });

                $('#course_id').selectpicker('refresh');
            }
        });
    }

    stream_course();

    $(document).on('change', '#stream_id', function() {
        stream_course();
    });

    
    function description_length() {

        var txt = $('textarea[name="short_description"]').val();
        
        if(txt.length >= 800) {
            swal.fire({
            title: 'Alert',
            'text': 'Short description Limit Exceed' + txt.length
            });

            return false;
        }
    }
</script>

<script>
    $(document).ready(
        function() {
            $('form').attr('target', '_blank');

            ck_editor();
        }
    );
</script>


<script>
    function ck_editor() {
        
        $('textarea').each(function(){  
            
            try {
                var editor = CKEDITOR.instances[$(this).attr('id')];
                if (editor) { editor.destroy(true); }

                CKEDITOR.replace($(this).attr('id'), {
                    filebrowserUploadUrl: "{{ action('BlogsController@ckeditor_image', ['_token' => csrf_token() ])}}",
                    filebrowserUploadMethod: 'form'
                });
            } catch(error) {

            }
        });
        
    }
</script>
@endsection