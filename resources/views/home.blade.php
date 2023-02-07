@extends('main')

@section('heading')
Dashboard
@endsection('heading')

@section('content')
@include('alert_msg')

<?php

    #User subadmin Permissions - date: 27 dec

    $r1 = Route::getCurrentRoute()->getAction();
    $r2 = Route::currentRouteAction();
    $r3 = Route::currentRouteName();

    $r4 = explode('@', $r2);

    $permissions_string = Auth::user()->permissions;
    $permissions_array = explode(',', $permissions_string);

    #end subadmin Permissions work
?>

<div class="row">
    
    @if( in_array("StudentQuestionsAnswersController@view_student_questions" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
    <div class="col-xl-4 col-md-4 mb-4">
        
        <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-primary h-100 rounded-15">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-4 fs-50 position-relative">
                        <i class="fad fa-university"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="small font-weight-bold text-uppercase text-primary mb-1 fs-15">Question & Answer</div>
                        <div class="fs-25 position-absolute top-10px bottom-0 my-auto right-18px font-weight-bold d-grid align-items-center" style="text-shadow: 1px 2px 1px #b5b5b5;">{{$total_qna}}</div>
                        <div class="text-xs font-weight-bold d-inline-flex align-items-center">
                            <a href="{{action('StudentQuestionsAnswersController@view_student_questions')}}" class="btn btn-sm btn-primary text-uppercase btn-sm btn-xs px-2">OPEN &nbsp; &nbsp; <i class="fad fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if( in_array("BlogsController@view_blog" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
    <div class="col-xl-4 col-md-4 mb-4">
        
        <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-primary h-100 rounded-15">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-4 fs-50 position-relative">
                        <i class="fas fa-users"></i>

                    </div>
                    <div class="flex-grow-1">
                        <div class="small font-weight-bold text-uppercase text-primary mb-1 fs-15">Blogs</div>
                        <div class="fs-25 position-absolute top-10px bottom-0 my-auto right-18px font-weight-bold d-grid align-items-center" style="text-shadow: 1px 2px 1px #b5b5b5;">{{$total_blogs}}</div>
                        <div class="text-xs font-weight-bold d-inline-flex align-items-center">
                            <a href="{{action('BlogsController@view_blog')}}" class="btn btn-sm btn-primary text-uppercase btn-sm btn-xs px-2">OPEN &nbsp; &nbsp; <i class="fad fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if( in_array("CoachingController@view_coaching" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
    <div class="col-xl-4 col-md-4 mb-4">
        
        <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-primary h-100 rounded-15">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-4 fs-50 position-relative">
                        <i class="fad fa-newspaper"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="small font-weight-bold text-uppercase text-primary mb-1 fs-15">Coaching</div>
                        <div class="fs-25 position-absolute top-10px bottom-0 my-auto right-18px font-weight-bold d-grid align-items-center" style="text-shadow: 1px 2px 1px #b5b5b5;">{{$total_coaching}}</div>
                        <div class="text-xs font-weight-bold d-inline-flex align-items-center">
                            <a href="{{action('CoachingController@view_coaching')}}" class="btn btn-sm btn-primary text-uppercase btn-sm btn-xs px-2">OPEN &nbsp; &nbsp; <i class="fad fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if( in_array("CollegeController@view_college" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
    <div class="col-xl-4 col-md-4 mb-4">
        
        <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-primary h-100 rounded-15">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-4 fs-50 position-relative">
                        <i class="fas fa-university"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="small font-weight-bold text-uppercase text-primary mb-1 fs-15">College</div>
                        <div class="fs-25 position-absolute top-10px bottom-0 my-auto right-18px font-weight-bold d-grid align-items-center" style="text-shadow: 1px 2px 1px #b5b5b5;">{{$total_college}}</div>
                        <div class="text-xs font-weight-bold d-inline-flex align-items-center">
                            <a href="{{action('CollegeController@view_college')}}" class="btn btn-sm btn-primary text-uppercase btn-sm btn-xs px-2">OPEN &nbsp; &nbsp; <i class="fad fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if( in_array("ExamsController@view_exam" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
    <div class="col-xl-4 col-md-4 mb-4">
        
        <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-primary h-100 rounded-15">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-4 fs-50 position-relative">
                        <i class="fad fa-trophy"></i>

                    </div>
                    <div class="flex-grow-1">
                        <div class="small font-weight-bold text-uppercase text-primary mb-1 fs-15">Exams</div>
                        <div class="fs-25 position-absolute top-10px bottom-0 my-auto right-18px font-weight-bold d-grid align-items-center" style="text-shadow: 1px 2px 1px #b5b5b5;">{{$total_exams}}</div>
                        <div class="text-xs font-weight-bold d-inline-flex align-items-center">
                            <a href="{{action('ExamsController@view_exam')}}" class="btn btn-sm btn-primary text-uppercase btn-sm btn-xs px-2">OPEN &nbsp; &nbsp; <i class="fad fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if( in_array("FreePreparationToolController@view_question_paper_subjects" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
    <div class="col-xl-4 col-md-4 mb-4">
        
        <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-primary h-100 rounded-15">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-4 fs-50 position-relative">
                        <i class="fad fa-question-circle"></i>

                    </div>
                    <div class="flex-grow-1">
                        <div class="small font-weight-bold text-uppercase text-primary mb-1 fs-15">Study Materials</div>
                        <div class="fs-25 position-absolute top-10px bottom-0 my-auto right-18px font-weight-bold d-grid align-items-center" style="text-shadow: 1px 2px 1px #b5b5b5;">{{$total_question_paper_subjects}}</div>
                        <div class="text-xs font-weight-bold d-inline-flex align-items-center">
                            <a href="{{action('FreePreparationToolController@view_question_paper_subjects')}}" class="btn btn-sm btn-primary text-uppercase btn-sm btn-xs px-2">OPEN &nbsp; &nbsp; <i class="fad fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if( in_array("EnterpriseController@view_enterprise" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
    <div class="col-xl-4 col-md-4 mb-4">
        
        <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-primary h-100 rounded-15">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-4 fs-50 position-relative">
                        <i class="fad fa-newspaper"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="small font-weight-bold text-uppercase text-primary mb-1 fs-15">Enterprise</div>
                        <div class="fs-25 position-absolute top-10px bottom-0 my-auto right-18px font-weight-bold d-grid align-items-center" style="text-shadow: 1px 2px 1px #b5b5b5;">{{$total_enterprise}}</div>
                        <div class="text-xs font-weight-bold d-inline-flex align-items-center">
                            <a href="{{action('EnterpriseController@view_enterprise')}}" class="btn btn-sm btn-primary text-uppercase btn-sm btn-xs px-2">OPEN &nbsp; &nbsp; <i class="fad fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if( in_array("StudentController@view_students" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
    <div class="col-xl-4 col-md-4 mb-4">
        
        <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-primary h-100 rounded-15">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-4 fs-50 position-relative">
                        <i class="fad fa-users"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="small font-weight-bold text-uppercase text-primary mb-1 fs-15">Students</div>
                        <div class="fs-25 position-absolute top-10px bottom-0 my-auto right-18px font-weight-bold d-grid align-items-center" style="text-shadow: 1px 2px 1px #b5b5b5;">{{$total_students}}</div>
                        <div class="text-xs font-weight-bold d-inline-flex align-items-center">
                            <a href="{{action('StudentController@view_students')}}" class="btn btn-sm btn-primary text-uppercase btn-sm btn-xs px-2">OPEN &nbsp; &nbsp; <i class="fad fa-users"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if( in_array("GeneralController@view_requestcallback" ,$permissions_array ) || Auth::user()->role == '1' || $permissions_string == '*')
    <div class="col-xl-4 col-md-4 mb-4">
        
        <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-primary h-100 rounded-15">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-4 fs-50 position-relative">
                        <i class="fad fa-box"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="small font-weight-bold text-uppercase text-primary mb-1 fs-15">Generals</div>
                        <div class="fs-25 position-absolute top-10px bottom-0 my-auto right-18px font-weight-bold d-grid align-items-center" style="text-shadow: 1px 2px 1px #b5b5b5;">{{$ttl_generals}}</div>
                        <div class="text-xs font-weight-bold d-inline-flex align-items-center">
                            <a href="{{action('GeneralController@view_requestcallback')}}" class="btn btn-sm btn-primary text-uppercase btn-sm btn-xs px-2">OPEN &nbsp; &nbsp; <i class="fad fa-box"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection('content')