@extends('main')

@section('heading')
College Categories
@endsection('heading')

@section('sub-heading')
Edit College Category
@endsection('sub-heading')

@section('card-heading-btn')
<a href="{{action('CollegeCategoryController@view_college_category')}}" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="" data-original-title="View All College Category"><i class="fad fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')
<div class="card">
    <div class="card-header">Edit College Category</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="{{ action('CollegeCategoryController@edit_college_category') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{$college->id}}">
                    <div class="card-body p-0">

                        <div class="row align-items-center">
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{$college->name}}" required>
                                </div>
                            </div>
                            <div class="col-auto align-self-end">
                                <button class="btn btn-sm my-3 btn-success" type="submit"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection