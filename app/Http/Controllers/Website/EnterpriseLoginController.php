<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Hash;
use DB;

use App\Http\Controllers\Website\HeaderController;
use App\Http\Controllers\Website\FooterController;

use App\Helpers\Helpers;

class EnterpriseLoginController extends Controller
{

    public function login() {

        if(
           ! request()->ajax()
        ) {
            if(
                session()->has('enterprise')
            ) {
                
                return redirect()
                            ->action('Website\EnterpriseController@index');

            }
        }

        if(
            request()->isMethod('GET')
        ) {
                
            $header = new HeaderController();
            $footer = new FooterController();
            
            return redirect()
                        ->action('Website\IndexController@index');
             
        } else {

            $email = request()->get('email');
            $password = request()->get('password');

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

            $is_exists = DB::table('coaching')
                        ->where('status', 'enable');

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

                session()->forget('student');

                session([
                    'enterprise' => $is_exists
                ]);

                $error = array();
                $error['success'] = 1;
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
        session()->forget('enterprise');

        return redirect()
                    ->back();
                    
    }

    public function forgot() {

        if(
            request()->isMethod('GET')
        ) {
                
            $header = new HeaderController();
            $footer = new FooterController();
            
            abort(404);

            return view('website.enterprise.forgot', compact('header', 'footer'));

        } else {

            $mobile = request()->get('mobile');
            
            if( empty($mobile) ) {

                $error = array();
                $error['success'] = 0;
                $error['message'] = 'Mobile is required';

                return $error;

            } else {

                $is_already_with_mobile = DB::table('coaching')
                                            ->where('mobile', $mobile)
                                            ->exists();

                if($is_already_with_mobile) {
                            
                    $enterprise = array();
                    // $enterprise['code'] = 1234;
                    $enterprise['code'] = rand(1000, 9999);

                    $sms = "Your secure otp is ".$enterprise['code'].". Please do not share your otp with anyone. \n Regards, \n CoachingSelect";
                    $mobile = DB::table('coaching')
                                ->where('mobile', $mobile)
                                ->value('mobile');

                    Helpers::sendTextSmsNew($sms, $mobile);

                    $is_sent = DB::table('coaching')
                                        ->where('mobile', $mobile)
                                        ->update($enterprise);

                        session([
                            'forgot_email' => $mobile
                        ]);

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
    }

    public function change() {

        if(
            request()->isMethod('GET')
        ) {

            if( session()->has('forgot_email') ) {
                
                $header = new HeaderController();
                $footer = new FooterController();

                return view('website.enterprise.change', compact('header', 'footer'));
            
            } else {
                return redirect()->action('Website\EnterpriseLoginController@forgot')->with('error', 'Please send OTP first');
            }

        } else {

            $mobile = request()->get('mobile');
            $password = request()->get('password');
            $confirm_password = request()->get('confirm_password');

            $otp = request()->get('forgot-otp');
            $otp = implode('', $otp);
            
            if( empty($mobile) ) {

                $error = array();
                $error['success'] = 0;
                $error['message'] = 'Mobile is required';

                return $error;

            } else {

                $is_already_with_mobile = DB::table('coaching')
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
                            
                    $enterprise = array();
                    $enterprise['password'] = Hash::make($password);

                    $is_changed = DB::table('coaching')
                                        ->where('mobile', $mobile)
                                        ->update($enterprise);

                    if( $is_changed ) {

                        $enterprise = DB::table('coaching')
                                    ->where('mobile', $mobile)
                                    ->first();

                        session()->forget('student');

                        session([
                            'enterprise' => $enterprise
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
    }
}
