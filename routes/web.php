<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

info(request()->ip());
info(url()->current());
info(request()->all());

// webinar
Route::any('/webinar', 'Website\WebinarController@all_webinar');
Route::any('/webinar/{webinar_name_slug}', 'Website\WebinarController@webinar');

Route::get('/about_us', function () {
    return redirect('aboutus');
});
Route::get('/website_mail', function () {
    return view('mails/website_mail');
});

Route::any('/download_invoice/{id}', 'Website\StudentProfileController@download_invoice');

Route::get('/privacy_policy', function () {
    return redirect('privacypolicy');
});

Route::get('/terms_condition', function () {
    return redirect('terms-condition');
});

Route::get('/thank_you', function () {
    return redirect('thankyou');
});

Route::any('/website_mail2', 'DashboardController@website_mail2');
Route::any('/website_mail3', 'DashboardController@website_mail3');
Route::any('/aboutus', 'Website\IndexController@about_us');
Route::any('/careers', 'Website\IndexController@careers');
Route::any('/contactus', 'Website\IndexController@contact_us');
Route::any('/contact_us', 'Website\IndexController@contact_us');
Route::any('/disclaimer', 'Website\IndexController@disclaimer');
Route::any('/faq', 'Website\IndexController@faq');
Route::any('/community-guidelines', 'Website\IndexController@Community_Guidelines');
Route::any('/terms-condition', 'Website\IndexController@terms_condition');
Route::any('/privacypolicy', 'Website\IndexController@privacy_policy');
Route::any('/cookies', 'Website\IndexController@cookies');
Route::any('/thankyou', 'Website\IndexController@thank_you');
Route::any('/thankyou/{id}', 'Website\IndexController@thank_you_2');
Route::any('/requestcallback', 'Website\IndexController@requestcallback');

Route::any('/team', 'Website\IndexController@authors');


Route::middleware('slug-generate')->group(

    function() {

        // search lead
        Route::any('/search_lead', 'Website\CoachingSearchController@search_lead');

        Route::get('/home', function () {
            return redirect('coaching_admin');
        });

        Route::prefix('coaching_admin')->group( function() {
            // Auth::routes();
            Auth::routes([
                'register' => false, // Register Routes...
                'reset' => false, // Reset Password Routes...
                'verify' => false, // Email Verification Routes...
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | Dashboard Manager
        |--------------------------------------------------------------------------
        */
        Route::any('/coaching_admin', 'DashboardController@home')->middleware('auth');
        
        /*
        |--------------------------------------------------------------------------
        | Admin profile and change password
        |--------------------------------------------------------------------------
        */
        Route::any('/coaching_admin/admin_profile', 'AdminController@admin_profile')->middleware('auth');
        
        /*
        |--------------------------------------------------------------------------
        | Admin routes
        |--------------------------------------------------------------------------
        */
        Route::prefix('coaching_admin')->middleware(['auth', 'check-permissions'])->group(
            function() {

                Route::any('change_password', 'AdminController@change_password')->middleware('auth');

                /*
                |--------------------------------------------------------------------------
                | Streams Manager
                |--------------------------------------------------------------------------
                */
                Route::any('add_stream', 'StreamsController@add_stream')->middleware('auth');
                Route::any('edit_stream', 'StreamsController@edit_stream')->middleware('auth');
                Route::any('delete_stream', 'StreamsController@delete_stream')->middleware('auth');
                Route::any('view_stream', 'StreamsController@view_stream')->middleware('auth');
                Route::any('view_stream_dt', 'StreamsController@view_stream_dt')->middleware('auth');
                
                /*
                |--------------------------------------------------------------------------
                | Courses Manager
                |--------------------------------------------------------------------------
                */
                Route::any('add_course', 'CoursesController@add_course')->middleware('auth');
                Route::any('edit_course/{id}', 'CoursesController@edit_course')->middleware('auth');
                Route::any('delete_course', 'CoursesController@delete_course')->middleware('auth');
                Route::any('view_course', 'CoursesController@view_course')->middleware('auth');
                Route::any('view_course_dt', 'CoursesController@view_course_dt')->middleware('auth');
                
                /*
                |--------------------------------------------------------------------------
                | Facility Manager
                |--------------------------------------------------------------------------
                */
                Route::any('add_facility', 'FacilityController@add_facility')->middleware('auth');
                Route::any('edit_facility', 'FacilityController@edit_facility')->middleware('auth');
                Route::any('delete_facility', 'FacilityController@delete_facility')->middleware('auth');
                Route::any('view_facility', 'FacilityController@view_facility')->middleware('auth');
                Route::any('view_facility_dt', 'FacilityController@view_facility_dt')->middleware('auth');
                
                /*
                |--------------------------------------------------------------------------
                | Blogs Manager
                |--------------------------------------------------------------------------
                */
                Route::any('add_blog', 'BlogsController@add_blog')->middleware('auth');
                Route::any('edit_blog', 'BlogsController@edit_blog')->middleware('auth');
                Route::any('delete_blog', 'BlogsController@delete_blog')->middleware('auth');
                Route::any('view_blog', 'BlogsController@view_blog')->middleware('auth');
                Route::any('view_blog_dt', 'BlogsController@view_blog_dt')->middleware('auth');
                Route::any('tags', 'BlogsController@tags')->middleware('auth');
                Route::any('view_blog_comments', 'BlogsController@view_blog_comments')->middleware('auth');
                Route::any('view_blog_comments_dt', 'BlogsController@view_blog_comments_dt')->middleware('auth');
                Route::any('delete_blog_comments', 'BlogsController@delete_blog_comments')->middleware('auth');
                Route::any('ckeditor_image', 'BlogsController@ckeditor_image')->middleware('auth');
                
                /*
                |--------------------------------------------------------------------------
                | Exams Manager
                |--------------------------------------------------------------------------
                */
                Route::any('add_exam', 'ExamsController@add_exam')->middleware('auth');
                Route::any('edit_exam', 'ExamsController@edit_exam')->middleware('auth');
                Route::any('delete_exam', 'ExamsController@delete_exam')->middleware('auth');
                Route::any('view_exam', 'ExamsController@view_exam')->middleware('auth');
                Route::any('view_exam_dt', 'ExamsController@view_exam_dt')->middleware('auth');
                Route::any('stream_course', 'ExamsController@stream_course')->middleware('auth');
                
                /*
                |--------------------------------------------------------------------------
                | Testimonials Manager
                |--------------------------------------------------------------------------
                */
                Route::any('add_testimonial', 'TestimonialsController@add_testimonial')->middleware('auth');
                Route::any('edit_testimonial', 'TestimonialsController@edit_testimonial')->middleware('auth');
                Route::any('delete_testimonial', 'TestimonialsController@delete_testimonial')->middleware('auth');
                Route::any('view_testimonial', 'TestimonialsController@view_testimonial')->middleware('auth');
                Route::any('view_testimonial_dt', 'TestimonialsController@view_testimonial_dt')->middleware('auth');
                Route::any('testimonial/cities', 'TestimonialsController@cities')->middleware('auth');
                Route::any('testimonial/states', 'TestimonialsController@states')->middleware('auth');
                
                /*
                |--------------------------------------------------------------------------
                | QuestionPaper Manager
                |--------------------------------------------------------------------------
                */
                Route::any('add_question_paper', 'QuestionPaperController@add_question_paper')->middleware('auth');
                Route::any('edit_question_paper', 'QuestionPaperController@edit_question_paper')->middleware('auth');
                Route::any('delete_question_paper', 'QuestionPaperController@delete_question_paper')->middleware('auth');
                Route::any('view_question_paper', 'QuestionPaperController@view_question_paper')->middleware('auth');
                Route::any('view_question_paper_dt', 'QuestionPaperController@view_question_paper_dt')->middleware('auth');
                
                /*
                |--------------------------------------------------------------------------
                | StateCity Manager
                |--------------------------------------------------------------------------
                */
                Route::any('get_states', 'StatecityController@get_states')->middleware('auth');
                Route::any('edit_state', 'StatecityController@edit_state')->middleware('auth');
                Route::any('updatestatus/{id}/{status}', 'StatecityController@updatestatus')->middleware('auth');
                Route::any('state_search', 'StatecityController@state_search')->middleware('auth');
                Route::any('/get_city', 'StatecityController@get_city')->middleware('auth');
                Route::any('/add_city', 'StatecityController@add_city')->middleware('auth');
                Route::any('/edit_city/{id}', 'StatecityController@edit_city')->middleware('auth');
                Route::any('/get_citydatatable', 'StatecityController@get_citydatatable')->middleware('auth');
                Route::any('/updatecitystatus/{id}/{status}', 'StatecityController@updatecitystatus')->middleware('auth');
                
                /*
                |--------------------------------------------------------------------------
                | College Manager
                |--------------------------------------------------------------------------
                */
                Route::any('add_college', 'CollegeController@add_college')->middleware('auth');
                Route::any('get_course', 'CollegeController@get_course')->middleware('auth');
                Route::any('view_college', 'CollegeController@view_college')->middleware('auth');
                Route::any('view_college_datatable', 'CollegeController@view_college_datatable')->middleware('auth');
                Route::any('edit_college/{id}', 'CollegeController@edit_college')->middleware('auth');
                Route::any('is_college_featured', 'CollegeController@is_college_featured')->middleware('auth');
                Route::any('updatecolgstatus/{id}/{status}', 'CollegeController@updatecolgstatus')->middleware('auth');
                Route::any('add_colgimages/{id}', 'CollegeController@add_colgimages')->middleware('auth');
                Route::any('view_colgimage/{id}', 'CollegeController@view_colgimage')->middleware('auth');
                Route::any('delete_colgimage/{id}/{cid}', 'CollegeController@delete_colgimage')->middleware('auth');
                Route::any('add_colgvideo/{id}', 'CollegeController@add_colgvideo')->middleware('auth');
                Route::any('view_colgvideo/{id}', 'CollegeController@view_colgvideo')->middleware('auth');
                Route::any('delete_colgvideo/{id}/{cid}', 'CollegeController@delete_colgvideo')->middleware('auth');
                Route::any('delete_facility/{cid}/{id}', 'CollegeController@delete_facility')->middleware('auth');
                Route::any('college_category', 'CollegeController@college_category')->middleware('auth');
                                
                /*
                |--------------------------------------------------------------------------
                | College Category Manager
                |--------------------------------------------------------------------------
                */
                Route::any('add_college_category', 'CollegeCategoryController@add_college_category')->middleware('auth');
                Route::any('edit_college_category', 'CollegeCategoryController@edit_college_category')->middleware('auth');
                Route::any('delete_college_category', 'CollegeCategoryController@delete_college_category')->middleware('auth');
                Route::any('view_college_category', 'CollegeCategoryController@view_college_category')->middleware('auth');
                Route::any('view_college_category_dt', 'CollegeCategoryController@view_college_category_dt')->middleware('auth');

                /*
                |--------------------------------------------------------------------------
                | College Valuable Manager
                |--------------------------------------------------------------------------
                */
                Route::any('add_valuable', 'CollegeController@add_valuable')->middleware('auth');
                Route::any('view_college_valuable', 'CollegeController@view_college_valuable')->middleware('auth');
                Route::any('view_college_valuable_dt', 'CollegeController@view_college_valuable_dt')->middleware('auth');
                Route::any('delete_college_valuable', 'CollegeController@delete_college_valuable')->middleware('auth');
                Route::any('edit_college_valuable', 'CollegeController@edit_college_valuable')->middleware('auth');
                
                /*
                |--------------------------------------------------------------------------
                | Free Preparation Tool Subjects Manager
                |--------------------------------------------------------------------------
                */
                Route::any('view_question_paper_subjects', 'FreePreparationToolController@view_question_paper_subjects')->middleware('auth');
                Route::any('view_question_paper_subjects_dt', 'FreePreparationToolController@view_question_paper_subjects_dt')->middleware('auth');
                Route::any('add_question_paper_subjects', 'FreePreparationToolController@add_question_paper_subjects')->middleware('auth');
                Route::any('edit_question_paper_subjects', 'FreePreparationToolController@edit_question_paper_subjects')->middleware('auth');
                Route::any('delete_question_paper_subjects', 'FreePreparationToolController@delete_question_paper_subjects')->middleware('auth');
                
                /*
                |--------------------------------------------------------------------------
                | Question Answer Manager
                |--------------------------------------------------------------------------
                */
                Route::any('view_question_answer', 'QuestionAnswerController@view_question_answer')->middleware('auth');
                Route::any('view_question_answer_dt', 'QuestionAnswerController@view_question_answer_dt')->middleware('auth');
                Route::any('add_question_answer', 'QuestionAnswerController@add_question_answer')->middleware('auth');
                Route::any('edit_question_answer', 'QuestionAnswerController@edit_question_answer')->middleware('auth');
                Route::any('delete_question_answer', 'QuestionAnswerController@delete_question_answer')->middleware('auth');
                
                /*
                |--------------------------------------------------------------------------
                | Coaching Manager
                |--------------------------------------------------------------------------
                */
                Route::any('view_coaching', 'CoachingController@view_coaching')->middleware('auth');
                Route::any('view_coaching_dt', 'CoachingController@view_coaching_dt')->middleware('auth');
                Route::any('add_coaching', 'CoachingController@add_coaching')->middleware('auth');
                Route::any('edit_coaching', 'CoachingController@edit_coaching')->middleware('auth');
                Route::any('delete_coaching', 'CoachingController@delete_coaching')->middleware('auth');
                Route::any('become_prime_member', 'CoachingController@become_prime_member');

                # coaching courses
                Route::any('add_courses', 'CoachingController@add_courses')->middleware('auth');
                Route::any('all_courses', 'CoachingController@all_courses')->middleware('auth');
                Route::any('select_course', 'CoachingController@select_course')->middleware('auth');
                Route::any('deselect_course', 'CoachingController@deselect_course')->middleware('auth');
                Route::any('courses', 'CoachingController@courses')->middleware('auth');
                Route::any('view_coaching_courses', 'CoachingController@view_coaching_courses')->middleware('auth');
                Route::any('view_coaching_courses_dt', 'CoachingController@view_coaching_courses_dt')->middleware('auth');
                Route::any('delete_coaching_courses', 'CoachingController@delete_coaching_courses')->middleware('auth');
                
                # coaching courses_detail
                Route::any('add_courses_detail', 'CoachingController@add_courses_detail')->middleware('auth');
                Route::any('view_coaching_courses_detail', 'CoachingController@view_coaching_courses_detail')->middleware('auth');
                Route::any('view_coaching_courses_detail_dt', 'CoachingController@view_coaching_courses_detail_dt')->middleware('auth');
                Route::any('delete_coaching_courses_detail', 'CoachingController@delete_coaching_courses_detail')->middleware('auth');
                Route::any('edit_coaching_courses_detail', 'CoachingController@edit_coaching_courses_detail')->middleware('auth');

                # coaching faculty
                Route::any('add_faculty', 'CoachingController@add_faculty')->middleware('auth');
                Route::any('view_coaching_faculty', 'CoachingController@view_coaching_faculty')->middleware('auth');
                Route::any('view_coaching_faculty_dt', 'CoachingController@view_coaching_faculty_dt')->middleware('auth');
                Route::any('delete_coaching_faculty', 'CoachingController@delete_coaching_faculty')->middleware('auth');
                Route::any('edit_coaching_faculty', 'CoachingController@edit_coaching_faculty')->middleware('auth');

                # coaching results
                Route::any('add_results', 'CoachingController@add_results')->middleware('auth');
                Route::any('view_coaching_results', 'CoachingController@view_coaching_results')->middleware('auth');
                Route::any('view_coaching_results_dt', 'CoachingController@view_coaching_results_dt')->middleware('auth');
                Route::any('delete_coaching_results', 'CoachingController@delete_coaching_results')->middleware('auth');
                Route::any('edit_coaching_results', 'CoachingController@edit_coaching_results')->middleware('auth');
                
                # coaching photos
                Route::any('add_photos', 'CoachingController@add_photos')->middleware('auth');
                Route::any('view_coaching_photos', 'CoachingController@view_coaching_photos')->middleware('auth');
                Route::any('view_coaching_photos_dt', 'CoachingController@view_coaching_photos_dt')->middleware('auth');
                Route::any('delete_coaching_photos', 'CoachingController@delete_coaching_photos')->middleware('auth');
                Route::any('edit_coaching_photos', 'CoachingController@edit_coaching_photos')->middleware('auth');

                # coaching videos
                Route::any('add_videos', 'CoachingController@add_videos')->middleware('auth');
                Route::any('view_coaching_videos', 'CoachingController@view_coaching_videos')->middleware('auth');
                Route::any('view_coaching_videos_dt', 'CoachingController@view_coaching_videos_dt')->middleware('auth');
                Route::any('delete_coaching_videos', 'CoachingController@delete_coaching_videos')->middleware('auth');
                Route::any('edit_coaching_videos', 'CoachingController@edit_coaching_videos')->middleware('auth');

                # coaching facility
                Route::any('add_facilities', 'CoachingController@add_facilities')->middleware('auth');
                Route::any('all_facilities', 'CoachingController@all_facilities')->middleware('auth');
                Route::any('select_facility', 'CoachingController@select_facility')->middleware('auth');
                Route::any('deselect_facility', 'CoachingController@deselect_facility')->middleware('auth');
                Route::any('view_coaching_facility', 'CoachingController@view_coaching_facility')->middleware('auth');
                Route::any('view_coaching_facility_dt', 'CoachingController@view_coaching_facility_dt')->middleware('auth');
                Route::any('delete_coaching_facility', 'CoachingController@delete_coaching_facility')->middleware('auth');
                
                # coaching centers
                Route::any('add_centers', 'CoachingController@add_centers')->middleware('auth');
                Route::any('all_centers', 'CoachingController@all_centers')->middleware('auth');
                Route::any('select_center', 'CoachingController@select_center')->middleware('auth');
                Route::any('deselect_center', 'CoachingController@deselect_center')->middleware('auth');
                Route::any('centers', 'CoachingController@centers')->middleware('auth');
                Route::any('view_coaching_centers', 'CoachingController@view_coaching_centers')->middleware('auth');
                Route::any('view_coaching_centers_dt', 'CoachingController@view_coaching_centers_dt')->middleware('auth');
                Route::any('delete_coaching_centers', 'CoachingController@delete_coaching_centers')->middleware('auth');
                
                # coaching branch
                Route::any('add_branch', 'CoachingController@add_branch')->middleware('auth');
                Route::any('view_coaching_centers_branches', 'CoachingController@view_coaching_centers_branches')->middleware('auth');
                Route::any('view_coaching_centers_branches_dt', 'CoachingController@view_coaching_centers_branches_dt')->middleware('auth');
                Route::any('delete_coaching_centers_branches', 'CoachingController@delete_coaching_centers_branches')->middleware('auth');
                Route::any('edit_coaching_centers_branches', 'CoachingController@edit_coaching_centers_branches')->middleware('auth');
                
                # coaching testimonials
                Route::any('add_testimonials', 'CoachingController@add_testimonials')->middleware('auth');
                Route::any('view_coaching_testimonials', 'CoachingController@view_coaching_testimonials')->middleware('auth');
                Route::any('view_coaching_testimonials_dt', 'CoachingController@view_coaching_testimonials_dt')->middleware('auth');
                Route::any('delete_coaching_testimonials', 'CoachingController@delete_coaching_testimonials')->middleware('auth');
                Route::any('edit_coaching_testimonials', 'CoachingController@edit_coaching_testimonials')->middleware('auth');
                
                # coaching reviews
                Route::any('view_coaching_reviews', 'CoachingController@view_coaching_reviews')->middleware('auth');
                Route::any('view_coaching_reviews_dt', 'CoachingController@view_coaching_reviews_dt')->middleware('auth');
                Route::any('delete_coaching_reviews', 'CoachingController@delete_coaching_reviews')->middleware('auth');
                
                Route::any('is_featured', 'CoachingController@is_featured')->middleware('auth');
                Route::any('is_featured_course', 'CoachingController@is_featured_course')->middleware('auth');

                /*
                |--------------------------------------------------------------------------
                | Trending Today Manager
                |--------------------------------------------------------------------------
                */
                Route::any('add_trending_today', 'TrendingTodayController@add_trending_today')->middleware('auth');
                Route::any('edit_trending_today', 'TrendingTodayController@edit_trending_today')->middleware('auth');
                Route::any('delete_trending_today', 'TrendingTodayController@delete_trending_today')->middleware('auth');
                Route::any('view_trending_today', 'TrendingTodayController@view_trending_today')->middleware('auth');
                Route::any('view_trending_today_dt', 'TrendingTodayController@view_trending_today_dt')->middleware('auth');

                /*
                |--------------------------------------------------------------------------
                | Webinar Manager
                |--------------------------------------------------------------------------
                */
                Route::any('add_webinar', 'WebinarController@add_webinar')->middleware('auth');
                Route::any('edit_webinar', 'WebinarController@edit_webinar')->middleware('auth');
                Route::any('delete_webinar', 'WebinarController@delete_webinar')->middleware('auth');
                Route::any('view_webinar', 'WebinarController@view_webinar')->middleware('auth');
                Route::any('view_webinar_dt', 'WebinarController@view_webinar_dt')->middleware('auth');

                /*
                |--------------------------------------------------------------------------
                | Trending Today Direct Manager
                |--------------------------------------------------------------------------
                */
                Route::any('add_trending_today_direct', 'TrendingTodayDirectController@add_trending_today_direct')->middleware('auth');
                Route::any('edit_trending_today_direct', 'TrendingTodayDirectController@edit_trending_today_direct')->middleware('auth');
                Route::any('delete_trending_today_direct', 'TrendingTodayDirectController@delete_trending_today_direct')->middleware('auth');
                Route::any('view_trending_today_direct', 'TrendingTodayDirectController@view_trending_today_direct')->middleware('auth');
                Route::any('view_trending_today_direct_dt', 'TrendingTodayDirectController@view_trending_today_direct_dt')->middleware('auth');
                
                /*
                |--------------------------------------------------------------------------
                | Blogs Category Manager
                |--------------------------------------------------------------------------
                */
                Route::any('add_blog_category', 'BlogsCategoryController@add_blog_category')->middleware('auth');
                Route::any('edit_blog_category', 'BlogsCategoryController@edit_blog_category')->middleware('auth');
                Route::any('delete_blog_category', 'BlogsCategoryController@delete_blog_category')->middleware('auth');
                Route::any('view_blog_category', 'BlogsCategoryController@view_blog_category')->middleware('auth');
                Route::any('view_blog_category_dt', 'BlogsCategoryController@view_blog_category_dt')->middleware('auth');

                /*
                |--------------------------------------------------------------------------
                | Student Questions Answers Manager
                |--------------------------------------------------------------------------
                */
                Route::any('view_student_questions', 'StudentQuestionsAnswersController@view_student_questions')->middleware('auth');
                Route::any('view_student_questions_dt','StudentQuestionsAnswersController@view_student_questions_dt')->middleware('auth');
                Route::any('delete_student_questions', 'StudentQuestionsAnswersController@delete_student_questions')->middleware('auth');
                
                Route::any('view_student_answers', 'StudentQuestionsAnswersController@view_student_answers')->middleware('auth');
                Route::any('view_student_answers_dt','StudentQuestionsAnswersController@view_student_answers_dt')->middleware('auth');
                Route::any('delete_student_answers', 'StudentQuestionsAnswersController@delete_student_answers')->middleware('auth');
                
                /*
                |--------------------------------------------------------------------------
                | Advertisement Manager
                |--------------------------------------------------------------------------
                */
                Route::any('/advertisement', 'AdvertisementController@advertisement')->middleware('auth');
                Route::any('/add_advertisement', 'AdvertisementController@add_advertisement')->middleware('auth');
                Route::any('/edit_advertisement/{id}', 'AdvertisementController@edit_advertisement')->middleware('auth');
                Route::any('/update_advertisement/{id}', 'AdvertisementController@update_advertisement')->middleware('auth');
                Route::any('/view_advertisement', 'AdvertisementController@view_advertisement')->middleware('auth');
                Route::any('/view_advertisement_table', 'AdvertisementController@view_advertisement_table')->middleware('auth');
                Route::any('/delete_advertisement/{id}', 'AdvertisementController@delete_advertisement')->middleware('auth');
                
                /*
                |--------------------------------------------------------------------------
                | Counselling Manager
                |--------------------------------------------------------------------------
                */
                Route::any('/counselling', 'CounsellingController@counselling')->middleware('auth');
                Route::any('/add_counselling', 'CounsellingController@add_counselling')->middleware('auth');
                Route::any('/edit_counselling/{id}', 'CounsellingController@edit_counselling')->middleware('auth');
                Route::any('/update_counselling/{id}', 'CounsellingController@update_counselling')->middleware('auth');
                Route::any('/view_counselling', 'CounsellingController@view_counselling')->middleware('auth');
                Route::any('/view_counselling_table', 'CounsellingController@view_counselling_table')->middleware('auth');
                Route::any('/delete_counselling/{id}', 'CounsellingController@delete_counselling')->middleware('auth');
            
                /*
                |--------------------------------------------------------------------------
                | CounsellingTestimonials Manager
                |--------------------------------------------------------------------------
                */
                Route::any('add_counselling_testimonial', 'CounsellingTestimonialsController@add_counselling_testimonial')->middleware('auth');
                Route::any('edit_counselling_testimonial', 'CounsellingTestimonialsController@edit_counselling_testimonial')->middleware('auth');
                Route::any('delete_counselling_testimonial', 'CounsellingTestimonialsController@delete_counselling_testimonial')->middleware('auth');
                Route::any('view_counselling_testimonial', 'CounsellingTestimonialsController@view_counselling_testimonial')->middleware('auth');
                Route::any('view_counselling_testimonial_dt', 'CounsellingTestimonialsController@view_counselling_testimonial_dt')->middleware('auth');
                Route::any('cities', 'CounsellingTestimonialsController@cities')->middleware('auth');
                Route::any('states', 'CounsellingTestimonialsController@states')->middleware('auth');
                
                /*
                |--------------------------------------------------------------------------
                | Counselling Faq Manager
                |--------------------------------------------------------------------------
                */
                Route::any('/counselling_faq', 'CounsellingFaqController@counselling_faq')->middleware('auth');
                Route::any('/add_counselling_faq', 'CounsellingFaqController@add_counselling_faq')->middleware('auth');
                Route::any('/edit_counselling_faq/{id}', 'CounsellingFaqController@edit_counselling_faq')->middleware('auth');
                Route::any('/update_counselling_faq/{id}', 'CounsellingFaqController@update_counselling_faq')->middleware('auth');
                Route::any('/view_counselling_faq', 'CounsellingFaqController@view_counselling_faq')->middleware('auth');
                Route::any('/view_counselling_faq_table', 'CounsellingFaqController@view_counselling_faq_table')->middleware('auth');
                Route::any('/delete_counselling_faq/{id}', 'CounsellingFaqController@delete_counselling_faq')->middleware('auth');
            
                /*
                |--------------------------------------------------------------------------
                | Enterprise Category Manager
                |--------------------------------------------------------------------------
                */
                Route::any('delete_enterprise', 'EnterpriseController@delete_enterprise')->middleware('auth');
                Route::any('view_enterprise', 'EnterpriseController@view_enterprise')->middleware('auth');
                Route::any('view_enterprise_dt', 'EnterpriseController@view_enterprise_dt')->middleware('auth');

                 /*
                |--------------------------------------------------------------------------
                | General Manager
                |--------------------------------------------------------------------------
                */
                Route::any('view_contact_us', 'GeneralController@view_contact_us')->middleware('auth');
                Route::any('view_contact_us_dt', 'GeneralController@view_contact_us_dt')->middleware('auth');
                Route::any('edit_contact_us', 'GeneralController@edit_contact_us')->middleware('auth');
                Route::any('view_requestcallback', 'GeneralController@view_requestcallback')->middleware('auth');
                Route::any('view_requestcallback_dt', 'GeneralController@view_requestcallback_dt')->middleware('auth');

                Route::any('contact_mail', 'GeneralController@contact_mail')->middleware('auth');
                Route::any('reqcallback_mail', 'GeneralController@reqcallback_mail')->middleware('auth');

                Route::any('view_requestcallback_purchase', 'GeneralController@view_requestcallback_purchase')->middleware('auth');
                Route::any('view_requestcallback_purchase_dt', 'GeneralController@view_requestcallback_purchase_dt')->middleware('auth');

                
                Route::any('view_search_lead', 'GeneralController@view_search_lead')->middleware('auth');
                Route::any('view_search_lead_dt', 'GeneralController@view_search_lead_dt')->middleware('auth');

                Route::any('view_student_details/{user_id}', 'StudentController@view_student_details')->middleware('auth');
                

                /*
                |--------------------------------------------------------------------------
                | Student Manager
                |--------------------------------------------------------------------------
                */
                Route::any('view_students', 'StudentController@view_students')->middleware('auth');
                Route::any('view_students_dt', 'StudentController@view_students_dt')->middleware('auth');
                Route::any('block_student/{id}', 'StudentController@block_student')->middleware('auth');
        
                /*
                |--------------------------------------------------------------------------
                | plan Manager
                |--------------------------------------------------------------------------
                */
                Route::any('/plan', 'PlanController@plan')->middleware('auth');
                Route::any('/add_plan', 'PlanController@add_plan')->middleware('auth');
                Route::any('/edit_plan/{id}', 'PlanController@edit_plan')->middleware('auth');
                Route::any('/update_plan/{id}', 'PlanController@update_plan')->middleware('auth');
                Route::any('/view_plan', 'PlanController@view_plan')->middleware('auth');
                Route::any('/view_plan_table', 'PlanController@view_plan_table')->middleware('auth');
                Route::any('/delete_plan/{id}', 'PlanController@delete_plan')->middleware('auth');
                            
                /*
                |--------------------------------------------------------------------------
                | Order Manager
                |--------------------------------------------------------------------------
                */
                Route::any('view_orders', 'OrderController@view_orders')->middleware('auth');
                Route::any('view_orders_dt', 'OrderController@view_orders_dt')->middleware('auth');
                
                /*
                |--------------------------------------------------------------------------
                | Plan Manager
                |--------------------------------------------------------------------------
                */
                Route::any('view_plan_request', 'PlanController@view_plan_request')->middleware('auth');
                Route::any('view_plan_request_dt', 'PlanController@view_plan_request_dt')->middleware('auth');
                        
                // Sub Admin Manager //
                Route::any('/view_sub_admin', 'SubAdminController@view_sub_admin');
                Route::any('/view_sub_admin_dt', 'SubAdminController@view_sub_admin_dt');
                Route::any('/add_sub_admin', 'SubAdminController@add_sub_admin');
                Route::any('/edit_sub_admin/{id}', 'SubAdminController@edit_sub_admin');
                Route::any('/delete_sub_admin/{id}', 'SubAdminController@delete_sub_admin');
                Route::any('/view_permissions/{id}', 'SubAdminController@view_permissions');

                /*
                |--------------------------------------------------------------------------
                | Counselling Order Manager
                |--------------------------------------------------------------------------
                */
                Route::any('view_orders_counselling', 'OrderController@view_orders_counselling')->middleware('auth');
                Route::any('view_orders_counselling_dt', 'OrderController@view_orders_counselling_dt')->middleware('auth');
                
            }
        );
        
        /*
        |--------------------------------------------------------------------------
        | News routes
        |--------------------------------------------------------------------------
        */
        Route::any('/news-and-articles', 'Website\TrendingTodayController@all_news');
        
        //offers//
        Route::any('main-admin/addoffers', 'OffersController@addOffer')->middleware(['auth', 'check-permissions']);
        Route::any('main-admin/getOffers', 'OffersController@getOffers')->middleware(['auth', 'check-permissions']);
        Route::any('main-admin/popularoffers/{id}', 'OffersController@popular')->middleware(['auth', 'check-permissions']);
        Route::any('main-admin/editoffers/{id}', 'OffersController@editoffer')->middleware(['auth', 'check-permissions']);
        Route::any('main-admin/deleteoffers/{id}', 'OffersController@deleteoffer')->middleware(['auth', 'check-permissions']);


        /*
        |--------------------------------------------------------------------------
        | Website routes
        |--------------------------------------------------------------------------
        */
        Route::any('/', 'Website\IndexController@index');

        /*
        |--------------------------------------------------------------------------
        | Blogs routes
        |--------------------------------------------------------------------------
        */
        Route::any('/blog', 'Website\BlogsController@blogs');
        Route::any('/blog/like', 'Website\BlogsController@like');
        Route::any('/blog/comment', 'Website\BlogsController@comment');
        Route::any('/blog/{title_slug}/delete_comment', 'Website\BlogsController@delete_comment');
        Route::any('/blog/{title_slug}', 'Website\BlogsController@blog');

        /*
        |--------------------------------------------------------------------------
        | Student Questions Answers routes
        |--------------------------------------------------------------------------
        */
        Route::any('/qna', 'Website\StudentQuestionsAnswersController@student_questions');
        Route::any('/ask_question', 'Website\StudentQuestionsAnswersController@ask_question');
        Route::any('/give_answer', 'Website\StudentQuestionsAnswersController@give_answer');
        Route::any('/report/{id}', 'Website\StudentQuestionsAnswersController@report');
        Route::any('/qna/{id}', 'Website\StudentQuestionsAnswersController@student_answers');
        Route::any('/update_question', 'Website\StudentQuestionsAnswersController@update_question');
        Route::any('/update_answer', 'Website\StudentQuestionsAnswersController@update_answer');
        Route::any('/delete_question/{id}', 'Website\StudentQuestionsAnswersController@delete_question');
        Route::any('/delete_answer/{id}', 'Website\StudentQuestionsAnswersController@delete_answer');
        Route::any('/report_answer/{id}', 'Website\StudentQuestionsAnswersController@report_answer');
        Route::any('tags_for_questions', 'Website\StudentQuestionsAnswersController@tags_for_questions');

        /*
        |--------------------------------------------------------------------------
        | Student registeration and login routes
        |--------------------------------------------------------------------------
        */
        Route::post('/student/login', 'Website\LoginController@login');
        Route::post('/student/logout', 'Website\LoginController@logout');
        Route::post('/student/forgot', 'Website\LoginController@forgot');
        Route::post('/student/change', 'Website\LoginController@change');
        Route::post('/student/resetPassword', 'Website\LoginController@resetPassword');
        Route::post('/student/getotp', 'Website\LoginController@getotp');
        Route::post('/student/tempregister', 'Website\RegisterController@tempregister');
        Route::post('/student/register', 'Website\RegisterController@register');

        /*
        |--------------------------------------------------------------------------
        | Student profile routes
        |--------------------------------------------------------------------------
        */
        Route::any('/student/profile', 'Website\StudentProfileController@student_profile');
        Route::any('/student/profile/update', 'Website\StudentProfileController@student_profile_update');

        Route::any('/student/profile/verify/otp/send', 'Website\StudentProfileController@send_otp');

        Route::any('/student/profile/verify/otp/verify', 'Website\StudentProfileController@verify_otp');

        Route::any('/student/profile/cities', 'Website\StudentProfileController@cities');
        Route::any('/student/profile/states', 'Website\StudentProfileController@states');
        Route::any('/student/profile/change_password', 'Website\StudentProfileController@change_password');
        Route::any('/student/profile/student_academic_details', 'Website\StudentProfileController@student_academic_details');
        Route::any('/student/profile/student_academic_details_update', 'Website\StudentProfileController@student_academic_details_update');
        Route::any('/student/profile/stream_course', 'Website\StudentProfileController@stream_course');
        Route::any('/student/profile/stream_course_remove', 'Website\StudentProfileController@stream_course_remove');
        Route::any('/student/profile/student_education_level_information_update', 'Website\StudentProfileController@student_education_level_information_update');

        /*
        |--------------------------------------------------------------------------
        | Student social login routes
        |--------------------------------------------------------------------------
        */
        Route::any('/student/login/{provider_google_facebook_etc}', 'Website\SocialLoginController@redirect');
        Route::any('/student/login/{provider_google_facebook_etc}/callback', 'Website\SocialLoginController@callback');

        Route::any('/student/social_login/mobile_verify', 'Website\SocialLoginController@student_mobile_verify');
        Route::any('/student/social_login/mobile_verify_otp', 'Website\SocialLoginController@student_mobile_verify_otp');
        
        
        Route::any('/enterprise/login/{provider_google_facebook_etc}', 'Website\EnterpriseSocialLoginController@redirect');
        Route::any('/enterprise/login/{provider_google_facebook_etc}/callback', 'Website\EnterpriseSocialLoginController@callback');

        Route::any('/enterprise/social_login/mobile_verify', 'Website\EnterpriseSocialLoginController@enterprise_mobile_verify');
        Route::any('/enterprise/social_login/mobile_verify_otp', 'Website\EnterpriseSocialLoginController@enterprise_mobile_verify_otp');
        

        /*
        |--------------------------------------------------------------------------
        | Test routes
        |--------------------------------------------------------------------------
        */
        Route::any('/instructions/{id}/{slug}', 'Website\FreePreparationToolController@instructions');
        Route::any('/test/{course_id}/{slug}', 'Website\FreePreparationToolController@test');
        Route::any('/question', 'Website\FreePreparationToolController@question');
        Route::any('/mark_as_review', 'Website\FreePreparationToolController@mark_as_review');

        Route::any('/question', 'Website\FreePreparationToolController@question');
        Route::any('/next_question', 'Website\FreePreparationToolController@next_question');
        Route::any('/previous_question', 'Website\FreePreparationToolController@previous_question');
        Route::any('/reset_answer', 'Website\FreePreparationToolController@reset_answer');
        Route::any('/save_and_next', 'Website\FreePreparationToolController@save_and_next');
        Route::any('/timer', 'Website\FreePreparationToolController@timer');
        Route::any('/attempts', 'Website\FreePreparationToolController@attempts');
        Route::any('/test_result/{course_id}/{slug}', 'Website\FreePreparationToolController@test_result');
        Route::any('/test_submit/{course_id}/{slug}', 'Website\FreePreparationToolController@test_submit');

        Route::any('/study-material', 'Website\FreePreparationToolController@question_papers_stream_wise');
        Route::any('/study-material/{stream_slug?}', 'Website\FreePreparationToolController@question_papers');
        
        /*
        |--------------------------------------------------------------------------
        | Coaching information pages routes
        |--------------------------------------------------------------------------
        */
        Route::any('/add_to_favorite/{coaching_id}', 'Website\CoachingController@add_to_favorite');

        Route::any('/student_review', 'Website\CoachingController@student_review');
        Route::any('/delete_student_review', 'Website\CoachingController@delete_student_review');

        Route::any('/request_callback/{coaching_id}', 'Website\CoachingController@request_callback');

        Route::any('/location_difference', function() {
        
            // Google API key
            $apiKey = 'AIzaSyCkUOdZ5y7hMm0yrcCQoCvLwzdM6M8s5qk';

            $addressFrom = 'Jaipur';
            $addressTo = 'Kota';
            
            // Change address format
            $formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
            $formattedAddrTo     = str_replace(' ', '+', $addressTo);
            
            // Geocoding API request with start address
            $geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false&key='.$apiKey);
            $outputFrom = json_decode($geocodeFrom);
            if(!empty($outputFrom->error_message)){
                return $outputFrom->error_message;
            }
            
            // Geocoding API request with end address
            $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false&key='.$apiKey);
            $outputTo = json_decode($geocodeTo);
            if(!empty($outputTo->error_message)){
                return $outputTo->error_message;
            }
            
            // Get latitude and longitude from the geodata
            $latitudeFrom    = $outputFrom->results[0]->geometry->location->lat;
            $longitudeFrom    = $outputFrom->results[0]->geometry->location->lng;
            $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
            $longitudeTo    = $outputTo->results[0]->geometry->location->lng;
            
            // Calculate distance between latitude and longitude
            $theta    = $longitudeFrom - $longitudeTo;
            $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
            $dist    = acos($dist);
            $dist    = rad2deg($dist);
            $miles    = $dist * 60 * 1.1515;
            
            // Convert unit and return distance
            $unit = strtoupper($unit);
            if($unit == "K"){
                echo round($miles * 1.609344, 2).' km';
            }elseif($unit == "M"){
                echo round($miles * 1609.344, 2).' meters';
            }else{
                echo round($miles, 2).' miles';
            }
            
        });

        Route::any('/coaching/{coaching_name_slug}/team', 'Website\CoachingController@team');
        Route::any('/coaching/{coaching_name_slug}/gallery', 'Website\CoachingController@gallery');
        Route::any('/coaching/{coaching_name_slug}/courses', 'Website\CoachingController@courses');
        Route::any('/coaching/{coaching_name_slug}/results', 'Website\CoachingController@results');
        Route::any('/coaching/{coaching_name_slug}/reviews', 'Website\CoachingController@reviews');
        Route::any('/coaching/{coaching_name_slug}/reviews/{reviews?}', 'Website\CoachingController@reviews');

        # should be the last route because we are using team, gallery etc 
        Route::any('/coaching/{coaching_name_slug}/{branch_slug?}', 'Website\CoachingController@overview');

        /*
        |--------------------------------------------------------------------------
        | Exams routes
        |--------------------------------------------------------------------------
        */
        Route::any('/exam', 'Website\ExamsController@exams');
        Route::any('/exams/{stream}', 'Website\ExamsController@stream_wise_exams');
        Route::any('/exam/{title}', 'Website\ExamsController@exam');

        Route::any('/clickcounter', 'Website\ExamsController@clickcounter');


        # coaching searching page
        Route::any('/coaching-search', 'Website\CoachingSearchController@coaching_search');

        # coaching compare page
        Route::any('/compare', 'Website\CoachingCompareController@compare');

        # colleges
        Route::any('/colleges', 'Website\CollegeController@colleges');

        # should be the last route because we are using team, gallery etc 
        Route::any('/college/{college_name_slug}', 'Website\CollegeController@college');

        Route::any('/college/add_to_favorite/{college_id}', 'Website\CollegeController@add_to_favorite');

        /*
        |--------------------------------------------------------------------------
        | Enterprise registeration and login routes
        |--------------------------------------------------------------------------
        */
        Route::any('/enterprises', 'Website\EnterpriseController@index');
        Route::any('/enterprise/login', 'Website\EnterpriseLoginController@login');
        Route::post('/enterprise/logout', 'Website\EnterpriseLoginController@logout');
        Route::any('/enterprise/forgot', 'Website\EnterpriseLoginController@forgot');
        Route::any('/enterprise/change', 'Website\EnterpriseLoginController@change');
        Route::any('/enterprise/tempregister', 'Website\EnterpriseRegisterController@tempregister');
        Route::any('/enterprise/register', 'Website\EnterpriseRegisterController@register');

        Route::any('/enterprise/reviews', 'Website\EnterpriseController@reviews');

        Route::any('/enterprise/totalclicks', 'Website\EnterpriseController@totalclicks');

        Route::any('/enterprise/totalcourses', 'Website\EnterpriseController@totalcourses');
        
        # show plans to enterprise
        Route::any('/enterprise/plans', 'Website\EnterpriseController@plans');

        Route::any('/enterprise/profile', 'Website\EnterpriseProfileController@enterprise_profile');
        Route::any('/enterprise/profile/update', 'Website\EnterpriseProfileController@enterprise_profile_update');
        Route::any('/enterprise/profile/change_password', 'Website\EnterpriseProfileController@change_password');

        Route::any('/enterprise/branch/update', 'Website\EnterpriseProfileController@enterprise_branch_update');
        Route::any('/enterprise/courses/update', 'Website\EnterpriseProfileController@enterprise_courses_update');
        Route::any('/enterprise/results/update', 'Website\EnterpriseProfileController@enterprise_results_update');
        Route::any('/enterprise/faculty/update', 'Website\EnterpriseProfileController@enterprise_faculty_update');

        Route::any('/enterprise/profile/cities', 'Website\EnterpriseProfileController@cities');
        Route::any('/enterprise/profile/states', 'Website\EnterpriseProfileController@states');
        Route::any('/enterprise/become_prime_member', 'Website\EnterpriseProfileController@become_prime_member');

        Route::any('/enterprise/profile/stream_course', 'Website\EnterpriseProfileController@stream_course');
        Route::any('/enterprise/searchlead', 'Website\EnterpriseController@searchlead');

        Route::any('/enterprise/pagelead', 'Website\EnterpriseController@pagelead');
        
        Route::any('/enterprise/select_plan', 'Website\EnterpriseProfileController@select_plan');
        
        # coaching counselling page
        Route::any('/counselling', 'Website\CounsellingController@career_counselling');

        # should be the last route because we are using team, gallery etc 
        Route::any('/news/{news_name_slug}', 'Website\TrendingTodayController@news');

        
        Route::post('/student/add_blog', 'Website\BlogsController@add_blog');
        
        Route::post('/resend_otp', 'Website\LoginController@resend_otp');

        Route::any('/enterprise/purchaselead', 'Website\EnterpriseController@purchaselead');

    }
);

# Paytm payment gateway

Route::any('/api/order', 'Website\OrderController@order');
Route::any('/api/order/callback', 'Website\OrderController@paymentCallback');
Route::any('/api/order/otp', 'Website\OrderController@otp');
Route::any('/api/order/otp/verify', 'Website\OrderController@otp_verify');
Route::any('/api/discount', 'Website\OrderController@discount');
Route::any('/api/code', 'Website\OrderController@code');

Route::any('/api/counseling_order', 'Website\CounsellingpaymentController@order');
Route::any('/api/counseling_order/callback', 'Website\CounsellingpaymentController@paymentCallback');
Route::any('/api/counseling_order/otp', 'Website\CounsellingpaymentController@otp');
Route::any('/api/counseling_order/otp/verify', 'Website\CounsellingpaymentController@otp_verify');
Route::any('/api/order/enterprise_otp', 'Website\OrderController@enterprise_otp');

Route::any('/api/discount_counseling', 'Website\CounsellingpaymentController@discount_counseling');


Route::prefix('coaching_admin')->group( function() {
    Route::any('get_allcity', 'CollegeController@get_allcity');
    Route::any('get_allstate', 'CollegeController@get_allstate');
});

Route::any('/request_callback_purchase', 'Website\CoachingController@request_callback_purchase');

Route::get("single-blog/{id}", 'DataController@singleBlog');
Route::get("/sitemap.xml", 'SitemapsController@Posts');

Route::any('/check_mail/{email}', function($email) {

 Mail::to($email)->send(new App\Mail\SendMailable('test'));

});


Route::any('/cancel/signup/{student_or_enterprise}', 'Website\IndexController@cancel_signup');

Route::any('db_backup', function () {

    // remove backup more than 7 days
    $folder_path = '/var/www/html/database_backup';

    // List of name of files inside
    $files = glob($folder_path.'/*'); 

    if( count($files) == 7 ) {
        // Deleting all the files in the list
        foreach($files as $file) {

            // Delete the given file
            unlink($file); 
        }
    }
        
    // backup

    $password = 'coachingselect@123456';

    $database_to_export = 'coachingselect';

    $backup_path = '/var/www/html/database_backup/database-' . date('d-m-Y') . '.sql';

    $command = 'mysqldump -u root --password=' . $password . ' ' . $database_to_export . ' > ' . $backup_path;
    
    exec($command, $output);

});

# should be the last route 
Route::any('{news_name_direct_slug}', 'Website\TrendingTodayDirectController@news');
