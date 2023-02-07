<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

use App\Helpers\Helpers;

class RegisterController extends Controller
{

    public function tempregister() {

        $name = request()->get('name');
        $email = request()->get('email');
        $mobile = request()->get('mobile');
        $password = request()->get('password');

        if( empty($name) ) {

            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Name is required';

            return $error;
        }
        
        if( empty($email) ) {

            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Email is required';

            return $error;

        } else {

            $is_already_with_email = DB::table('students')
                                        ->where('email', $email)
                                        ->exists();

            if($is_already_with_email) {
                
                $error = array();
                $error['success'] = 0;
                $error['message'] = 'This email already exists';

                return $error;
            }
        }
        
        if( empty($mobile) ) {

            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Mobile is required';

            return $error;

        } else {

            $is_already_with_mobile = DB::table('students')
                                        ->where('mobile', $mobile)
                                        ->exists();

            if($is_already_with_mobile) {

                $error = array();
                $error['success'] = 0;
                $error['message'] = 'This mobile already exists';

                return $error;
            }
        }
        
        if( empty($password) ) {

            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Password is required';

            return $error;            
        }

        $student = array();
        $student['name'] = $name;
        $student['mobile'] = $mobile;
        $student['email'] = $email;
        $student['password'] = Hash::make($password);
        // $student['code'] = 1234;
        $student['code'] = rand(1000, 9999);
    
        $sms = "Your secure otp is ".$student['code'].". Please do not share your otp with anyone. \n Regards, \n CoachingSelect";
        $mobile = $mobile;

        Helpers::sendTextSmsNew($sms, $mobile);

        DB::table('tempstudents')
            ->where('mobile', $mobile)
            ->orWhere('email', $email)
            ->delete();

        $is_registered = DB::table('tempstudents')
                            ->insert($student);

        if( !empty($is_registered) ) {

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

    public function register() {

        $mobile = request()->get('mobile');
        $otp = request()->get('otp');

        $otp = implode('', $otp);

        if( empty($otp) ) {
            
            $error = array();
            $error['success'] = 0;
            $error['message'] = 'OTP is required';

            return $error;

        }
        
        if( empty($mobile) ) {            
            
            $error = array();
            $error['success'] = 0;
            $error['message'] = 'Mobile is required';

            return $error;
            
        } else {
            $is_already_with_mobile = DB::table('students')
                                        ->where('mobile', $mobile)
                                        ->exists();

            if($is_already_with_mobile) {
                            
                $error = array();
                $error['success'] = 0;
                $error['message'] = 'This mobile already exists';

                return $error;

            } 
        }
        
        $is_correct_otp = DB::table('tempstudents')
                            ->where('mobile', $mobile)
                            ->where('code', $otp)
                            ->first();

        if( !empty($is_correct_otp) ){

            $student = array();
            $student['name'] = $is_correct_otp->name;
            $student['mobile'] = $is_correct_otp->mobile;
            $student['email'] = $is_correct_otp->email;
            $student['password'] = $is_correct_otp->password;

            $is_registered = DB::table('students')
                                ->insert($student);

            if( !empty($is_registered) ) {

                DB::table('tempstudents')
                    ->where('mobile', $mobile)
                    ->delete();
                $is_exists = DB::table('students')->where('mobile',$student['mobile'])->first();
                if(!empty($is_exists)){
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