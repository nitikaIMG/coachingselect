@extends('main')

@section('heading')
Study Material
@endsection('heading')

@section('sub-heading')
Edit Question Answer
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('QuestionAnswerController@view_question_answer', 'id='.$question_answer->question_paper_subject_id)}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View Question Answer"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">Edit Question Answer</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="{{ action('QuestionAnswerController@edit_question_answer') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-0">

                        <input type="hidden" name="id" value="{{$question_answer->id}}" />

                        <input type="hidden" name="question_paper_subject_id" value="{{$question_answer->question_paper_subject_id}}" />


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Question</label>
                                    <input type="text" class="form-control" name="question" placeholder="Enter Question"  value="{{$question_answer->question}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    @php

                                    $image = asset('public/question_answer/'. $question_answer->image);

                                    if(! @GetImageSize($image) )
                                    $image = asset('public/logo.png');

                                    @endphp
                                    <label class="control-label">Image</label>
                                    <input type="file" class="form-control uploaded" style="--upload-pic:url({{$image}});" upload-pic="" name="image">
                                
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Option A</label>
                                    
                                    <select 
                                    onchange="switch_between(this)"
                                    required
                                    name="a_type"
                                    id="a" class="form-control form-control-solid selectpicker show-tick switch mb-3">
                                        <option value="">Select Text Box or Image</option>
                                        <option value="text"
                                            @if($question_answer->a_type == 'text')
                                                selected
                                            @endif
                                        >Text Box</option>
                                        <option value="image"
                                            @if($question_answer->a_type == 'image')
                                                selected
                                            @endif
                                        >Image</option>
                                    </select>

                                    <div class="row mx-0" 
                                        @if($question_answer->a_type == 'text')
                                            style="display:block;"
                                        @else
                                            style="display:none;"
                                        @endif
                                    id="a_text">
                                        <input type="text" class="form-control" name="a" placeholder="Enter option a" 
                                            @if($question_answer->a_type == 'text')
                                                value="{{$question_answer->a}}"
                                            @endif
                                        >
                                    </div>
                                    
                                    <div class="row mx-0" 
                                        @if($question_answer->a_type == 'image')
                                            style="display:block;"
                                        @else
                                            style="display:none;"
                                        @endif 
                                    id="a_image">

                                        @php
                                            $image = '';

                                            if($question_answer->a_type == 'image') {

                                                $image = asset('public/question_answer/'. $question_answer->a);

                                                if(! @GetImageSize($image) )
                                                $image = asset('public/logo.png');
                                            }
                                        @endphp

                                        <input type="file" 
                                        class="form-control
                                            @if( !empty($image) )
                                                uploaded
                                            @endif
                                        " 
                                        style="--upload-pic:url({{$image}});"
                                            @if( !empty($image) )
                                                upload-pic=""
                                            @else
                                                upload-pic="No Choosen File"
                                            @endif
                                        name="a">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Option B</label>
                                    
                                    <select 
                                    onchange="switch_between(this)"
                                    required
                                    name="b_type"
                                    id="b" class="form-control form-control-solid selectpicker show-tick switch mb-3">
                                        <option value="">Select Text Box or Image</option>
                                        <option value="text"
                                            @if($question_answer->b_type == 'text')
                                                selected
                                            @endif
                                        >Text Box</option>
                                        <option value="image"
                                            @if($question_answer->b_type == 'image')
                                                selected
                                            @endif
                                        >Image</option>
                                    </select>

                                    <div class="row mx-0" 
                                        @if($question_answer->b_type == 'text')
                                            style="display:block;"
                                        @else
                                            style="display:none;"
                                        @endif
                                    id="b_text">
                                        <input type="text" class="form-control" name="b" placeholder="Enter option b" 
                                            @if($question_answer->b_type == 'text')
                                                value="{{$question_answer->b}}"
                                            @endif
                                        >
                                    </div>
                                    
                                    <div class="row mx-0" 
                                        @if($question_answer->b_type == 'image')
                                            style="display:block;"
                                        @else
                                            style="display:none;"
                                        @endif 
                                    id="b_image">
                                    
                                        @php
                                            $image = '';

                                            if($question_answer->b_type == 'image') {

                                                $image = asset('public/question_answer/'. $question_answer->b);

                                                if(! @GetImageSize($image) )
                                                $image = asset('public/logo.png');
                                            }
                                        @endphp

                                        <input type="file" 
                                        class="form-control
                                            @if( !empty($image) )
                                                uploaded
                                            @endif
                                        "
                                        style="--upload-pic:url({{$image}});"
                                            @if( !empty($image) )
                                                upload-pic=""
                                            @else
                                                upload-pic="No Choosen File"
                                            @endif
                                        name="b">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Option C</label>
                                    
                                    <select 
                                    onchange="switch_between(this)"
                                    required
                                    name="c_type"
                                    id="c" class="form-control form-control-solid selectpicker show-tick switch mb-3">
                                        <option value="">Select Text Box or Image</option>
                                        <option value="text"
                                            @if($question_answer->c_type == 'text')
                                                selected
                                            @endif
                                        >Text Box</option>
                                        <option value="image"
                                            @if($question_answer->c_type == 'image')
                                                selected
                                            @endif
                                        >Image</option>
                                    </select>

                                    <div class="row mx-0" 
                                        @if($question_answer->c_type == 'text')
                                            style="display:block;"
                                        @else
                                            style="display:none;"
                                        @endif
                                    id="c_text">
                                        <input type="text" class="form-control" name="c" placeholder="Enter option c" 
                                        
                                            @if($question_answer->c_type == 'text')
                                                value="{{$question_answer->c}}"
                                            @endif
                                        >
                                    </div>
                                    
                                    <div class="row mx-0" 
                                        @if($question_answer->c_type == 'image')
                                            style="display:block;"
                                        @else
                                            style="display:none;"
                                        @endif 
                                    id="c_image">
                                    
                                        @php
                                            $image = '';

                                            if($question_answer->c_type == 'image') {

                                                $image = asset('public/question_answer/'. $question_answer->c);

                                                if(! @GetImageSize($image) )
                                                $image = asset('public/logo.png');
                                            }
                                        @endphp

                                        <input type="file"
                                        class="form-control
                                            @if( !empty($image) )
                                                uploaded
                                            @endif
                                        " 
                                        style="--upload-pic:url({{$image}});"
                                            @if( !empty($image) )
                                                upload-pic=""
                                            @else
                                                upload-pic="No Choosen File"
                                            @endif
                                        name="c">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Option D</label>
                                    
                                    <select 
                                    onchange="switch_between(this)"
                                    required
                                    name="d_type"
                                    id="d" class="form-control form-control-solid selectpicker show-tick switch mb-3">
                                        <option value="">Select Text Box or Image</option>
                                        <option value="text"
                                            @if($question_answer->d_type == 'text')
                                                selected
                                            @endif
                                        >Text Box</option>
                                        <option value="image"
                                            @if($question_answer->d_type == 'image')
                                                selected
                                            @endif
                                        >Image</option>
                                    </select>

                                    <div class="row mx-0" 
                                        @if($question_answer->d_type == 'text')
                                            style="display:block;"
                                        @else
                                            style="display:none;"
                                        @endif
                                    id="d_text">
                                        <input type="text" class="form-control" name="d" placeholder="Enter option d" 
                                            
                                            @if($question_answer->d_type == 'text')
                                                value="{{$question_answer->d}}"
                                            @endif
                                        >
                                    </div>
                                    
                                    <div class="row mx-0" 
                                        @if($question_answer->d_type == 'image')
                                            style="display:block;"
                                        @else
                                            style="display:none;"
                                        @endif 
                                    id="d_image">
                                    
                                        @php
                                            $image = '';

                                            if($question_answer->d_type == 'image') {

                                                $image = asset('public/question_answer/'. $question_answer->d);

                                                if(! @GetImageSize($image) )
                                                $image = asset('public/logo.png');
                                            }
                                        @endphp

                                        <input type="file" 
                                        class="form-control
                                            @if( !empty($image) )
                                                uploaded
                                            @endif
                                        " 
                                        style="--upload-pic:url({{$image}});"
                                            @if( !empty($image) )
                                                upload-pic=""
                                            @else
                                                upload-pic="No Choosen File"
                                            @endif
                                        name="d">
                                    </div>
                                </div>
                            </div>

                            <?php
                                $question_answer->answer = explode(',', $question_answer->answer);
                            ?>
                    
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Answer</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                        class="px-5 custom-control-input selectallseries" id="option_a_0" value="a" name="answer[]"
                                            @if( in_array("a", $question_answer->answer) ) checked @endif
                                        >
                                        <label class="custom-control-label fs-14 font-weight-normal" for="option_a_0">
                                            Option A
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                        class="px-5 custom-control-input selectallseries" id="option_b_0" value="b" name="answer[]"
                                            @if( in_array("b", $question_answer->answer) ) checked @endif
                                        >
                                        <label class="custom-control-label fs-14 font-weight-normal" for="option_b_0">
                                            Option B
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                        class="px-5 custom-control-input selectallseries" id="option_c_0" value="c" name="answer[]"
                                            @if( in_array("c", $question_answer->answer) ) checked @endif
                                        >
                                        <label class="custom-control-label fs-14 font-weight-normal" for="option_c_0">
                                            Option C
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                        class="px-5 custom-control-input selectallseries" id="option_d_0" value="d" name="answer[]"
                                            @if( in_array("d", $question_answer->answer) ) checked @endif
                                        >
                                        <label class="custom-control-label fs-14 font-weight-normal" for="option_d_0">
                                            Option D
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Marks</label>
                                    <input type="text" class="form-control" name="marks" placeholder="Enter marks" required value="{{$question_answer->marks}}"  maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Negative Marks</label>
                                    <input type="text" class="form-control" name="negative_marks" placeholder="Enter negative marks" required value="{{$question_answer->negative_marks}}"  maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
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
        function switch_between(element) {
            // var box = element.id + '_' + element.value;

            // $('#' + box).show();

            if(element.value == 'image') {
                $('#' + element.id + '_' + 'image').show();
                $('#' + element.id + '_' + 'image input').attr('required', 'required');
                $('#' + element.id + '_' + 'text').hide();
                $('#' + element.id + '_' + 'text input').removeAttr('required');
            } else {
                $('#' + element.id + '_' + 'text').show();
                $('#' + element.id + '_' + 'text input').attr('required', 'required');
                $('#' + element.id + '_' + 'image').hide();
                $('#' + element.id + '_' + 'image input').removeAttr('required');
            }
        }
    </script>

    @endsection