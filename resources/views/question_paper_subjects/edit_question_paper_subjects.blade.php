@extends('main')

@section('heading')
Study Material
@endsection('heading')

@section('sub-heading')
Edit Question Paper
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('FreePreparationToolController@view_question_paper_subjects')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View Question paper Subject"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">Edit Question Paper</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="{{ action('FreePreparationToolController@edit_question_paper_subjects') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-0">

                        <input type="hidden" name="id" value="{{$question_paper_subjects->id}}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Stream</label>
                                    <select name="stream_id" id="stream_id" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required>
                                        <option value="">Select Stream</option>
                                        @if( !empty($streams) )
                                        @foreach($streams as $stream)
                                        <option value="{{$stream->id}}" @if($stream->id == $question_paper_subjects->stream_id)
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
                                    <select name="course_id" id="course_id" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required>
                                        <option value="">Select Course</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Subject</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter subject" required value="{{$question_paper_subjects->name}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @php

                                    $image = asset('public/question_paper_subjects/'. $question_paper_subjects->image);

                                    if(! @GetImageSize($image) )
                                    $image = asset('public/logo.png');

                                    @endphp
                                    <label class="control-label">Image</label>
                                    <input type="file" class="form-control uploaded" style="--upload-pic:url({{$image}});" upload-pic="" name="image">
                                
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Instructions</label>
                                    <textarea class="form-control ckeditor" name="description" placeholder="Enter description"
                                    id="description"
                                    required>{{$question_paper_subjects->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Hours</label>
                                    <input type="text" class="form-control" name="hours" value="{{$question_paper_subjects->hours ?? ''}}"
                                    placeholder="Enter hours" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="2" max="24">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Minutes</label>
                                    <input type="text" class="form-control" name="minutes" value="{{$question_paper_subjects->minutes ?? ''}}"
                                    placeholder="Enter Minutes" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="2" max="60">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Brochure or pdf</label>
                                    <input type="file" class="form-control uploaded" upload-pic="" name="brochure_or_pdf">
                                    @if( !empty($question_paper_subjects->brochure_or_pdf) )
                                        <a href='{{asset("public/question_paper_subjects/".$question_paper_subjects->brochure_or_pdf)}}' target="_blank" class="upload-pic-view"><i class="fad fa-eye"></i></a>
                                    @endif
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal1" class="upload-pic-view d-none" id="pdf-eye1"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Year</label>
                                    <select name="year" id="year"  class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                        <option value="" disabled selected>Select Year</option>
                                        
                                        @foreach(range(date('Y'), 1970) as $year)
                                            <option value="{{$year}}" 
                                                @if($question_paper_subjects->year == $year)
                                                selected
                                                @endif
                                            >{{$year}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-auto align-self-end text-right">
                                <button class="btn btn-sm btn-success my-3" type="submit"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
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

                        var course_id = '{{$question_paper_subjects->course_id}}';

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
    </script>
    
<script>
    CKEDITOR.replace( 'description', {
        filebrowserUploadUrl: "{{ action('BlogsController@ckeditor_image', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    
    CKEDITOR.instances.description.on("change", function() {

    });
    
</script>
@endsection