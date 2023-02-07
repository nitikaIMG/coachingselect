@extends('main')

@section('heading')
Coaching Logo Link Manager
@endsection('heading')

@section('sub-heading')
Add Coaching Logo Link
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CoachingLogoLinkController@view_coaching_logo_link')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View All Coaching Logo Link"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">Add Coaching Logo Link</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="{{ action('CoachingLogoLinkController@add_coaching_logo_link') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-0">

                        <div class="row align-items-center">
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Coaching Logo Link Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Coaching Logo Link Name" required>
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <input type="file" class="form-control" style="--upload-pic:url(../avtar1.png);" upload-pic="No Choosen File" name="image" required>
                                
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                                </div>

                            </div>

                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Url</label>
                                    <input type="url" class="form-control" name="url" placeholder="Enter URL" required>
                                </div>
                            </div>

                            <div class="col-auto align-self-end">
                                <button class="btn btn-sm btn-success my-3" type="submit"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
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
    @endsection