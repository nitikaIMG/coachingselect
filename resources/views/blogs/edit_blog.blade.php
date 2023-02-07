@extends('main')

@section('heading')
Blogs 
@endsection('heading')

@section('sub-heading')
Edit Blog
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('BlogsController@view_blog')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View all blog"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')
<div class="card">
    <div class="card-header">Edit Blog</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="{{ action('BlogsController@edit_blog') }}" method="post" enctype="multipart/form-data"
                    onsubmit="return is_description_given();"
                >
                    @csrf

                    <input type="hidden" name="id" value="{{$blog->id}}">
                    <div class="card-body p-0">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Meta Title</label>
                                    <input type="text" class="form-control" name="metatitle" placeholder="Enter Meta Title" 
                                    value="{{$blog->metatitle}}"
                                    >
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Meta Description</label>
                                    <textarea class="form-control" name="metadescription" placeholder="Enter Meta Description" >{{$blog->metadescription}}</textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Meta Keywords</label>
                                    <textarea class="form-control" name="metakeywords" placeholder="Enter Meta Keywords" >{{$blog->metakeywords}}</textarea>
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Category</label>
                                    <select name="blog_category_id" id="blog_category_id" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required>
                                        <option value="">Select Category</option>
                                        @if( !empty($blogs_category) )
                                        @foreach($blogs_category as $blog_category)
                                        <option value="{{$blog_category->id}}" @if($blog->blog_category_id == $blog_category->id)
                                            selected
                                            @endif
                                            >{{$blog_category->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{$blog->title}}" required>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    @php

                                    $image = asset('public/blogs/'. $blog->image);

                                    if(! @GetImageSize($image) )
                                    $image = asset('public/logo.png');

                                    @endphp
                                    <label class="control-label">Image</label>
                                    <input type="file" class="form-control uploaded" style="--upload-pic:url({{$image}});" upload-pic="" name="image">
                                
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                                
                                    <p class="text-danger fs-12">Note: Best Image Resolution 1280 X 720</p>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Short Description</label>

                                    <textarea name="short_description" class="form-control" required placeholder="Enter short description">{{$blog->short_description}}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Description</label>

                                    <textarea name="description"
                                        id="description" class="form-control ckeditor" required placeholder="Enter description">{{$blog->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Tags</label>
                                    <input type="text" multiple class="tagsInput" data-initial-value='{{$blog->tags ?? ""}}' data-user-option-allowed="true" data-url="{{ action('BlogsController@tags') }}" data-load-once="true" name="tags" />
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Written By</label>
                                    <input type="text" class="form-control" name="written_by" placeholder="Enter Written By" value="{{$blog->written_by ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">About Writer</label>
                                    <textarea name="about_writer" class="form-control" placeholder="Enter about writer">{{ $blog->about_writer ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    @php

                                    $writer_image = asset('public/blogs/'. $blog->writer_image);

                                    if(! @GetImageSize($writer_image) )
                                    $writer_image = asset('public/logo.png');

                                    @endphp
                                    <label class="control-label">Writer Image</label>
                                    <input type="file" class="form-control uploaded" style="--upload-pic:url({{$writer_image}});" upload-pic="" name="writer_image">
                                
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye1"><i class="fas fa-eye"></i></a>
                                    
                                    <p class="text-danger fs-12">Note: Best Image Resolution 200 X 200</p>
                                </div>
                            </div>
                            <div class="col-12 text-right">
                                <button 
                                    class="btn btn-sm btn-success" type="submit"  
                                ><i class="far fa-check-circle"></i>&nbsp;Submit</button>    
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(
        function() {
            $('input[name="selectall"]').each(
                function() {
                    var id = $(this).attr('id');

                    var count = $('.' + id).length - 1;

                    var checked_checkbox = $('.' + id + ':checked').length;

                    if (checked_checkbox == count) {
                        $(this).prop('checked', true);
                    }
                }
            )
        }
    );
</script>

<script>
    CKEDITOR.replace( 'description', {
        filebrowserUploadUrl: "{{ action('BlogsController@ckeditor_image', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    
    CKEDITOR.instances.description.on("change", function() {

    });
    
</script>

<script>
    function is_description_given() {

        var txt = CKEDITOR.instances.description.getData();
        
        if(txt.length == 0) {
            swal.fire({
            title: 'Alert',
            'text': 'Description is required'
            });

            return false;
        }
    }
</script>

@endsection