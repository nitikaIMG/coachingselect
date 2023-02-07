@extends('main')

@section('heading')
Study Material
@endsection('heading')

@section('sub-heading')
Add Question Answer
@endsection('sub-heading')

@section('card-heading-btn')

<a href="{{action('QuestionAnswerController@view_question_answer', 'id='.$id)}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View Question Answer"><i class="fad fa-eye"></i>&nbsp; View</a>

<a href="{{action('FreePreparationToolController@add_question_paper_subjects')}}" class="btn btn-sm btn-light font-weight-bold mx-1 text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="Add Question paper Subject"><i class="fas fa-plus"></i>&nbsp; Add</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">
        <div class="row mx-0 w-100">
            <div class="col">Add Question ({{ $course_name ?? ''}} --> {{ $subject_name ?? ''}})</div>
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
                <form action="{{ action('QuestionAnswerController@add_question_answer') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-0">

                        <input type="hidden" name="question_paper_subject_id" value="{{$id}}" />


                        <div class="form-horizontal">
                            <div class="control-group">
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Question 1</label>
                                            <input type="text" class="form-control" name="questions[0][question]" placeholder="Enter Question">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Image (optional)</label>
                                            <input type="file" class="form-control" style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File" name="questions[0][image]">
                                        
                                            <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label text-danger">Either question or image or both required</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Option A</label>
                                            
                                            <select 
                                            onchange="switch_between(this)"
                                            required
                                            name="questions[0][a_type]"
                                            id="a" class="form-control form-control-solid selectpicker show-tick switch mb-3" data-id="0">
                                                <option value="">Select Text Box or Image</option>
                                                <option value="text">Text Box</option>
                                                <option value="image">Image</option>
                                            </select>

                                            <div class="row mx-0" style="display:none;" id="questions[0][a_text]">
                                                <input type="text" class="form-control" name="questions[0][a]" placeholder="Enter option a" required>
                                            </div>
                                            
                                            <div class="row mx-0" style="display:none;" id="questions[0][a_image]">
                                                <input type="file" class="form-control" style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File" name="questions[0][a]" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Option B</label>
                                            
                                            <select 
                                            onchange="switch_between(this)"
                                            required
                                            name="questions[0][b_type]"
                                            id="b" class="form-control form-control-solid selectpicker show-tick switch mb-3" data-id="0">
                                                <option value="">Select Text Box or Image</option>
                                                <option value="text">Text Box</option>
                                                <option value="image">Image</option>
                                            </select>

                                            <div class="row mx-0" style="display:none;" id="questions[0][b_text]">
                                                <input type="text" class="form-control" name="questions[0][b]" placeholder="Enter option b" required>
                                            </div>
                                            
                                            <div class="row mx-0" style="display:none;" id="questions[0][b_image]">
                                                <input type="file" class="form-control" style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File" name="questions[0][b]" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Option C</label>
                                            
                                            <select 
                                            onchange="switch_between(this)"
                                            required
                                            name="questions[0][c_type]"
                                            id="c" class="form-control form-control-solid selectpicker show-tick switch mb-3" data-id="0">
                                                <option value="">Select Text Box or Image</option>
                                                <option value="text">Text Box</option>
                                                <option value="image">Image</option>
                                            </select>

                                            <div class="row mx-0" style="display:none;" id="questions[0][c_text]">
                                                <input type="text" class="form-control" name="questions[0][c]" placeholder="Enter option c" required>
                                            </div>
                                            
                                            <div class="row mx-0" style="display:none;" id="questions[0][c_image]">
                                                <input type="file" class="form-control" style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File" name="questions[0][c]" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Option D</label>
                                            
                                            <select 
                                            onchange="switch_between(this)"
                                            required
                                            name="questions[0][d_type]"
                                            id="d" class="form-control form-control-solid selectpicker show-tick switch mb-3" data-id="0">
                                                <option value="">Select Text Box or Image</option>
                                                <option value="text">Text Box</option>
                                                <option value="image">Image</option>
                                            </select>

                                            <div class="row mx-0" style="display:none;" id="questions[0][d_text]">
                                                <input type="text" class="form-control" name="questions[0][d]" placeholder="Enter option d" required>
                                            </div>
                                            
                                            <div class="row mx-0" style="display:none;" id="questions[0][d_image]">
                                                <input type="file" class="form-control" style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File" name="questions[0][d]" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Answer</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="px-5 custom-control-input selectallseries" id="option_a_0" value="a" name="questions[0][answer][]">
                                                <label class="custom-control-label fs-14 font-weight-normal" for="option_a_0">
                                                    Option A
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="px-5 custom-control-input selectallseries" id="option_b_0" value="b" name="questions[0][answer][]">
                                                <label class="custom-control-label fs-14 font-weight-normal" for="option_b_0">
                                                    Option B
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="px-5 custom-control-input selectallseries" id="option_c_0" value="c" name="questions[0][answer][]">
                                                <label class="custom-control-label fs-14 font-weight-normal" for="option_c_0">
                                                    Option C
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="px-5 custom-control-input selectallseries" id="option_d_0" value="d" name="questions[0][answer][]">
                                                <label class="custom-control-label fs-14 font-weight-normal" for="option_d_0">
                                                    Option D
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Marks</label>
                                            <input 
                                            type="text" class="form-control" name="questions[0][marks]" placeholder="Enter marks" required maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Negative Marks</label>
                                            <input 
                                            type="text" class="form-control" name="questions[0][negative_marks]" placeholder="Enter negative marks" required  maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-right">
                            <button class="btn btn-sm btn-success" type="submit"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
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

            var row = element.dataset.id;
            var option = element.id;
                
            if(element.value == 'image') {                
                $('[id="questions[' + row + '][' + option + '_' + 'image]"]').show();
                $('[id="questions[' + row + '][' + option + '_' + 'image]"] input').attr('required', 'required');
                $('[id="questions[' + row + '][' + option + '_' + 'text]').hide();
                $('[id="questions[' + row + '][' + option + '_' + 'text]"] input').removeAttr('required');
            } else {
                $('[id="questions[' + row + '][' + option + '_' + 'text]"]').show();
                $('[id="questions[' + row + '][' + option + '_' + 'text]"] input').attr('required', 'required');
                $('[id="questions[' + row + '][' + option + '_' + 'image]"]').hide();
                $('[id="questions[' + row + '][' + option + '_' + 'image]"] input').removeAttr('required');
            }
        }
    </script>

    
<script>
    $(document).ready(function() {

        $("#addButton").click(function() {

            var id = ($('.form-horizontal .control-group').length + 1).toString();
            $('.form-horizontal').append(`
                <div class="control-group">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Question ${(id)}</label>
                                <input type="text" class="form-control" name="questions[${(id - 1)}][question]" placeholder="Enter Question">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Image (optional)</label>
                                <input type="file" class="form-control" style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File" name="questions[${(id - 1)}][image]">
                            
                                <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label text-danger">Either question or image or both required</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Option A</label>
                                
                                <select 
                                onchange="switch_between(this)"
                                required
                                name="questions[${(id - 1)}][a_type]"
                                id="a" class="form-control form-control-solid selectpicker show-tick switch mb-3" data-id="${(id - 1)}">
                                    <option value="">Select Text Box or Image</option>
                                    <option value="text">Text Box</option>
                                    <option value="image">Image</option>
                                </select>

                                <div class="row mx-0" style="display:none;" id="questions[${(id - 1)}][a_text]">
                                    <input type="text" class="form-control" name="questions[${(id - 1)}][a]" placeholder="Enter option a" required>
                                </div>
                                
                                <div class="row mx-0" style="display:none;" id="questions[${(id - 1)}][a_image]">
                                    <input type="file" class="form-control" style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File" name="questions[${(id - 1)}][a]" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Option B</label>
                                
                                <select 
                                onchange="switch_between(this)"
                                required
                                name="questions[${(id - 1)}][b_type]"
                                id="b" class="form-control form-control-solid selectpicker show-tick switch mb-3" data-id="${(id - 1)}">
                                    <option value="">Select Text Box or Image</option>
                                    <option value="text">Text Box</option>
                                    <option value="image">Image</option>
                                </select>

                                <div class="row mx-0" style="display:none;" id="questions[${(id - 1)}][b_text]">
                                    <input type="text" class="form-control" name="questions[${(id - 1)}][b]" placeholder="Enter option b" required>
                                </div>
                                
                                <div class="row mx-0" style="display:none;" id="questions[${(id - 1)}][b_image]">
                                    <input type="file" class="form-control" style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File" name="questions[${(id - 1)}][b]" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Option C</label>
                                
                                <select 
                                onchange="switch_between(this)"
                                required
                                name="questions[${(id - 1)}][c_type]"
                                id="c" class="form-control form-control-solid selectpicker show-tick switch mb-3" data-id="${(id - 1)}">
                                    <option value="">Select Text Box or Image</option>
                                    <option value="text">Text Box</option>
                                    <option value="image">Image</option>
                                </select>

                                <div class="row mx-0" style="display:none;" id="questions[${(id - 1)}][c_text]">
                                    <input type="text" class="form-control" name="questions[${(id - 1)}][c]" placeholder="Enter option c" required>
                                </div>
                                
                                <div class="row mx-0" style="display:none;" id="questions[${(id - 1)}][c_image]">
                                    <input type="file" class="form-control" style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File" name="questions[${(id - 1)}][c]" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Option D</label>
                                
                                <select 
                                onchange="switch_between(this)"
                                required
                                name="questions[${(id - 1)}][d_type]"
                                id="d" class="form-control form-control-solid selectpicker show-tick switch mb-3" data-id="${(id - 1)}">
                                    <option value="">Select Text Box or Image</option>
                                    <option value="text">Text Box</option>
                                    <option value="image">Image</option>
                                </select>

                                <div class="row mx-0" style="display:none;" id="questions[${(id - 1)}][d_text]">
                                    <input type="text" class="form-control" name="questions[${(id - 1)}][d]" placeholder="Enter option d" required>
                                </div>
                                
                                <div class="row mx-0" style="display:none;" id="questions[${(id - 1)}][d_image]">
                                    <input type="file" class="form-control" style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File" name="questions[${(id - 1)}][d]" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Answer</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="px-5 custom-control-input selectallseries" id="option_a_${(id - 1)}" value="a" name="questions[${(id - 1)}][answer][]">
                                    <label class="custom-control-label fs-14 font-weight-normal" for="option_a_${(id - 1)}">
                                        Option A
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="px-5 custom-control-input selectallseries" id="option_b_${(id - 1)}" value="b" name="questions[${(id - 1)}][answer][]">
                                    <label class="custom-control-label fs-14 font-weight-normal" for="option_b_${(id - 1)}">
                                        Option B
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="px-5 custom-control-input selectallseries" id="option_c_${(id - 1)}" value="c" name="questions[${(id - 1)}][answer][]">
                                    <label class="custom-control-label fs-14 font-weight-normal" for="option_c_${(id - 1)}">
                                        Option C
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="px-5 custom-control-input selectallseries" id="option_d_${(id - 1)}" value="d" name="questions[${(id - 1)}][answer][]">
                                    <label class="custom-control-label fs-14 font-weight-normal" for="option_d_${(id - 1)}">
                                        Option D
                                    </label>
                                </div>
                            </div>
                        </div>
                        {{--<div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Answer</label>
                                <select name="questions[${(id - 1)}][answer]" id="answer" required class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true">
                                    <option value="">Select Answer</option>
                                    <option value="a">A</option>
                                    <option value="b">B</option>
                                    <option value="c">C</option>
                                    <option value="d">D</option>
                                </select>
                            </div>
                        </div>--}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Marks</label>
                                <input type="text" class="form-control" name="questions[${(id - 1)}][marks]" placeholder="Enter marks" required maxlength="4" onkeypress="return isNumberKey(event)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Negative Marks</label>
                                <input type="text" class="form-control" name="questions[${(id - 1)}][negative_marks]" placeholder="Enter negative marks" required  maxlength="4" onkeypress="return isNumberKey(event)">
                            </div>
                        </div>
                    </div>
                </div>
            `);

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

@endsection