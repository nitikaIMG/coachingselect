<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;
use Mpdf;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Website\HeaderController;
use App\Http\Controllers\Website\FooterController;

class StudentProfileController extends Controller
{

    public function student_profile() {

        if(
          ! session()->has('student')
        ) {
            return redirect()
                    ->action("Website\IndexController@index")
                    ;
        }
        
        $header = new HeaderController();
        $footer = new FooterController();

        $countries = DB::table('countries')
                        ->select('id', 'name')
                        ->get();

        $student_academic_details = DB::table('student_academic_details')
                                    ->join('streams', 'streams.id', 'student_academic_details.stream_id')
                                    ->where('student_academic_details.user_id', session()->get('student')->id)
                                    ->select('streams.name', 'streams.image', 'student_academic_details.courses', 'streams.id as stream_id', 'student_academic_details.user_id')
                                    ->get();
                                    
        $student_education_level_information = DB::table('student_education_level_information')
                                                ->where('student_education_level_information.user_id', session()->get('student')->id)
                                                ->whereIn('class_level', ["V-XII", "UG", "PG"])
                                                ->orderBy(DB::raw('FIELD(class_level, "V-XII", "UG", "PG")'))
                                                ->get();

        $streams = DB::table('streams')
                        ->select('id', 'name')
                        ->get();

        session()->forget('student_academic_details');

        $history_with_coaching_select = $this->history_with_coaching_select();

        $my_purchases = DB::table('orders')
                            ->join('coaching_courses_detail', 'coaching_courses_detail.id', '=', 'orders.coaching_courses_detail_id')
                            ->join('coaching', 'coaching.id', '=', 'coaching_courses_detail.coaching_id')
                            ->where('orders.user_id', session()->get('student')->id)
                            ->where('orders.status', 'TXN_SUCCESS')
                            ->select('coaching_courses_detail.*', 'coaching.name as coaching_name', 'coaching.address', 'coaching.state', 'coaching.city', 'coaching.image', 'orders.*', 'coaching_courses_detail.offering as course_offering', 'coaching.*', 'coaching.offering', 'coaching_courses_detail.name as course_name', 'orders.created_at', 'coaching_courses_detail.id as ccdi')
                            ->orderBy('orders.created_at', 'DESC')
                            ->get();

        
        $student = DB::table('students')
                    ->where('id', session()->get('student')->id)
                    ->first();

        session([
            'student' => $student
        ]);
        
        $metatitle = "Student Edit Profile | CoachingSelect.com";
                        
        return view('website.student_profile', compact('metatitle','header', 'footer', 'countries', 'student_academic_details', 'streams', 'student_education_level_information', 'history_with_coaching_select', 'my_purchases'));
    }
    
    public function student_profile_update() {
        
        if( request()->isMethod('post') and session()->has('student') ) {

            $input = request()->except(['_token', 'image']);   
                 
            if (!request()->file('image')) {
                unset($input['image']);
            } else {

                $file = request('image');

                $thumbnailPath = public_path('student/');

                $fileName = 'student-profile-' . time() . random_int(0, 10);

                $input['image'] = asset('public/student/' . Helpers::imageSingleUpload($file, $thumbnailPath, $fileName) );

                if ($input['image'] == '') {
                    return redirect()->back()->with('errorProfile', 'invalid image provided');
                }
            }

            unset(
                $input['mobile']
            );

            if(session()->get('student')->is_email_verified) {
                unset(
                    $input['email']
                );
            }
                        
            if ( !empty( request()->get('alternative_mobile') ) ) {
                    
                if(!preg_match('/^[0-9]{10}$/', $input['alternative_mobile'])) {
                    
                    return redirect()->back()->with('errorProfile', 'Please enter a valid alternative mobile number');

                } else if( request()->get('alternative_mobile') == session()->get('student')->mobile ) {

                    return redirect()->back()->with('errorProfile', 'Phone Number and Alternate Number can’t be same');
                }
            }
            
            if ( !empty( request()->get('email') ) ) {
                    
                if( ! filter_var($input['email'], FILTER_VALIDATE_EMAIL) ) {
                    
                    return redirect()->back()->with('errorProfile', 'Please enter a valid email address');

                }
            }
                   
            DB::table('students')
                ->where('id', session()->get('student')->id)
                ->update($input);
                
            $student = DB::table('students')
                        ->where('id', session()->get('student')->id)
                        ->first();

            session([
                'student' => $student
            ]);

            return redirect()
                    ->back()
                    ->with('successProfile', 'Profile Updated Successfully');

        } else {
            return redirect()->back();
        }

    }    
    
    public function send_otp() {
        
        if( ! session()->has('student') ) {

            return redirect()->back()->with('errorProfile', 'You must logged in');
        }

        $field = request()->get('field');
        $value = request()->get('value');

        if( empty($field) ) {

            $error = array();
            $error['success'] = 0;
            $error['message'] = ucwords($field) . ' is required';

            return $error;

        } else {

            $is_already_exists = DB::table('students')
                                ->where($field, $value)
                                ->where('id', '!=', session()->get('student')->id)
                                ->exists();

            if($is_already_exists) {
                
                $error = array();
                $error['success'] = 0;
                $error['message'] = 'This ' . $field . ' already taken';

                return $error;
            }
        }

        if($field == 'mobile') {

            if(!preg_match('/^[0-9]{10}$/',$value)) {
                
                $error = array();
                $error['success'] = 0;
                $error['message'] = 'Please enter a valid mobile number';

                return $error;
            }
            
        } else {

            if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
                
                $error = array();
                $error['success'] = 0;
                $error['message'] = 'Please enter a valid email address';

                return $error;
            }
            
        }

        $is_sent = DB::table('students')
                    ->where('id', session()->get('student')->id)
                    ->update([ 'code' => 0]);
                
        $student = array();
        // $student['code'] = 1234;
        $student['code'] = rand(1000, 9999);
        
        $is_sent = DB::table('students')
                    ->where('id', session()->get('student')->id)
                    ->update($student);

        if($field == 'mobile') {
            $sms = "Your secure otp is ".$student['code'].". Please do not share your otp with anyone. \n Regards, \n CoachingSelect";
            $mobile = DB::table('students')
                        ->where('id', session()->get('student')->id)
                        ->value('mobile');

            Helpers::sendTextSmsNew($sms, $mobile);
        } else {
        
            $content = $student['code'];
            
            $email = DB::table('students')
                    ->where('id', session()->get('student')->id)
                    ->value('email');

            try {
                // send mail
                $subject = 'Verify Email';
        
                if( !empty($email) ) {
                        
                    $datamessage['email']=$email;
                    $datamessage['subject']=$subject;
                                    
                    \Mail::send('mails.verify_email', compact('content'), function ($m) use ($datamessage){
                        $m->from('support@coachingselect.com', 'CoachingSelect');
                        $m->to($datamessage['email'])->subject($datamessage['subject']);
                    });
            
                }
            } catch(\Exception $e) {
                $error = array();
                $error['success'] = 0;
                $error['message'] = $e->getMessage();

                return $error;
            }
        }

        if( !empty($is_sent) ) {

            $error = array();
            $error['success'] = 1;
            $error['message'] = 'OTP sent';

            return $error;

        } else {
            
            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Something went wrong';

            return $error;

        }
    }
        
    public function verify_otp() {
        
        if( ! session()->has('student') ) {

            return redirect()->back()->with('errorProfile', 'You must logged in');
        }
        
        $otp = request()->get('otp');

        $otp = implode('', $otp);

        $field = request()->get('field');

        if( empty($otp) ) {

            $error = array();
            $error['success'] = 0;
            $error['message'] = 'OTP is required';

            return $error;

        } 

        $is_already_exists = DB::table('students')
                                ->where('id', session()->get('student')->id)
                                ->where('code', $otp)
                                ->exists();

        if(! $is_already_exists) {
            
            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Invalid OTP';

            return $error;
        }
                
        $student = array();
        $student['code'] = 0;
        $student['is_email_verified'] = 1;

        $is_sent = DB::table('students')
                    ->where('id', session()->get('student')->id)
                    ->update($student);

        if( !empty($is_sent) ) {

            $error = array();
            $error['success'] = 1;
            $error['message'] = ucwords($field) .' verified successfully';

            return $error;

        } else {
            
            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Invalid OTP';

            return $error;

        }
    }
    
    public function cities() {
        $state_id = request()->get('state_id');

        $state_id = DB::table('states')
                        ->where('name', $state_id)
                        ->orwhere('id', $state_id)
                        ->value('id');

        return DB::table('cities')
            ->where('state_id', $state_id)
            ->get();
    }


    public function states() {

        $country_id = request()->get('country_id');

        $country_id = DB::table('countries')
                        ->where('name', $country_id)
                        ->value('id');

        return DB::table('states')
            ->where('country_id', $country_id)
            ->get();
    }

    public function change_password() {
        
        if( ! session()->has('student') ) {       

            $error = array();
            $error['success'] = 0;
            $error['message'] = 'You must logged in';

            return $error;
        }

        $old_password = request()->get('old_password');
        $new_password = request()->get('new_password');
        $confirm_password = request()->get('confirm_password');

        if( empty($old_password) ) {

            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Old password is required';

            return $error;

        }
        
        if( empty($new_password) ) {

            $error = array();
            $error['success'] = 0;
            $error['message'] = 'New password is required';

            return $error;

        }
        
        if( empty($confirm_password) ) {

            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Confirm password is required';

            return $error;

        }
    
        $user = DB::table('students')
                        ->where('id', session()->get('student')->id)
                        ->first();

        if($user) {

            if(! Hash::check($old_password, $user->password)) {
                
                $error = array();
                $error['success'] = 0;
                $error['message'] = 'Invalid current password';

                return $error;
            }

            if( $new_password != $confirm_password ) {

                $error = array();
                $error['success'] = 0;
                $error['message'] = 'New Password and confirm password does not matched';

                return $error;

            }
                    
            $student = array();
            $student['password'] = Hash::make($new_password);

            $is_changed = DB::table('students')
                                ->where('id', session()->get('student')->id)
                                ->update($student);

            if( $is_changed ) {

                $error = array();
                $error['success'] = 1;
                $error['message'] = 'Password changed successfully';

                return $error;

            } else {
                
                $error = array();
                $error['success'] = 0;
                $error['message'] = 'Something went wrong';

                return $error;

            }

        } else {

            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Something went wrong';

            return $error;
        }
        
    }
    
    public function student_academic_details() {
        
        if( request()->isMethod('post') and session()->has('student') ) {

            $stream_id = request()->get('stream_id');
            $courses = request()->get('courses');

            if( !empty($stream_id) and !empty($courses) ) {
                    
                # courses from the db
                $student_academic_details_db = DB::table('student_academic_details')
                                                ->join('streams', 'streams.id', 'student_academic_details.stream_id')
                                                ->where('student_academic_details.user_id', session()->get('student')->id)
                                                ->select('streams.name', 'streams.image', 'student_academic_details.courses', 'streams.id as stream_id', 'student_academic_details.user_id')
                                                ->get();

                $student_academic_details_db = json_decode(
                                                    $student_academic_details_db,
                                                    true
                                                );

                # student academic session            
                $student_academic_details = array();
                 
                if( !empty($student_academic_details_db) ) {
                    foreach($student_academic_details_db as $student_academic_detail) {
                        $student_academic_details[$student_academic_detail['stream_id']] = $student_academic_detail;
                    }
                }  
                # courses from the db
                
                # new course
                $stream = DB::table('streams')
                            ->where('id', $stream_id)
                            ->first();
               
                $student_academic_detail = array();
                $student_academic_detail['name'] = $stream->name;
                $student_academic_detail['image'] = $stream->image;
                $student_academic_detail['stream_id'] = $stream->id;
                $student_academic_detail['user_id'] = session()->get('student')->id;
                
                if( session()->has('student_academic_details') ) {
                    $student_academic_details = session()->get('student_academic_details');
                } 

                if( !empty($student_academic_details[$stream_id]) ) {

                    $student_academic_detail_courses = explode(',', $student_academic_details[$stream_id]['courses']);
                    
                    $student_academic_detail_courses = array_merge($courses, $student_academic_detail_courses);

                    $student_academic_detail_courses = array_unique($student_academic_detail_courses);

                } else {
                    $student_academic_detail_courses = $courses;
                }

                $student_academic_detail['courses'] = implode(',', $student_academic_detail_courses);

                $student_academic_details[$stream_id] = $student_academic_detail;
                
                session([
                    'student_academic_details' => $student_academic_details
                ]); 

                return 
                json_encode(
                    array_values( $student_academic_details)
                );
            }

        } else {
            return 0;
        }

    }  
    
    public function student_academic_details_update() {
        
        if( request()->isMethod('post') and session()->has('student') ) {

            $input = request()->except(['_token']);                                

            if(
                session()->has('student_academic_details')
                and
                !empty(
                    session()->get('student_academic_details')
                )
            ) {                

                $student_academic_details = session()->get('student_academic_details');
                
                $student_academic_details = array_values($student_academic_details);
                
                DB::table('student_academic_details')
                    ->where('user_id', session()->get('student')->id)
                    ->delete();
                    
                DB::table('student_academic_details')
                    ->insert($student_academic_details);
                    
                return redirect()
                        ->back()
                        ->with('successProfile', 'Academic Details Updated Successfully');

            }
        } else {
            return redirect()->back();
        }
    
        return redirect()->back();

    }
    
    public function stream_course()
    {
        $courses = DB::table('courses')
            ->where('stream_id', request()->get('stream_id'))
            ->where('type', 'coaching')
            ->get();

        return $courses;
    }

    
    public function stream_course_remove() {
        
        if( request()->isMethod('post') and session()->has('student') ) {

            $stream_id = request()->get('stream_id');
            
            if( !empty($stream_id) ) {
                
                $stream = DB::table('streams')
                            ->where('id', $stream_id)
                            ->first();
               
                # student academic session            
                $student_academic_details = array();

                if( session()->has('student_academic_details') ) {
                    $student_academic_details = session()->get('student_academic_details');
                } 

                unset(
                    $student_academic_details[$stream_id]
                ); 

                session([
                    'student_academic_details' => $student_academic_details
                ]); 

                return 1;
            }

        } else {
            return 0;
        }

    }  

    public function student_education_level_information_update() {
        
        if( request()->isMethod('post') and session()->has('student') ) {

            $input = request()->except(['_token']);          
            
            if(
                request()->has('student_education_level_information')
                and
                !empty(
                    request()->get('student_education_level_information')
                )
            ) {                

                $student_education_level_information = request()->get('student_education_level_information');
                
                DB::table('student_education_level_information')
                    ->where('user_id', session()->get('student')->id)
                    ->delete();
                
                foreach($student_education_level_information as $info) {
                    
                    $info['user_id'] = session()->get('student')->id;

                    DB::table('student_education_level_information')
                        ->insert($info);
                }
                    
                return redirect()
                        ->back()
                        ->with('successProfile', 'Education Level Information Updated Successfully');

            }
        } else {
            return redirect()->back();
        }
        
        return redirect()->back();

    }

    public function history_with_coaching_select() {
        
        $user_id = session()->get('student')->id;

        $history_with_coaching_select = new \stdClass();
        
        $history_with_coaching_select->favorite_coaching = DB::table('coaching')
                                                            ->join('student_favorite_coaching', 'student_favorite_coaching.coaching_id', 'coaching.id')
                                                            ->select('coaching.id', 'coaching.name', 'coaching.image', 'coaching.offering', 'student_favorite_coaching.created_at as date', 'coaching.city')
                                                            ->where('student_favorite_coaching.user_id', $user_id)
                                                            ->get();
                                                            
        $history_with_coaching_select->favorite_college = DB::table('college')
                                                            ->join('student_favorite_college', 'student_favorite_college.college_id', 'college.id')
                                                            ->select('college.id', 'college.college_name as name', 'college.image', 'student_favorite_college.created_at as date')
                                                            ->where('student_favorite_college.user_id', $user_id)
                                                            ->get();
                  
        $history_with_coaching_select->request_callback = DB::table('coaching')
                                                            ->join('student_request_callback', 'student_request_callback.coaching_id', 'coaching.id')
                                                            ->select('coaching.id', 'coaching.name', 'coaching.image', 'coaching.offering', 'student_request_callback.created_at as date', 'coaching.city')
                                                            ->where('student_request_callback.user_id', $user_id)
                                                            ->get();
        
        $history_with_coaching_select->test_and_downloads = $this->test_and_downloads($user_id);
        
        $history_with_coaching_select->reviews = $this->reviews($user_id);
        
        $history_with_coaching_select->comments = $this->comments($user_id);
        
        $history_with_coaching_select->student_questions = $this->student_questions($user_id);

        $history_with_coaching_select->student_answers = $this->student_answers($user_id);

        return $history_with_coaching_select;
    }

    public function test_and_downloads($user_id) {

        $question_paper_subjects = DB::table('test')
                                    ->join('question_paper_subjects', 'question_paper_subjects.id', 'test.question_paper_subject_id')
                                    ->where('test.user_id', $user_id)
                                    ->select(
                                        'question_paper_subjects.id',
                                        'question_paper_subjects.name', 
                                        'question_paper_subjects.image',
                                        'question_paper_subjects.course_id',
                                        'test.user_id',
                                        'test.status',
                                        'test.created_at as date'
                                    )
                                    ->get();

        if( !empty($question_paper_subjects) ) {
            foreach($question_paper_subjects as $question_paper_subject) {

                $question_paper_subject->total_score = 0;
                $question_paper_subject->score = 0;
                $question_paper_subject->total_correct = 0;
                $question_paper_subject->total_incorrect = 0;
                $question_paper_subject->total_attempted = 0;
                $question_paper_subject->total_unattempted = 0;

                $question_answers = DB::table('question_answer')
                                    ->where('question_paper_subject_id', $question_paper_subject->id)
                                    ->get();   
                            
                if( !empty($question_answers) ) {
                    
                    foreach($question_answers as $question_answer) {
                        
                        $test = DB::table('test_status')
                                    ->where('user_id', $user_id)
                                    ->where('question_paper_subject_id', $question_paper_subject->id)
                                    ->where('question_answer_id', $question_answer->id)
                                    ->first();

                        $question_answer->attempt = '';
                        $question_answer->is_my_answer_correct = false;
                
                        $question_paper_subject->total_score += $question_answer->marks;

                        if( !empty($test->option) ) {
                            
                            $question_paper_subject->total_attempted += 1;
                            
                            $question_answer->attempt = $test->option;

                            if($question_answer->attempt == $question_answer->answer) {
                                
                                $question_paper_subject->score += $question_answer->marks;

                                $question_answer->is_my_answer_correct = true;
                                    
                                $question_paper_subject->total_correct += 1;

                            } else {

                                $question_answer->negative_marks = str_replace('-', '', $question_answer->negative_marks);

                                $question_paper_subject->score -= $question_answer->negative_marks;
                                
                                $question_answer->is_my_answer_correct = false;
                                                                
                                $question_paper_subject->total_incorrect += 1;

                            }

                        } else {
                                        
                            $question_paper_subject->total_unattempted += 1;

                        }
                    }
                }
            }   
        }

        return $question_paper_subjects;
    }

    public function reviews($user_id) {  

        $all_reviews = DB::table('coaching_reviews')
                        ->join('coaching', 'coaching.id', 'coaching_reviews.coaching_id')
                        ->where('coaching_reviews.user_id', $user_id)
                        ->select('coaching_reviews.*', 'coaching.name as coaching_name', 'coaching.image')
                        ->orderBy('updated_at','DESC')->get();
    
        return $all_reviews;
    }    

    public function comments($user_id) {  

        $all_comments = DB::table('blogs_like_comment')
                        ->join('blogs', 'blogs.id', 'blogs_like_comment.blog_id')
                        ->where('blogs_like_comment.user_id', $user_id)
                        ->where('blogs_like_comment.status', 'enable')
                        ->whereNotNull('blogs_like_comment.comment')
                        ->where('blogs_like_comment.comment', '!=', '')
                        ->select('blogs_like_comment.*', 'blogs.title as blog_title', 'blogs.image')
                        ->get();
    
        return $all_comments;
    }
    
    public function student_questions($user_id) {  

        $student_questions = DB::table('student_questions')
                                ->join('students', 'students.id', 'student_questions.user_id')
                                ->where('student_questions.status', 'enable')
                                ->orderBy('student_questions.created_at', 'desc')
                                ->select('student_questions.*', 'students.name as student_name', 'students.image')
                                ->where('student_questions.user_id', $user_id);
        
        $student_questions = $this->latest_answer( $student_questions->get() );

        return $student_questions;
    }
    
    public function latest_answer($student_questions) {
        
        if( !empty($student_questions) ) {
            foreach($student_questions as $student_question) {

                $latest_answer = DB::table('student_answers')
                                    ->where('student_question_id', $student_question->id)
                                    ->where('student_answers.status', 'enable')
                                    ->orderBy('created_at', 'desc')
                                    ->value('name');

                $student_question->latest_answer = $latest_answer;
            }
        }

        return $student_questions;

    }

    public function student_answers($user_id) {  

        $student_answers = DB::table('student_answers')
                                ->join('student_questions', 'student_questions.id', 'student_answers.student_question_id')
                                ->where('student_answers.status', 'enable')
                                ->orderBy('student_answers.created_at', 'desc')
                                ->select('student_answers.*', 'student_questions.name as question', 'student_questions.tags')
                                ->where('student_answers.user_id', $user_id)
                                ->get();
        
        return $student_answers;
    }

    public function download_invoice($id) {

        $my_purchase = DB::table('orders')
                            ->join('coaching_courses_detail', 'coaching_courses_detail.id', '=', 'orders.coaching_courses_detail_id')
                            ->join('coaching', 'coaching.id', '=', 'coaching_courses_detail.coaching_id')
                            ->join('students', 'students.id', '=', 'orders.user_id')
                            ->where('orders.user_id', session()->get('student')->id)
                            ->where('orders.status', 'TXN_SUCCESS')
                            ->select('coaching_courses_detail.*', 'coaching.name as coaching_name', 'coaching.address', 'coaching.state', 'coaching.city', 'coaching.image', 'orders.*', 'coaching_courses_detail.offering as course_offering', 'coaching.*', 'coaching.offering', 'coaching_courses_detail.name as course_name', 'orders.created_at', 'students.address1', 'orders.parent_name as st_state', 'orders.created_at as cdate')
                            ->orderBy('orders.created_at', 'DESC')
                            ->where('coaching_courses_detail.id', $id)
                            ->first();

        $my_purchase->total = ($my_purchase->total_price / 1.18 );

        $my_purchase->half_gst = ( ($my_purchase->total_price - $my_purchase->total) / 2 );
        $my_purchase->full_gst = ($my_purchase->total_price - $my_purchase->total);

        $my_purchase->total = number_format($my_purchase->total, 2, '.', '');
        $my_purchase->half_gst = number_format($my_purchase->half_gst, 2, '.', '');
        $my_purchase->full_gst = number_format($my_purchase->full_gst, 2, '.', '');

        $my_purchase->code = DB::table('states')
                                ->where('name', $my_purchase->st_state)
                                ->value('state_code');

        $content=  view('mails.website_mail2', [
                    'my_purchase' => $my_purchase
                ]);

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($content);
        $mpdf->Output('CoachingSelectinvoice.pdf','D');
    }
    
}