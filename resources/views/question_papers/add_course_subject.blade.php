@extends('main')

@section('heading')
    Question paper Manager
@endsection('heading')

@section('sub-heading')
    Add Course Subject
@endsection('sub-heading')

@section('card-heading-btn')
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">Add Course Subject</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content p-4">
                <form action="{{ action('QuestionPaperController@add_course_subject') }}"
            method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <input 
                        type="hidden"
                        name="course_id"
                        value="{{$course_id}}"
                    >
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Image</label>
                                <input type="file"
                                    class="form-control" name="image">
                                
                                <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Subject</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    name="subject"
                                    placeholder="Enter subject"
                                    required
                                >
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea 
                                    class="form-control" 
                                    name="description"
                                    placeholder="Enter description"
                                    required
                                ></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Hours</label>
                                <textarea 
                                    class="form-control" 
                                    name="hours"
                                    placeholder="Enter hours"
                                    required
                                ></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="text-left">
                    <button class="btn btn-sm btn-success"
                        type="submit">Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    
@endsection