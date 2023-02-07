<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use Log;

use Socialite;

use App\Helpers\Helpers;

class SocialLoginController extends Controller
{

    public function redirect($provider) {
        
        $callback = action('Website\SocialLoginController@callback', $provider);
        
        $_SESSION['callback'] = $callback;
        $_SESSION['previous'] = url()->previous();
        
        return Socialite::driver($provider)->redirectUrl($callback)->redirect();
    }

    public function callback($provider) {

        try {

            $user = Socialite::driver($provider)->user();

        } catch(\Exception $e) {

            Log::info( $e->getMessage() );

            return redirect('/');
        }
        
        $name = $user->name ?? '';
        $email = $user->email ?? '';
        $mobile = $user->mobile ?? '';

        if( !empty($email) ) {

            $is_exists = DB::table('students')
                            ->where('email', $email)
                            ->first();
            if(!empty($is_exists)){
                if($is_exists->status==1){
                    return redirect($_SESSION['previous'])->with('error', 'Blocked by Admin');
                }
            }

            if($is_exists) {

                session()->forget('enterprise');

                session([
                    'student' => $is_exists
                ]);

                return redirect($_SESSION['previous']);

            } else {
                

                $student = array();
                $student['name'] = $name;
                $student['mobile'] = $mobile;
                $student['email'] = $email;
                $student['password'] = '';
                
                DB::table('tempstudents')
                        ->where('mobile', $mobile)
                        ->delete();
                        
                DB::table('tempstudents')
                        ->where('email', $email)
                        ->delete();

                $is_created = DB::table('tempstudents')
                                ->insert($student);

                if($is_created) {

                    $student = DB::table('tempstudents')
                                ->where('email', $email)
                                ->first();

                   
                                
                    session()->forget('student');

                    session()->forget('enterprise');

                    session([
                        'tempstudent' => $student
                    ]);

                    return redirect($_SESSION['previous']);

                } else {
                    return redirect($_SESSION['previous'])->with('error', 'Something went wrong');
                }

            }

        } else {
            return redirect($_SESSION['previous'])->with('error', 'Something went wrong');
        }
        
    }

    public function student_mobile_verify() {

        $mobile = request()->get('mobile');
        
        if(! session()->has('tempstudent') ) {

            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Please social login first';

            return $error;

        }
        
        if( empty($mobile) ) {

            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Mobile is required';

            return $error;

        } else {

            $is_already_with_email = DB::table('students')
                                        ->where('mobile', $mobile)
                                        ->exists();

            if($is_already_with_email) {
                        
                $error = array();
                $error['success'] = 0;
                $error['message'] = 'This mobile number is already taken';

                return $error;
                
            } else {

                $student = array();
                // $student['code'] = 1234;
                $student['code'] = rand(1000, 9999);
                $student['mobile'] = $mobile;

                $is_sent = DB::table('tempstudents')
                            ->where('id', session()->get('tempstudent')->id)
                            ->update($student);

                $sms = "Your secure otp is ".$student['code'].". Please do not share your otp with anyone. \n Regards, \n CoachingSelect";
                $mobile = DB::table('tempstudents')
                            ->where('id', session()->get('tempstudent')->id)
                            ->value('mobile');

                Helpers::sendTextSmsNew($sms, $mobile);

                $error = array();
                $error['success'] = 1;
                $error['message'] = 'OTP sent';

                return $error;
            }
        }
    }

    public function student_mobile_verify_otp() {

        $mobile = request()->get('mobile');
        
        $otp = request()->get('student_mobile_verify-otp');
        $otp = implode('', $otp);
        
        if(! session()->has('tempstudent') ) {

            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Please social login first';

            return $error;

        }
        
        if( empty($mobile) ) {

            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Mobile is required';

            return $error;

        } else {

            $is_already_with_email = DB::table('students')
                                        ->where('mobile', $mobile)
                                        ->exists();

            if($is_already_with_email) {
                        
                $error = array();
                $error['success'] = 0;
                $error['message'] = 'This mobile number is already taken';

                return $error;
                
            } else {
                    
                $is_already_with_mobile = DB::table('tempstudents')
                                            ->where('mobile', $mobile)
                                            ->where('code', $otp)
                                            ->first();
    
                if($is_already_with_mobile) {
                            
                    $student = array();
                    $student['name'] = $is_already_with_mobile->name;
                    $student['mobile'] = $is_already_with_mobile->mobile;
                    $student['email'] = $is_already_with_mobile->email;
                    $student['password'] = '';
    
                    $is_registered = DB::table('students')
                                        ->insert($student);
    
                    if( !empty($is_registered) ) {
    
                        DB::table('tempstudents')
                            ->where('mobile', $mobile)
                            ->delete();
    
                        $is_exists = DB::table('students')->where('mobile',$student['mobile'])->first();
                        
                        if(!empty($is_exists)){
                            session()->forget('tempstudent');
                            session()->forget('enterprise');
    
                            session([
                                'student' => $is_exists
                            ]);
                        }
                        
                        try {
                    
                            // send mail
                            $email = $is_exists->email;
                            
                            $subject = $is_exists->name.', Welcome to CoachingSelect';
                    
                            if( !empty($email) ) {
                                    
                                $datamessage['email']=$email;
                        		$datamessage['subject']=$subject;
                        		
                        		$student = $is_exists;
                        		
                        	    \Mail::send('mails.student_signup', compact('student'), function ($m) use ($datamessage){
                        			$m->from('support@coachingselect.com', 'CoachingSelect');
                        			$m->to($datamessage['email'])->subject($datamessage['subject']);
                        		});
                        		
                            }
                                        
                        } catch(\Exception $e) {
                            // ignore mail error
                        }
                        
                        $error = array();
                        $error['success'] = 1;
                        $error['message'] = 'Verified';
    
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
                    $error['message'] = 'Invalid OTP';
    
                    return $error;
                }
            }
        }
    }

}