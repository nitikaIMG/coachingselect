@extends('main')

@section('heading')
Admin Profile & Change Password
@endsection('heading')

@section('sub-heading')
@endsection('sub-heading')

@section('card-heading-btn')
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">Admin Profile</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="{{ action('AdminController@admin_profile') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-0">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" name="name" required value="{{auth()->user()->name ?? ''}}" placeholder="Enter name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{auth()->user()->email ?? ''}}" required placeholder="Enter email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Mobile</label>
                                    <input required="" placeholder="Enter Mobile Number" class="form-control form-control-solid"
                                    value="{{auth()->user()->mobile ?? ''}}"
                                    autocomplete="off" onkeypress="return isNumberKey(event)" pattern="[6789][0-9]{9}" minlength="10" maxlength="10" name="mobile" type="tel">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Alternative Mobile (if any)</label>
                                    <input placeholder="Enter Alternative Mobile Number" class="form-control form-control-solid"
                                    value="{{auth()->user()->alternative_mobile ?? ''}}"
                                    autocomplete="off" onkeypress="return isNumberKey(event)" pattern="[6789][0-9]{9}" minlength="10" maxlength="10" name="alternative_mobile" type="tel">
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button class="btn btn-sm btn-success" type="submit"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                        </div>

                    </div>
                </form>
                <!--===================================================-->
                <!--End Block Styled Form -->
            </div>
        </div>
    </div>
</div>

<div class="card my-4">
    <div class="card-header">Change Password</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content">
                <form action="{{ action('AdminController@change_password') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body p-0">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Old Password</label>
                                    <input type="password" class="form-control" name="old_password" required placeholder="Enter old password">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">New Password</label>
                                    <input type="password" class="form-control" name="new_password" required placeholder="Enter new password">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirm_password" required placeholder="Enter confirm password">
                                </div>
                            </div>
                            <div class="col-12 text-right">
                                <button class="btn btn-sm btn-success" type="submit"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!--===================================================-->
                <!--End Block Styled Form -->
            </div>
        </div>
    </div>
</div>

@endsection