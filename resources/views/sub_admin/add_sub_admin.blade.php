@extends('main')

@section('heading')
    Sub Admin Manager
@endsection('heading')

@section('sub-heading')
    Add Sub Admin
@endsection('sub-heading')

@section('card-heading-btn')
<a  href="<?php echo action('SubAdminController@view_sub_admin') ?>" class="btn btn-sm btn-light font-weight-bold text-uppercase text-primary float-right" data-toggle="tooltip" title="View All Sub admin"><i class="fa fa-eye"></i>&nbsp; View</a>
@endsection('card-heading-btn')

@section('content')

@include('alert_msg')

<div class="card">
    <div class="card-header">Add Sub Admin</div>
    <div class="card-body">
        <div class="sbp-preview">
            <div class="sbp-preview-content p-4">
                {{ Form::open(array('url' => action('SubAdminController@add_sub_admin'), 'method' => 'post','id' => 'j-forms','class'=>'j-forms row mx-0' ))}}

                    {{csrf_field()}}
                    
                    <div class="form-group col-md-6 col-12">
                        <label class='control-label text-bold' for="first-name">Name<span>*</span></label>
                        <input name="name" class="form-control form-control-solid" type="text" placeholder="Please enter name" required="">
                    </div>   
                    
                    <div class="form-group col-md-6 col-12">
                        <label class="control-label text-bold" for="first-name">Email<span class="">*</span></label>
                        <input name="email" class="form-control form-control-solid" type="email" placeholder="Please enter email" required="">
                    </div>   
                    
                    <div class="form-group col-md-6 col-12">
                        <label class="control-label text-bold" for="first-name">Mobile<span class="">*</span></label>
                        <input name="mobile" class="form-control form-control-solid" type="text" 
                        placeholder="Please enter Mobile" id="mobile"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                        maxlength="10" pattern="[1-9]{1}[0-9]{9}">
                    </div>   

                    <div class="form-group col-md-6 col-12">
                        <label class="control-label text-bold" for="first-name">Password<span class="">*</span></label>
                        <input name="password" class="form-control form-control-solid" type="text" placeholder="Please enter password" required="">
                    </div>
 

                    <div class="form-group col-12 mt-2">
                        <label class="control-label text-2x" for="first-name">Permissions<span class="required">*</span></label>
                        <div class="row">
                            
                            <div class="col-lg-4 col-md-6 col-12 my-2">
                                <div class="row shadow bg-white rounded-10 py-3 px-2 mx-0 h-100">
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="control-label text-primary">
                                            <i class="fad fa-shield-alt"></i>
                                            Streams, Courses, Facilities     
                                        </label>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon1" name="selectall" id="selectallcoupon1">
                                            <label class="custom-control-label fs-14 text-uppercase font-weight-900" for="selectallcoupon1">Select all Permissions</label>
                                            <script>
                                                $(document).ready(function(){
                                                    $("#selectallcoupon1").click(function(){
                                                        if(this.checked){
                                                            $('.selectallcoupon1').each(function(){
                                                                $(".selectallcoupon1").prop('checked', true);
                                                            })
                                                        }else{
                                                            $('.selectallcoupon1').each(function(){
                                                                $(".selectallcoupon1").prop('checked', false);
                                                            })
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>
                                        
                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Stream  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon1" id="selectallcoupon1-popular1" 
                                            value="StreamsController@add_stream" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon1-popular1">Add Stream</label>
                                        </div>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon1" id="selectallcoupon1-popular1-edit" 
                                            value="StreamsController@edit_stream" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon1-popular1-edit">Edit Stream</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon1" id="selectallcoupon1-popular1-delete" 
                                            value="StreamsController@delete_stream" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon1-popular1-delete">Enable/Disable Stream</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon1" id="selectallcoupon1-popular2" 
                                            value="StreamsController@view_stream,StreamsController@view_stream_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon1-popular2">View Streams</label>
                                        </div>

                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Course  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon1" id="selectallcoupon1-popular3" 
                                            value="CoursesController@add_course" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon1-popular3">Add Course</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon1" id="selectallcoupon1-popular3-edit" 
                                            value="CoursesController@edit_course" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon1-popular3-edit">Edit Course</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon1" id="selectallcoupon1-popular3-delete" 
                                            value="CoursesController@delete_course" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon1-popular3-delete">Enable/Disable Course</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon1" id="selectallcoupon1-popular4" 
                                            value="CoursesController@view_course,CoursesController@view_course_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon1-popular4">View Course</label>
                                        </div>
                                        
                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Facilities  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon1" id="selectallcoupon1-popular5" 
                                            value="FacilityController@add_facility" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon1-popular5">Add Facilities</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon1" id="selectallcoupon1-popular5-edit" 
                                            value="FacilityController@edit_facility" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon1-popular5-edit">Edit Facilities</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon1" id="selectallcoupon1-popular5-delete" 
                                            value="FacilityController@delete_facility" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon1-popular5-delete">Enable/Disable Facilities</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon1" id="selectallcoupon1-popular6" 
                                            value="FacilityController@view_facility,FacilityController@view_facility_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon1-popular6">View Facilities</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-12 my-2">
                                <div class="row shadow bg-white rounded-10 py-3 px-2 mx-0 h-100">
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="control-label text-primary">
                                            <i class="fad fa-shield-alt"></i>
                                            Blogs  
                                        </label>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon2" name="selectall" id="selectallcoupon2">
                                            <label class="custom-control-label fs-14 text-uppercase font-weight-900" for="selectallcoupon2">Select all Permissions</label>
                                            <script>
                                                $(document).ready(function(){
                                                    $("#selectallcoupon2").click(function(){
                                                        if(this.checked){
                                                            $('.selectallcoupon2').each(function(){
                                                                $(".selectallcoupon2").prop('checked', true);
                                                            })
                                                        }else{
                                                            $('.selectallcoupon2').each(function(){
                                                                $(".selectallcoupon2").prop('checked', false);
                                                            })
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>

                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Categories  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon2" id="selectallcoupon2-popular1" 
                                            value="BlogsCategoryController@add_blog_category" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon2-popular1">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon2" id="selectallcoupon2-popular1-edit" 
                                            value="BlogsCategoryController@edit_blog_category" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon2-popular1-edit">Edit</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon2" id="selectallcoupon2-popular1-delete" 
                                            value="BlogsCategoryController@delete_blog_category" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon2-popular1-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon2" id="selectallcoupon2-popular2" 
                                            value="BlogsCategoryController@view_blog_category,BlogsCategoryController@view_blog_category_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon2-popular2">View</label>
                                        </div>
                                        
                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Blogs  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon2" id="selectallcoupon2-popular3" 
                                            value="BlogsController@add_blog" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon2-popular3">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon2" id="selectallcoupon2-popular3-edit" 
                                            value="BlogsController@edit_blog" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon2-popular3-edit">Edit</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon2" id="selectallcoupon2-popular3-delete" 
                                            value="BlogsController@delete_blog" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon2-popular3-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon2" id="selectallcoupon2-popular4" 
                                            value="BlogsController@view_blog,BlogsController@view_blog_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon2-popular4">View</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-12 my-2">
                                <div class="row shadow bg-white rounded-10 py-3 px-2 mx-0 h-100">
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="control-label text-primary">
                                            <i class="fad fa-shield-alt"></i>
                                            Questions & Answers (Q&A)     
                                        </label>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon3" name="selectall" id="selectallcoupon3">
                                            <label class="custom-control-label fs-14 text-uppercase font-weight-900" for="selectallcoupon3">Select all Permissions</label>
                                            <script>
                                                $(document).ready(function(){
                                                    $("#selectallcoupon3").click(function(){
                                                        if(this.checked){
                                                            $('.selectallcoupon3').each(function(){
                                                                $(".selectallcoupon3").prop('checked', true);
                                                            })
                                                        }else{
                                                            $('.selectallcoupon3').each(function(){
                                                                $(".selectallcoupon3").prop('checked', false);
                                                            })
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon3" id="selectallcoupon3-popular1" 
                                            value="StudentQuestionsAnswersController@view_student_questions,StudentQuestionsAnswersController@view_student_questions_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon3-popular1">View Questions</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon3" id="selectallcoupon3-popular1-ans" 
                                            value="StudentQuestionsAnswersController@view_student_answers,StudentQuestionsAnswersController@view_student_answers_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon3-popular1-ans">View Answers</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-12 my-2">
                                <div class="row shadow bg-white rounded-10 py-3 px-2 mx-0 h-100">
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="control-label text-primary">
                                            <i class="fad fa-shield-alt"></i>
                                            Trending Today     
                                        </label>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon4" name="selectall" id="selectallcoupon4">
                                            <label class="custom-control-label fs-14 text-uppercase font-weight-900" for="selectallcoupon4">Select all Permissions</label>
                                            <script>
                                                $(document).ready(function(){
                                                    $("#selectallcoupon4").click(function(){
                                                        if(this.checked){
                                                            $('.selectallcoupon4').each(function(){
                                                                $(".selectallcoupon4").prop('checked', true);
                                                            })
                                                        }else{
                                                            $('.selectallcoupon4').each(function(){
                                                                $(".selectallcoupon4").prop('checked', false);
                                                            })
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon4" id="selectallcoupon4-popular1" 
                                            value="TrendingTodayController@add_trending_today" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon4-popular1">Add</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon4" id="selectallcoupon4-popular1-edit" 
                                            value="TrendingTodayController@edit_trending_today" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon4-popular1-edit">Edit</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon4" id="selectallcoupon4-popular1-delete" 
                                            value="TrendingTodayController@delete_trending_today" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon4-popular1-delete">Enable/Disable</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon4" id="selectallcoupon4-popular2" 
                                            value="TrendingTodayController@view_trending_today,TrendingTodayController@view_trending_today_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon4-popular2">View</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-12 my-2">
                                <div class="row shadow bg-white rounded-10 py-3 px-2 mx-0 h-100">
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="control-label text-primary">
                                            <i class="fad fa-shield-alt"></i>
                                            Advertisements     
                                        </label>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon5" name="selectall" id="selectallcoupon5">
                                            <label class="custom-control-label fs-14 text-uppercase font-weight-900" for="selectallcoupon5">Select all Permissions</label>
                                            <script>
                                                $(document).ready(function(){
                                                    $("#selectallcoupon5").click(function(){
                                                        if(this.checked){
                                                            $('.selectallcoupon5').each(function(){
                                                                $(".selectallcoupon5").prop('checked', true);
                                                            })
                                                        }else{
                                                            $('.selectallcoupon5').each(function(){
                                                                $(".selectallcoupon5").prop('checked', false);
                                                            })
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon5" id="selectallcoupon5-popular1" 
                                            value="AdvertisementController@advertisement" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon5-popular1">Add</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon5" id="selectallcoupon5-popular1-edit" 
                                            value="AdvertisementController@edit_advertisement,AdvertisementController@update_advertisement" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon5-popular1-edit">Edit</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon5" id="selectallcoupon5-popular1-delete" 
                                            value="AdvertisementController@delete_advertisement" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon5-popular1-delete">Enable/Disable</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon5" id="selectallcoupon5-popular2" 
                                            value="AdvertisementController@view_advertisement,AdvertisementController@view_advertisement_table" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon5-popular2">View</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-12 my-2">
                                <div class="row shadow bg-white rounded-10 py-3 px-2 mx-0 h-100">
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="control-label text-primary">
                                            <i class="fad fa-shield-alt"></i>
                                            Coachings  
                                        </label>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" name="selectall" id="selectallcoupon6">
                                            <label class="custom-control-label fs-14 text-uppercase font-weight-900" for="selectallcoupon6">Select all Permissions</label>
                                            <script>
                                                $(document).ready(function(){
                                                    $("#selectallcoupon6").click(function(){
                                                        if(this.checked){
                                                            $('.selectallcoupon6').each(function(){
                                                                $(".selectallcoupon6").prop('checked', true);
                                                            })
                                                        }else{
                                                            $('.selectallcoupon6').each(function(){
                                                                $(".selectallcoupon6").prop('checked', false);
                                                            })
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>

                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Coachings  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1" 
                                            value="CoachingController@add_coaching" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-edit" 
                                            value="CoachingController@edit_coaching" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-edit">Edit</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-delete" 
                                            value="CoachingController@delete_coaching" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular2" 
                                            value="CoachingController@view_coaching,CoachingController@view_coaching_dt,CoachingController@is_featured" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular2">View</label>
                                        </div>
                                        
                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Coachings (Course)  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-course-add" 
                                            value="CoachingController@add_courses_detail" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-course-add">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-course-edit" 
                                            value="CoachingController@edit_coaching_courses_detail" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-course-edit">Edit</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-course-delete" 
                                            value="CoachingController@delete_coaching_courses_detail" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-course-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-course-view" 
                                            value="CoachingController@view_coaching_courses_detail,CoachingController@view_coaching_courses_detail_dt,CoachingController@is_featured_course" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-course-view">View</label>
                                        </div>
                                        
                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Coachings (faculty)  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-faculty-add" 
                                            value="CoachingController@add_faculty" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-faculty-add">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-faculty-edit" 
                                            value="CoachingController@edit_coaching_faculty" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-faculty-edit">Edit</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-faculty-delete" 
                                            value="CoachingController@delete_coaching_faculty" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-faculty-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-faculty-view" 
                                            value="CoachingController@view_coaching_faculty,CoachingController@view_coaching_faculty_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-faculty-view">View</label>
                                        </div>
                                        
                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Coachings (results)  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-results-add" 
                                            value="CoachingController@add_results" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-results-add">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-results-edit" 
                                            value="CoachingController@edit_coaching_results" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-results-edit">Edit</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-results-delete" 
                                            value="CoachingController@delete_coaching_results" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-results-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-results-view" 
                                            value="CoachingController@view_coaching_results,CoachingController@view_coaching_results_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-results-view">View</label>
                                        </div>
                                        
                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Coachings (photos)  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-photos-add" 
                                            value="CoachingController@add_photos" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-photos-add">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-photos-edit" 
                                            value="CoachingController@edit_coaching_photos" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-photos-edit">Edit</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-photos-delete" 
                                            value="CoachingController@delete_coaching_photos" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-photos-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-photos-view" 
                                            value="CoachingController@view_coaching_photos,CoachingController@view_coaching_photos_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-photos-view">View</label>
                                        </div>
                                        
                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Coachings (videos)  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-videos-add" 
                                            value="CoachingController@add_videos" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-videos-add">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-videos-edit" 
                                            value="CoachingController@edit_coaching_videos" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-videos-edit">Edit</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-videos-delete" 
                                            value="CoachingController@delete_coaching_videos" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-videos-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-videos-view" 
                                            value="CoachingController@view_coaching_videos,CoachingController@view_coaching_videos_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-videos-view">View</label>
                                        </div>
                                        
                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Coachings (facility)  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-facility-add" 
                                            value="CoachingController@add_facilities,CoachingController@all_facilities,CoachingController@select_facility,CoachingController@deselect_facility" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-facility-add">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-facility-delete" 
                                            value="CoachingController@delete_coaching_facility" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-facility-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-facility-view" 
                                            value="CoachingController@view_coaching_facility,CoachingController@view_coaching_facility_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-facility-view">View</label>
                                        </div>
                                        
                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Coachings (branch)  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-branch-add" 
                                            value="CoachingController@add_branch" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-branch-add">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-branch-edit" 
                                            value="CoachingController@edit_coaching_centers_branches" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-branch-edit">Edit</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-branch-delete" 
                                            value="CoachingController@delete_coaching_centers_branches" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-branch-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-branch-view" 
                                            value="CoachingController@view_coaching_centers_branches,CoachingController@view_coaching_centers_branches_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-branch-view">View</label>
                                        </div>

                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Coachings (testimonials)  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-testimonials-add" 
                                            value="CoachingController@add_testimonials" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-testimonials-add">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-testimonials-edit" 
                                            value="CoachingController@edit_coaching_testimonials" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-testimonials-edit">Edit</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-testimonials-delete" 
                                            value="CoachingController@delete_coaching_testimonials" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-testimonials-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-testimonials-view" 
                                            value="CoachingController@view_coaching_testimonials,CoachingController@view_coaching_testimonials_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-testimonials-view">View</label>
                                        </div>
                                        
                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Coachings (reviews)  
                                        </label>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-reviews-delete" 
                                            value="CoachingController@delete_coaching_reviews" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-reviews-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular1-reviews-view" 
                                            value="CoachingController@view_coaching_reviews,CoachingController@view_coaching_reviews_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular1-reviews-view">View</label>
                                        </div>

                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Course Buyed  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon6" id="selectallcoupon6-popular3" 
                                            value="OrderController@view_orders,OrderController@view_orders_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon6-popular3">View</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-12 my-2">
                                <div class="row shadow bg-white rounded-10 py-3 px-2 mx-0 h-100">
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="control-label text-primary">
                                            <i class="fad fa-shield-alt"></i>
                                            Colleges  
                                        </label>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon7" name="selectall" id="selectallcoupon7">
                                            <label class="custom-control-label fs-14 text-uppercase font-weight-900" for="selectallcoupon7">Select all Permissions</label>
                                            <script>
                                                $(document).ready(function(){
                                                    $("#selectallcoupon7").click(function(){
                                                        if(this.checked){
                                                            $('.selectallcoupon7').each(function(){
                                                                $(".selectallcoupon7").prop('checked', true);
                                                            })
                                                        }else{
                                                            $('.selectallcoupon7').each(function(){
                                                                $(".selectallcoupon7").prop('checked', false);
                                                            })
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>

                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Categories  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon7" id="selectallcoupon7-popular1" 
                                            value="CollegeCategoryController@add_college_category" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon7-popular1">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon7" id="selectallcoupon7-popular1-edit" 
                                            value="CollegeCategoryController@edit_college_category" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon7-popular1-edit">Edit</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon7" id="selectallcoupon7-popular1-delete" 
                                            value="CollegeCategoryController@delete_college_category" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon7-popular1-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon7" id="selectallcoupon7-popular2" 
                                            value="CollegeCategoryController@view_college_category,CollegeCategoryController@view_college_category_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon7-popular2">View</label>
                                        </div>
                                        
                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Colleges  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon7" id="selectallcoupon7-popular3" 
                                            value="CollegeController@add_college" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon7-popular3">Add</label>
                                        </div>
                                         <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon7" id="selectallcoupon7-popular3-edit" 
                                            value="CollegeController@edit_college" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon7-popular3-edit">Edit</label>
                                        </div>
                                         <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon7" id="selectallcoupon7-popular3-delete" 
                                            value="CollegeController@delete_college" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon7-popular3-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon7" id="selectallcoupon7-popular4" 
                                            value="CollegeController@view_college,CollegeController@view_college_datatable" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon7-popular4">View</label>
                                        </div>
                                        
                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Colleges Valuable 
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon7" id="selectallcoupon7-popular5-adit" 
                                            value="CollegeController@add_valuable" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon7-popular5-adit">Add</label>
                                        </div>
                                         <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon7" id="selectallcoupon7-popular5-edit" 
                                            value="CollegeController@edit_college_valuable" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon7-popular5-edit">Edit</label>
                                        </div>
                                         <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon7" id="selectallcoupon7-popular5-delete" 
                                            value="CollegeController@delete_college_valuable" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon7-popular5-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon7" id="selectallcoupon7-popular5-view" 
                                            value="CollegeController@view_college_valuable,CollegeController@view_college_valuable_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon7-popular5-view">View</label>
                                        </div>
                                        
                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Colleges Images 
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon7" id="selectallcoupon7-popular6-adit" 
                                            value="CollegeController@add_colgimages" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon7-popular6-adit">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon7" id="selectallcoupon7-popular6-view" 
                                            value="CollegeController@view_colgimage" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon7-popular6-view">View</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-12 my-2">
                                <div class="row shadow bg-white rounded-10 py-3 px-2 mx-0 h-100">
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="control-label text-primary">
                                            <i class="fad fa-shield-alt"></i>
                                            Exams  
                                        </label>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon8" name="selectall" id="selectallcoupon8">
                                            <label class="custom-control-label fs-14 text-uppercase font-weight-900" for="selectallcoupon8">Select all Permissions</label>
                                            <script>
                                                $(document).ready(function(){
                                                    $("#selectallcoupon8").click(function(){
                                                        if(this.checked){
                                                            $('.selectallcoupon8').each(function(){
                                                                $(".selectallcoupon8").prop('checked', true);
                                                            })
                                                        }else{
                                                            $('.selectallcoupon8').each(function(){
                                                                $(".selectallcoupon8").prop('checked', false);
                                                            })
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon8" id="selectallcoupon8-popular1" 
                                            value="ExamsController@add_exam" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon8-popular1">Add</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon8" id="selectallcoupon8-popular1-edit" 
                                            value="ExamsController@edit_exam" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon8-popular1-edit">Edit</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon8" id="selectallcoupon8-popular1-delete" 
                                            value="ExamsController@delete_exam" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon8-popular1-delete">Enable/Disable</label>
                                        </div>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon8" id="selectallcoupon8-popular2" 
                                            value="ExamsController@view_exam,ExamsController@view_exam_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon8-popular2">View</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-12 my-2">
                                <div class="row shadow bg-white rounded-10 py-3 px-2 mx-0 h-100">
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="control-label text-primary">
                                            <i class="fad fa-shield-alt"></i>
                                            Study Material  
                                        </label>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon9" name="selectall" id="selectallcoupon9">
                                            <label class="custom-control-label fs-14 text-uppercase font-weight-900" for="selectallcoupon9">Select all Permissions</label>
                                            <script>
                                                $(document).ready(function(){
                                                    $("#selectallcoupon9").click(function(){
                                                        if(this.checked){
                                                            $('.selectallcoupon9').each(function(){
                                                                $(".selectallcoupon9").prop('checked', true);
                                                            })
                                                        }else{
                                                            $('.selectallcoupon9').each(function(){
                                                                $(".selectallcoupon9").prop('checked', false);
                                                            })
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>

                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Paper
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon9" id="selectallcoupon9-popular1" 
                                            value="FreePreparationToolController@add_question_paper_subjects" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon9-popular1">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon9" id="selectallcoupon9-popular1-edit" 
                                            value="FreePreparationToolController@edit_question_paper_subjects" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon9-popular1-edit">Edit</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon9" id="selectallcoupon9-popular1-delete" 
                                            value="FreePreparationToolController@delete_question_paper_subjects" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon9-popular1-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon9" id="selectallcoupon9-popular2" 
                                            value="FreePreparationToolController@view_question_paper_subjects,FreePreparationToolController@view_question_paper_subjects_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon9-popular2">View</label>
                                        </div>
                                        
                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Question Answer
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon9" id="selectallcoupon9-popular1-n" 
                                            value="QuestionAnswerController@add_question_answer" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon9-popular1-n">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon9" id="selectallcoupon9-popular1-n-edit" 
                                            value="QuestionAnswerController@edit_question_answer" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon9-popular1-n-edit">Edit</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon9" id="selectallcoupon9-popular1-n-delete" 
                                            value="QuestionAnswerController@delete_question_answer" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon9-popular1-n-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon9" id="selectallcoupon9-popular2-n" 
                                            value="QuestionAnswerController@view_question_answer,QuestionAnswerController@view_question_answer_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon9-popular2-n">View</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-12 my-2">
                                <div class="row shadow bg-white rounded-10 py-3 px-2 mx-0 h-100">
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="control-label text-primary">
                                            <i class="fad fa-shield-alt"></i>
                                            Testimonials  
                                        </label>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon10" name="selectall" id="selectallcoupon10">
                                            <label class="custom-control-label fs-14 text-uppercase font-weight-900" for="selectallcoupon10">Select all Permissions</label>
                                            <script>
                                                $(document).ready(function(){
                                                    $("#selectallcoupon10").click(function(){
                                                        if(this.checked){
                                                            $('.selectallcoupon10').each(function(){
                                                                $(".selectallcoupon10").prop('checked', true);
                                                            })
                                                        }else{
                                                            $('.selectallcoupon10').each(function(){
                                                                $(".selectallcoupon10").prop('checked', false);
                                                            })
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon10" id="selectallcoupon10-popular1" 
                                            value="TestimonialsController@add_testimonial" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon10-popular1">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon10" id="selectallcoupon10-popular1-edit" 
                                            value="TestimonialsController@edit_testimonial" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon10-popular1-edit">Edit</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon10" id="selectallcoupon10-popular1-delete" 
                                            value="TestimonialsController@delete_testimonial" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon10-popular1-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon10" id="selectallcoupon10-popular2" 
                                            value="TestimonialsController@view_testimonial,TestimonialsController@view_testimonial_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon10-popular2">View</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-12 my-2">
                                <div class="row shadow bg-white rounded-10 py-3 px-2 mx-0 h-100">
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="control-label text-primary">
                                            <i class="fad fa-shield-alt"></i>
                                            States & Cities  
                                        </label>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon11" name="selectall" id="selectallcoupon11">
                                            <label class="custom-control-label fs-14 text-uppercase font-weight-900" for="selectallcoupon11">Select all Permissions</label>
                                            <script>
                                                $(document).ready(function(){
                                                    $("#selectallcoupon11").click(function(){
                                                        if(this.checked){
                                                            $('.selectallcoupon11').each(function(){
                                                                $(".selectallcoupon11").prop('checked', true);
                                                            })
                                                        }else{
                                                            $('.selectallcoupon11').each(function(){
                                                                $(".selectallcoupon11").prop('checked', false);
                                                            })
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>

                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            States
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon11" id="selectallcoupon11-popular1-edit" 
                                            value="StatecityController@edit_state" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon11-popular1-edit">Edit States</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon11" id="selectallcoupon11-popular1-delete" 
                                            value="StatecityController@updatestatus" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon11-popular1-delete">Enable/Disable States</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon11" id="selectallcoupon11-popular1" 
                                            value="StatecityController@get_states,StatecityController@state_search" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon11-popular1">View States</label>
                                        </div>

                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Cities
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon11" id="selectallcoupon11-popular2-add" 
                                            value="StatecityController@add_city" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon11-popular2-add">Add Cities</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon11" id="selectallcoupon11-popular2-edit" 
                                            value="StatecityController@edit_city" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon11-popular2-edit">Edit Cities</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon11" id="selectallcoupon11-popular2-delete" 
                                            value="StatecityController@updatecitystatus" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon11-popular2-delete">Enable/Disable Cities</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon11" id="selectallcoupon11-popular2" 
                                            value="StatecityController@get_city,StatecityController@state_search,StatecityController@get_citydatatable" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon11-popular2">View Cities</label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12 my-2">
                                <div class="row shadow bg-white rounded-10 py-3 px-2 mx-0 h-100">
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="control-label text-primary">
                                            <i class="fad fa-shield-alt"></i>
                                            Career Counselling  
                                        </label>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon12" name="selectall" id="selectallcoupon12">
                                            <label class="custom-control-label fs-14 text-uppercase font-weight-900" for="selectallcoupon12">Select all Permissions</label>
                                            <script>
                                                $(document).ready(function(){
                                                    $("#selectallcoupon12").click(function(){
                                                        if(this.checked){
                                                            $('.selectallcoupon12').each(function(){
                                                                $(".selectallcoupon12").prop('checked', true);
                                                            })
                                                        }else{
                                                            $('.selectallcoupon12').each(function(){
                                                                $(".selectallcoupon12").prop('checked', false);
                                                            })
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>

                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Counsellings  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon12" id="selectallcoupon12-popular1" 
                                            value="CounsellingController@counselling" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon12-popular1">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon12" id="selectallcoupon12-popular1-edit" 
                                            value="CounsellingController@edit_counselling,CounsellingController@update_counselling" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon12-popular1-edit">Edit</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon12" id="selectallcoupon12-popular1-delete" 
                                            value="CounsellingController@delete_counselling" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon12-popular1-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon12" id="selectallcoupon12-popular2" 
                                            value="CounsellingController@view_counselling,CounsellingController@view_counselling_table" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon12-popular2">View</label>
                                        </div>
                                        
                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Testimonials  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon12" id="selectallcoupon12-popular3" 
                                            value="CounsellingTestimonialsController@add_counselling_testimonial" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon12-popular3">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon12" id="selectallcoupon12-popular3-edit" 
                                            value="CounsellingTestimonialsController@edit_counselling_testimonial" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon12-popular3-edit">Edit</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon12" id="selectallcoupon12-popular3-delete" 
                                            value="CounsellingTestimonialsController@delete_counselling_testimonial" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon12-popular3-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon12" id="selectallcoupon12-popular4" 
                                            value="CounsellingTestimonialsController@view_counselling_testimonial,CounsellingTestimonialsController@view_counselling_testimonial_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon12-popular4">View</label>
                                        </div>
                                        
                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            FAQs  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon12" id="selectallcoupon12-popular5" 
                                            value="CounsellingFaqController@counselling_faq" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon12-popular5">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon12" id="selectallcoupon12-popular5-edit" 
                                            value="CounsellingFaqController@edit_counselling_faq" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon12-popular5-edit">Edit</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon12" id="selectallcoupon12-popular5-delete" 
                                            value="CounsellingFaqController@delete_counselling_faq" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon12-popular5-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon12" id="selectallcoupon12-popular6" 
                                            value="CounsellingFaqController@view_counselling_faq,CounsellingFaqController@view_counselling_faq_table" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon12-popular6">View</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12 my-2">
                                <div class="row shadow bg-white rounded-10 py-3 px-2 mx-0 h-100">
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="control-label text-primary">
                                            <i class="fad fa-shield-alt"></i>
                                            Offers  
                                        </label>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon13" name="selectall" id="selectallcoupon13">
                                            <label class="custom-control-label fs-14 text-uppercase font-weight-900" for="selectallcoupon13">Select all Permissions</label>
                                            <script>
                                                $(document).ready(function(){
                                                    $("#selectallcoupon13").click(function(){
                                                        if(this.checked){
                                                            $('.selectallcoupon13').each(function(){
                                                                $(".selectallcoupon13").prop('checked', true);
                                                            })
                                                        }else{
                                                            $('.selectallcoupon13').each(function(){
                                                                $(".selectallcoupon13").prop('checked', false);
                                                            })
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon13" id="selectallcoupon13-popular1" 
                                            value="OffersController@addOffer" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon13-popular1">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon13" id="selectallcoupon13-popular1-edit" 
                                            value="OffersController@editoffer" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon13-popular1-edit">Edit</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon13" id="selectallcoupon13-popular1-delete" 
                                            value="OffersController@deleteoffer" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon13-popular1-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon13" id="selectallcoupon13-popular2" 
                                            value="OffersController@getOffers" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon13-popular2">View</label>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-12 my-2">
                                <div class="row shadow bg-white rounded-10 py-3 px-2 mx-0 h-100">
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="control-label text-primary">
                                            <i class="fad fa-shield-alt"></i>
                                            Student Details  
                                        </label>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon14" name="selectall" id="selectallcoupon14">
                                            <label class="custom-control-label fs-14 text-uppercase font-weight-900" for="selectallcoupon14">Select all Permissions</label>
                                            <script>
                                                $(document).ready(function(){
                                                    $("#selectallcoupon14").click(function(){
                                                        if(this.checked){
                                                            $('.selectallcoupon14').each(function(){
                                                                $(".selectallcoupon14").prop('checked', true);
                                                            })
                                                        }else{
                                                            $('.selectallcoupon14').each(function(){
                                                                $(".selectallcoupon14").prop('checked', false);
                                                            })
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon14" id="selectallcoupon14-popular1" 
                                            value="StudentController@view_students,StudentController@view_students_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon14-popular1">View Students</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon14" id="selectallcoupon14-popular1-edu" 
                                            value="StudentController@view_student_details" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon14-popular1-edu">View Students Education Details</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12 my-2">
                                <div class="row shadow bg-white rounded-10 py-3 px-2 mx-0 h-100">
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="control-label text-primary">
                                            <i class="fad fa-shield-alt"></i>
                                            Enterprise Details  
                                        </label>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon15" name="selectall" id="selectallcoupon15">
                                            <label class="custom-control-label fs-14 text-uppercase font-weight-900" for="selectallcoupon15">Select all Permissions</label>
                                            <script>
                                                $(document).ready(function(){
                                                    $("#selectallcoupon15").click(function(){
                                                        if(this.checked){
                                                            $('.selectallcoupon15').each(function(){
                                                                $(".selectallcoupon15").prop('checked', true);
                                                            })
                                                        }else{
                                                            $('.selectallcoupon15').each(function(){
                                                                $(".selectallcoupon15").prop('checked', false);
                                                            })
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>

                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Details  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon15" id="selectallcoupon15-popular1-del" 
                                            value="EnterpriseController@delete_enterprise" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon15-popular1-del">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon15" id="selectallcoupon15-popular1" 
                                            value="EnterpriseController@view_enterprise,EnterpriseController@view_enterprise_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon15-popular1">View</label>
                                        </div>
                                        
                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Plans  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon15" id="selectallcoupon15-popular3" 
                                            value="PlanController@plan" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon15-popular3">Add</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon15" id="selectallcoupon15-popular3-edit" 
                                            value="PlanController@edit_plan,PlanController@update_plan" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon15-popular3-edit">Edit</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon15" id="selectallcoupon15-popular4-delete" 
                                            value="PlanController@delete_plan" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon15-popular4-delete">Enable/Disable</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon15" id="selectallcoupon15-popular4" 
                                            value="PlanController@view_plan,PlanController@view_plan_table" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon15-popular4">View</label>
                                        </div>
                                        
                                        <label class="control-label text-primary mt-3">
                                            <i class="fad fa-shield-alt"></i>
                                            Plan Requests  
                                        </label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon15" id="selectallcoupon15-popular5" 
                                            value="PlanController@view_plan_request,PlanController@view_plan_request_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon15-popular5">View</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-12 my-2">
                                <div class="row shadow bg-white rounded-10 py-3 px-2 mx-0 h-100">
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="control-label text-primary">
                                            <i class="fad fa-shield-alt"></i>
                                            Generals  
                                        </label>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon16" name="selectall" id="selectallcoupon16">
                                            <label class="custom-control-label fs-14 text-uppercase font-weight-900" for="selectallcoupon16">Select all Permissions</label>
                                            <script>
                                                $(document).ready(function(){
                                                    $("#selectallcoupon16").click(function(){
                                                        if(this.checked){
                                                            $('.selectallcoupon16').each(function(){
                                                                $(".selectallcoupon16").prop('checked', true);
                                                            })
                                                        }else{
                                                            $('.selectallcoupon16').each(function(){
                                                                $(".selectallcoupon16").prop('checked', false);
                                                            })
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon16" id="selectallcoupon16-popular4" 
                                            value="GeneralController@view_contact_us,GeneralController@view_contact_us_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon16-popular4">Contact Us</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon16" id="selectallcoupon16-popular5" 
                                            value="GeneralController@view_requestcallback,GeneralController@view_requestcallback_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon16-popular5">Callback Request</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon16" id="selectallcoupon16-popular6" 
                                            value="GeneralController@view_requestcallback_purchase,GeneralController@view_requestcallback_purchase_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon16-popular6">View Purchase Lead</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon16" id="selectallcoupon16-popular7" 
                                            value="GeneralController@view_search_lead,GeneralController@view_search_lead_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon16-popular7">View Search Lead</label>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            
                            <div class="col-lg-4 col-md-6 col-12 my-2">
                                <div class="row shadow bg-white rounded-10 py-3 px-2 mx-0 h-100">
                                    <div class="form-group col-md-12 mb-0">
                                        <label class="control-label text-primary">
                                            <i class="fad fa-shield-alt"></i>
                                            Trending Today Direct    
                                        </label>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon4direct" name="selectall" id="selectallcoupon4direct">
                                            <label class="custom-control-label fs-14 text-uppercase font-weight-900" for="selectallcoupon4direct">Select all Permissions</label>
                                            <script>
                                                $(document).ready(function(){
                                                    $("#selectallcoupon4direct").click(function(){
                                                        if(this.checked){
                                                            $('.selectallcoupon4direct').each(function(){
                                                                $(".selectallcoupon4direct").prop('checked', true);
                                                            })
                                                        }else{
                                                            $('.selectallcoupon4direct').each(function(){
                                                                $(".selectallcoupon4direct").prop('checked', false);
                                                            })
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon4direct" id="selectallcoupon4direct-popular1" 
                                            value="TrendingTodayDirectController@add_trending_today_direct" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon4direct-popular1">Add</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon4direct" id="selectallcoupon4direct-popular1-edit" 
                                            value="TrendingTodayDirectController@edit_trending_today_direct" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon4direct-popular1-edit">Edit</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon4direct" id="selectallcoupon4direct-popular1-delete" 
                                            value="TrendingTodayDirectController@delete_trending_today_direct" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon4direct-popular1-delete">Enable/Disable</label>
                                        </div>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input selectallcoupon4direct" id="selectallcoupon4direct-popular2" 
                                            value="TrendingTodayDirectController@view_trending_today_direct,TrendingTodayDirectController@view_trending_today_direct_dt" name="permissions[]">
                                            <label class="custom-control-label fs-14 font-weight-normal" for="selectallcoupon4direct-popular2">View</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                    
                    <div class="col-12 text-right mt-4 mb-2">
                        <button class="btn btn-sm btn-success text-uppercase"><i class="far fa-check-circle"></i>&nbsp;Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection