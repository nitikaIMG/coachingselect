@extends('main')

@section('heading')
Exams
@endsection('heading')

@section('sub-heading')
Add Exam
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
                <form action="{{ action('ExamsController@add_exam') }}" method="post" enctype="multipart/form-data" id="exam" 
                >
                    @csrf
                    <div class="card-body p-0">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Stream</label>
                                    <select form="exam" name="stream_id" id="stream_id" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required>
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
                                    <select form="exam" name="course_id" id="course_id" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required>
                                        <option value="" selected disabled>Select Course</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input type="text" class="form-control" form="exam" name="title" placeholder="Enter Title" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <input type="file" class="form-control" style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File" name="image">
                                    
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
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Short Description</label>

                                    <textarea form="exam" name="short_description" class="form-control" rows="7" placeholder="Enter short description" required></textarea>
                                </div>
                            </div>
                            {{--<div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Overview</label>

                                    <textarea form="exam" name="description" class="form-control ckeditor"
                                    id="description"
                                    placeholder="Enter Overview"></textarea>
                                </div>
                            </div>--}}
                        </div>

                    </div>
                    <div class="text-left">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">Quick Summary</div>
    <div class="card-body">
        <h3 class="mb-4">1. Important Dates</h3>
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <div class="card-body p-0">

                    <div class="row">

                        <div class="col-md col-6">
                            <div class="form-group">
                                <label class="control-label">Registration Begins</label>
                                <input type="text" class="form-control " form="exam" name="registration_begins" placeholder="Enter Registration Begins">
                            </div>
                        </div>
                        <div class="col-md col-6">
                            <div class="form-group">
                                <label class="control-label">Last Date for Application</label>
                                <input type="text" class="form-control " form="exam" name="registration_end" placeholder="Enter Last Date for Application">
                            </div>
                        </div>
                        <div class="col-md col-6">
                            <div class="form-group">
                                <label class="control-label">Admit Card Release</label>
                                <input type="text" class="form-control " form="exam" name="admit_card_release" placeholder="Enter Admit Card Release">
                            </div>
                        </div>
                        <div class="col-md col-6">
                            <div class="form-group">
                                <label class="control-label">Exam Date</label>
                                <input type="text" class="form-control " form="exam" name="exam_date" placeholder="Enter Exam Date">
                            </div>
                        </div>
                        <div class="col-md col-6">
                            <div class="form-group">
                                <label class="control-label">Results Date</label>
                                <input type="text" class="form-control " form="exam" name="results_date" placeholder="Enter Results Date">
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <h3 class="mb-3 mt-4">2. Exam Details</h3>
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <div class="card-body p-0">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Exam Website</label>
                                <input form="exam" name="url" class="form-control ckeditor" placeholder="Enter Url" type="url">
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Mode of Exam</label>
                                <select form="exam" name="mode_of_exam" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                    <option value="" selected disabled>Select Mode of Exam</option>
                                    <option value="Online">Online</option>
                                    <option value="Classroom">Classroom</option>
                                    <option value="Online & Classroom (Both)">Online & Classroom (Both)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Exam Fee</label>
                                <input class="form-control" form="exam" name="exam_fee" placeholder="Enter Exam Fee"
                                type="text"
                                >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Reservation available</label>
                                <input type="text" class="form-control" form="exam" name="reservation_available" placeholder="Enter Reservation available">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Exam Frequency</label>
                                <input type="text" class="form-control" form="exam" name="exam_frequency" placeholder="Enter Exam Frequency">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Exam Duration</label>
                                <input type="text" class="form-control" form="exam" name="exam_duration" placeholder="Enter Exam Duration">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Conducted By</label>
                                <input type="text" class="form-control" form="exam" name="conducted_by" placeholder="Enter Conducted By">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Programs</label>
                                <input type="text" class="form-control" form="exam" name="programs" placeholder="Enter Programs">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Exam Language</label>
                                <select form="exam" name="exam_language[]" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" multiple>
                                    <option value="" disabled>Select Exam Language</option>
                                    <option value="Hindi">Hindi</option>
                                    <option value="English">English</option>
                                    <option value="Malayalam">Malayalam</option>
                                    <option value="Urdu">Urdu</option>
                                    <option value="Telugu">Telugu</option>
                                    <option value="Tamil">Tamil</option>
                                    <option value="Sindhi">Sindhi</option>
                                    <option value="Sanskrit">Sanskrit</option>
                                    <option value="Punjabi">Punjabi</option>
                                    <option value="Marathi">Marathi</option>
                                    <option value="Nepali">Nepali</option>
                                    <option value="Kashmiri">Kashmiri</option>
                                    <option value="Kannada">Kannada</option>
                                    <option value="Gujarati">Gujarati</option>
                                    <option value="Bengali">Bengali</option>
                                    <option value="Assamee">Assamee</option>
                                    <option value="Uriya">Uriya</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <h3 class="mb-3 mt-4">3. Eligibilty</h3>
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <div class="card-body p-0">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Min Age</label>
                                <input type="text" class="form-control" form="exam" name="min_age" placeholder="Enter Min Age">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Max Age</label>
                                <input type="text" class="form-control" form="exam" name="max_age" placeholder="Enter Max Age">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">No of attempts</label>
                                <input type="text" class="form-control" form="exam" name="no_of_attempts" placeholder="Enter No of attempts">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Qualifying Exam and Marks Required</label>
                                <input type="text" class="form-control" form="exam" name="qualifying_exam_and_marks_required" placeholder="Enter Qualifying Exam and Marks Required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Last Qualifying Exam Subjects</label>
                                <input type="text" class="form-control" form="exam" name="last_qualifying_exam_subjects" placeholder="Enter Last Qualifying Exam Subjects">
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <h3 class="mb-3 mt-4">4. Marking Scheme, Pattern and Cut off</h3>
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <div class="card-body p-0">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Exam Type</label>
                                <input type="text" class="form-control" form="exam" name="exam_type" placeholder="Enter Exam Type">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Stages</label>
                                <input type="number" class="form-control" form="exam" name="stages" placeholder="Enter Stages">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Negative Marking</label>
                                <input type="text" class="form-control" form="exam" name="negative_marking" placeholder="Enter Negative Marking">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">No of Questions</label>
                                <input type="text" class="form-control" form="exam" name="no_of_questions" placeholder="Enter No of Questions">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Maximum Marks</label>
                                <input type="number" class="form-control" form="exam" name="maximum_marks" placeholder="Enter Maximum Marks">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Cutoff</label>
                                <input type="text" class="form-control" form="exam" name="cutoff" placeholder="Enter Cutoff">
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
                            <div class="form-group mb-0">
                                <textarea form="exam" 
                                name="syllabus" 
                                id="syllabus" 
                                class="form-control ckeditor" placeholder="Enter Syllabus"></textarea>
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
                            <div class="form-group mb-0">
                                <textarea form="exam" 
                                name="mocks"
                                id="mocks"
                                class="form-control ckeditor" placeholder="Enter Mocks"></textarea>
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
                            <div class="form-group mb-0">
                                <textarea form="exam" 
                                name="reservation_criteria" 
                                id="reservation_criteria" 
                                class="form-control ckeditor" placeholder="Enter Reservation Criteria"></textarea>
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
                            <div class="form-group mb-0">
                                <textarea form="exam" 
                                name="latest_exam_updates"
                                id="latest_exam_updates"
                                class="form-control ckeditor" placeholder="Enter Latest Exam Updates"></textarea>
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
                            <div class="form-group mb-0">
                                <textarea form="exam" 
                                name="miscellaneous_information" 
                                id="miscellaneous_information" 
                                class="form-control ckeditor" placeholder="Enter Exam Centers & Information"></textarea>
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
                            <div class="form-group mb-0">
                                <textarea form="exam" 
                                name="faq"
                                id="faq"
                                class="form-control ckeditor" placeholder="Enter Faq"></textarea>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="card-footer bg-transparent border-0 text-right">
        <button class="btn btn-sm btn-success" type="submit" form="exam"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
    </div>
</div>





<script>
    $(document).on('change', '#stream_id', function() {
        $.ajax({
            type: 'POST',
            url: '{{action("ExamsController@stream_course")}}',
            data: {
                stream_id: $(this).val(),
                _token: '{{csrf_token()}}'
            },
            success: function(data) {

                $('#course_id').html(
                    '<option value="">Select Course</option>'
                );

                data.forEach(element => {
                    $('#course_id').append(
                        '<option value="' + element.id + '">' + element.name + '</option>'
                    );
                });

                $('#course_id').selectpicker('refresh');
            }
        });
    });
</script>

<script>
    function is_image_selected() {
        if (
            $('input[name="image"]').val() == ''
        ) {
            Swal.fire('Image is required');
            return false;
        }
    }
</script>

<script>
    function check_all_textarea() {
        
        var has_error = false;

        $('textarea').map(
            function (textarea) {

            }
        );

        if(has_error == true) {
            return false;
        }

        return true;
    }

    function description_length() {

        var txt = $('textarea[name="short_description"]').val();
        
        if(txt.length >= 800) {
            swal.fire({
            title: 'Alert',
            'text': 'Short description Limit Exceed'
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