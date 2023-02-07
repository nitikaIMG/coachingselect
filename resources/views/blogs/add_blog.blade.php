@extends('main')

@section('heading')
Blogs 
@endsection('heading')

@section('sub-heading')
Add Blog
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('BlogsController@view_blog')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View all blog"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">Add Blog</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="{{ action('BlogsController@add_blog') }}" method="post" enctype="multipart/form-data"
                    onsubmit="return is_description_given();"
                >
                    @csrf
                    <div class="card-body p-0">

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Meta Title</label>
                                    <input type="text" class="form-control" name="metatitle" placeholder="Enter Meta Title" >
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Meta Description</label>
                                    <textarea class="form-control" name="metadescription" placeholder="Enter Meta Description" ></textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Meta Keywords</label>
                                    <textarea class="form-control" name="metakeywords" placeholder="Enter Meta Keywords" ></textarea>
                                </div>
                            </div>
                            
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Category</label>
                                    <select name="blog_category_id" id="blog_category_id" class="form-control selectpicker show-tick" data-width="full" data-container="body" data-live-search="true" required>
                                        <option value="">Select Category</option>
                                        @if( !empty($blogs_category) )
                                        @foreach($blogs_category as $blog_category)
                                        <option value="{{$blog_category->id}}">{{$blog_category->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Enter Title" required
                                    >
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <input type="file" class="form-control" style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File" name="image" required>
                                
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>

                                    <p class="text-danger fs-12">Note: Best Image Resolution 1280 X 720</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Short Description</label>

                                    <textarea name="short_description" class="form-control" required placeholder="Enter short description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Description</label>

                                    <textarea 
                                        name="description"
                                        id="description"
                                        class="form-control required"
                                        required placeholder="Enter description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Tags</label>
                                    <input type="text" multiple class="tagsInput form-control" data-user-option-allowed="true" data-url="{{ action('BlogsController@tags') }}" data-load-once="true" name="tags" />
                                    <select id="tag-select" class="d-none form-control">
                                        <option value="">Select Tags</option>
                                        @if( !empty($tags) )
                                        @foreach($tags as $tag)
                                        <option value="{{$tag->text}}">{{$tag->text}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Written By</label>
                                    <input type="text" class="form-control" name="written_by" placeholder="Enter Written By">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">About Writer</label>
                                    <textarea name="about_writer" class="form-control" placeholder="Enter about writer"></textarea>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Writer Image</label>
                                    <input type="file" class="form-control" style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File" name="writer_image">
                                
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal1" class="upload-pic-view d-none" id="pdf-eye1"><i class="fas fa-eye"></i></a>
                                    
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
        function check_title_description_minimum_length() {
            
            var modals = [];

            if(
                $.trim($('input[name="title"]').val()).length < 60
                ||
                $.trim(CKEDITOR.instances.description.getData()).length < 250
            ) {

                if(
                    $.trim($('input[name="title"]').val()).length < 60
                ) {
                    modals.push({
                        title: 'Alert',
                        text: 'Title should be minimum of 60 characters'
                    });
                }

                if(
                    $.trim(CKEDITOR.instances.description.getData()).length < 250
                ) {
                    modals.push({
                        title: 'Alert',
                        text: 'Description should be minimum of 250 characters'
                    });
                }

                swal.queue(modals);
                return false;
            }

            return true;

        }
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