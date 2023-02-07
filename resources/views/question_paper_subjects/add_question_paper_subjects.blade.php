@extends('main')

@section('heading')
Study Material
@endsection('heading')

@section('sub-heading')
Add Question Paper
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('FreePreparationToolController@view_question_paper_subjects')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View Question paper Subject"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">Add Question Paper</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="{{ action('FreePreparationToolController@add_question_paper_subjects') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-0">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Stream</label>
                                    <select name="stream_id" id="stream_id" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required>
                                        <option value="">Select Stream</option>
                                        @if( !empty($streams) )
                                        @foreach($streams as $stream)
                                        <option value="{{$stream->id}}">{{$stream->name}}</option>
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
                                    <label class="control-label">Paper Name</label>
                                    <input type="text" class="form-control" name="name" maxlength="80" placeholder="Enter Paper Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">                                
                                <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <input type="file" class="form-control" style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File" name="image">
                                
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Instructions</label>
                                    <textarea class="form-control ckeditor" name="description" placeholder="Enter description" 
                                    id="description"
                                    required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Hours</label>
                                    <input type="text" class="form-control" name="hours" placeholder="Enter hours" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" max="24" maxlength="2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Minutes</label>
                                    <input type="text" class="form-control" name="minutes" placeholder="Enter Minutes" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" max="60" maxlength="2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Brochure or pdf</label>
                                    <input type="file" class="form-control position-relative p-0" upload-pic="No Choosen File"  name="brochure_or_pdf">

                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal1" class="upload-pic-view d-none" id="pdf-eye1"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Year</label>
                                    <select name="year" id="year"  class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                        <option value="" disabled selected>Select Year</option>
                                        
                                        @foreach(range(date('Y'), 1970) as $year)
                                            <option value="{{$year}}">{{$year}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-12 text-right">
                                <button class="btn btn-sm btn-success" type="submit"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
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
        CKEDITOR.replace( 'description', {
            filebrowserUploadUrl: "{{ action('BlogsController@ckeditor_image', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        
        CKEDITOR.instances.description.on("change", function() {

        });
        
    </script>
    @endsection