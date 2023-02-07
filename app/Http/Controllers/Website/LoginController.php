<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Hash;
use DB;

use App\Helpers\Helpers;

class LoginController extends Controller
{

    public function login() {
        $login_student='';
        $email = request()->get('email');
        $password = request()->get('password');

        if(is_numeric($email)){
             $login_student = DB::table('students')->where('mobile',$email)->first('status');
        }else{
             $login_student = DB::table('students')->where('email',$email)->first('status');
        }
       
        if( empty($email) ) {

            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Email is required';

            return $error;
        }
        
        if( empty($password) ) {

            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Password is required';

            return $error;
        }


         if($login_student->status==1){
            $error = array();
            $error['success'] = 0;
            $error['message'] = 'User Unauthorise';

            return $error;
         }
         else{
            $is_exists = DB::table('students');

            if(preg_match('/^[0-9]{10}$/',$email)){

                $is_exists = $is_exists
                            ->where('mobile', $email);
            } else {
            $is_exists = $is_exists->where('email', $email);
            }

            $is_exists = $is_exists->first();
            
            if($is_exists) {

                if(! Hash::check($password, $is_exists->password) ){

                    $error = array();
                    $error['success'] = 0;
                    $error['message'] = 'Password does not matched';

                    return $error;
                }

                session()->forget('enterprise');

                session([
                    'student' => $is_exists
                ]);

                $error = array();
                $error['success'] = 1;

                if( !empty(request()->get('callback')) ) {
                    $error['callback'] = request()->get('callback');
                } else {
                    $error['callback'] = '';
                }
                
                $error['message'] = 'Login successfully';

                return $error;
                
            } else {

                $error = array();
                $error['success'] = 0;
                $error['message'] = 'Invalid login credentials';

                return $error;
            }

        }
       
        
    }

    public function logout() {
        session()->forget('student');

        return redirect()
                    ->back();
    }

    public function forgot() {

        $mobile = request()->get('mobile');
        
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
                        
                $student = array();
                $student['code'] = rand(1000, 9999);
                
                $is_sent = DB::table('students')
                                    ->where('mobile', $mobile)
                                    ->update($student);

                $sms = "Your secure otp is ".$student['code'].". Please do not share your otp with anyone. \n Regards, \n CoachingSelect";
                $mobile = DB::table('students')
                            ->where('mobile', $mobile)
                            ->value('mobile');

                Helpers::sendTextSmsNew($sms, $mobile);

                $error = array();
                $error['success'] = 1;
                $error['message'] = 'OTP sent';

                return $error;

            } else {

                $error = array();
                $error['success'] = 0;
                $error['message'] = 'There is no account with this mobile';

                return $error;
            }
        }
    }

    public function resetPassword() {

        $mobile = request()->get('mobile');
        $password = request()->get('password');
        $confirm_password = request()->get('reset_confirm_password');

        $otp = request()->get('forgot-otp');
        $otp = implode('', $otp);
        
        if( empty($mobile) ) {

            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Mobile is required';

            return $error;

        } else {

            $is_already_with_mobile = DB::table('students')
                                        ->where('mobile', $mobile)
                                        ->where('code', $otp)
                                        ->exists();
            
            if($is_already_with_mobile) {

                if( $password != $confirm_password ) {

                    $error = array();
                    $error['success'] = 0;
                    $error['message'] = 'Password and confirm password does not matched';

                    return $error;

                }
                // dd($is_already_with_mobile);      
                $student = array();
                $student['password'] = Hash::make($password);

                $is_changed = DB::table('students')
                                    ->where('mobile', $mobile)
                                    ->update($student);

                if( $is_changed ) {

                    $student = DB::table('students')
                                ->where('mobile', $mobile)
                                ->first();

                    if($student->status==1){
                        $error = array();
                        $error['success'] = 0;
                        $error['message'] = 'Blocked By Admin';
            
                        return $error;
                        }

                    session()->forget('enterprise');

                    session([
                        'student' => $student
                    ]);

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
                $error['message'] = 'Invalid OTP';

                return $error;
            }
        }
    }

    public function getotp(){
        $mobile = request()->get('mobile');
        $otp = request()->get('forgot-otp');
        $otp = implode('', $otp);
        if( empty($mobile) ) {

            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Mobile is required';

            return $error;

        } else {

            $is_already_with_mobile = DB::table('students')
                                        ->where('mobile', $mobile)
                                        ->where('code', $otp)
                                        ->exists();
            if($is_already_with_mobile){
                $error = array();
                $error['success'] = 1;
                $error['message'] = 'OTP matched';

                return $error;
            }else{
                $error = array();
                $error['success'] = 0;
                $error['message'] = 'OTP not matched';

                return $error;
            }
        }
    }

    public function change() {

        $email = request()->get('email');
        $password = request()->get('password');
        $confirm_password = request()->get('confirm_password');

        $otp = request()->get('forgot-otp');
        $otp = implode('', $otp);
        
        if( empty($email) ) {

            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Email is required';

            return $error;

        } else {

            $is_already_with_email = DB::table('students')
                                        ->where('email', $email)
                                        ->where('code', $otp)
                                        ->exists();

            if($is_already_with_email) {

                if( $password != $confirm_password ) {

                    $error = array();
                    $error['success'] = 0;
                    $error['message'] = 'Password and confirm password does not matched';

                    return $error;

                }
                        
                $student = array();
                $student['password'] = Hash::make($password);

                $is_changed = DB::table('students')
                                    ->where('email', $email)
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
                $error['message'] = 'Invalid OTP';

                return $error;
            }
        }
    }

    public function resend_otp() {

        $value = request()->get('value');
        $type = request()->get('type');
        $student_or_enterprise = request()->get('student_or_enterprise');
        
        if( empty($value) ) {

            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Something went wrong';

            return $error;

        } else {

            $field = 'email';

            if(preg_match('/^[0-9]{10}$/',$value)){
                $field = 'mobile';
            }

            if($student_or_enterprise == 'student') {
                $is_already_with_email = DB::table('students')
                                            ->where($field, $value)
                                            ->exists();
            } elseif($student_or_enterprise == 'enterprise') {
                $is_already_with_email = DB::table('enterprise')
                                            ->where($field, $value)
                                            ->exists();
            }

            if($is_already_with_email) {
                        
                $student = array();
                $student['code'] = rand(1000, 9999);
                // $student['code'] = rand(100000, 999999);

                if($student_or_enterprise == 'student') {

                    $sms = "Your secure otp is ".$student['code'].". Please do not share your otp with anyone. \n Regards, \n CoachingSelect";
                    $mobile = DB::table('students')
                                ->where($field, $value)
                                ->value('mobile');

                    Helpers::sendTextSmsNew($sms, $mobile);

                    $is_sent = DB::table('students')
                                ->where($field, $value)
                                ->update($student);
                } elseif($student_or_enterprise == 'enterprise') {
                    
                    $sms = "Your secure otp is ".$student['code'].". Please do not share your otp with anyone. \n Regards, \n CoachingSelect";
                    $mobile = DB::table('enterprise')
                                ->where($field, $value)
                                ->value('mobile');

                    Helpers::sendTextSmsNew($sms, $mobile);
                    
                    $is_sent = DB::table('enterprise')
                                ->where($field, $value)
                                ->update($student);
                                
                    $is_sent = DB::table('coaching')
                                ->where($field, $value)
                                ->update($student);
                }                

                $error = array();
                $error['success'] = 1;
                $error['message'] = 'OTP sent';
                
                return $error;

            } else {

                if($student_or_enterprise == 'student') {
                    $is_already_with_email = DB::table('tempstudents')
                                                ->where($field, $value)
                                                ->exists();
                } elseif($student_or_enterprise == 'enterprise') {
                    $is_already_with_email = DB::table('tempenterprise')
                                                ->where($field, $value)
                                                ->exists();
                }

                if($is_already_with_email) {
                            
                    $student = array();
                    $student['code'] = rand(1000, 9999);
                    
                    if($student_or_enterprise == 'student') {
                        
                        $sms = "Your secure otp is ".$student['code'].". Please do not share your otp with anyone. \n Regards, \n CoachingSelect";
                        $mobile = DB::table('tempstudents')
                                    ->where($field, $value)
                                    ->value('mobile');

                        Helpers::sendTextSmsNew($sms, $mobile);

                        $is_sent = DB::table('tempstudents')
                                    ->where($field, $value)
                                    ->update($student);
                    } elseif($student_or_enterprise == 'enterprise') {
                        
                        $sms = "Your secure otp is ".$student['code'].". Please do not share your otp with anyone. \n Regards, \n CoachingSelect";
                        $mobile = DB::table('tempenterprise')
                                    ->where($field, $value)
                                    ->value('mobile');

                        Helpers::sendTextSmsNew($sms, $mobile);

                        $is_sent = DB::table('tempenterprise')
                                    ->where($field, $value)
                                    ->update($student);
                    }                

                    $error = array();
                    $error['success'] = 1;
                    $error['message'] = 'OTP sent';
                    
                    return $error;

                } else {

                    $error = array();
                    $error['success'] = 0;
                    $error['message'] = 'There is no account with ' . $value;

                    return $error;
                }
            }
        }
    }
}