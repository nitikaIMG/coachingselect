<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use Log;

use Socialite;

use App\Helpers\Helpers;

class EnterpriseSocialLoginController extends Controller
{

    public function redirect($provider) {
        
        $callback = action('Website\EnterpriseSocialLoginController@callback', $provider);
        
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

            $is_exists = DB::table('coaching')
                        ->leftjoin('enterprise', 'coaching.email', 'enterprise.email')
                        ->where('enterprise.email', $email)
                        ->orWhere('coaching.email', $email)
                        ->orWhere('enterprise.mobile', $mobile)
                        ->orWhere('coaching.mobile', $mobile)
                        ->select('coaching.*')
                        ->first();

            if($is_exists) {

                session()->forget('student');

                session([
                    'enterprise' => $is_exists
                ]);

                return redirect($_SESSION['previous']);

            } else {

                $enterprise = array();
                $enterprise['name'] = $name;
                $enterprise['mobile'] = $mobile;
                $enterprise['email'] = $email;
                $enterprise['password'] = '';
                $enterprise['status'] = 'approved';
                
                
                DB::table('tempenterprise')
                        ->where('mobile', $mobile)
                        ->delete();
                        
                DB::table('tempenterprise')
                        ->where('email', $email)
                        ->delete();


                $is_created = DB::table('tempenterprise')
                                ->insert($enterprise);

                if($is_created) {

                    $enterprise = DB::table('tempenterprise')
                                ->where('email', $email)
                                ->first();

                    session()->forget('student');
                    session()->forget('enterprise');

                    session([
                        'tempenterprise' => $enterprise
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

    public function enterprise_mobile_verify() {

        $mobile = request()->get('mobile');
        
        if(! session()->has('tempenterprise') ) {

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

            $is_already_with_email = DB::table('enterprise')
                                        ->where('mobile', $mobile)
                                        ->exists();

            if($is_already_with_email) {
                        
                $error = array();
                $error['success'] = 0;
                $error['message'] = 'This mobile number is already taken';

                return $error;
                
            } else {

                $enterprise = array();
                $enterprise['code'] = rand(1000, 9999);
                $enterprise['mobile'] = $mobile;
                
                $is_sent = DB::table('tempenterprise')
                                    ->where('id', session()->get('tempenterprise')->id)
                                    ->update($enterprise);

                $sms = "Your secure otp is ".$enterprise['code'].". Please do not share your otp with anyone. \n Regards, \n CoachingSelect";
                $mobile = DB::table('tempenterprise')
                            ->where('id', session()->get('tempenterprise')->id)
                            ->value('mobile');

                Helpers::sendTextSmsNew($sms, $mobile);

                $error = array();
                $error['success'] = 1;
                $error['message'] = 'OTP sent';

                return $error;
            }
        }
    }

    public function enterprise_mobile_verify_otp() {

        $mobile = request()->get('mobile');
        
        $otp = request()->get('enterprise_mobile_verify-otp');
        $otp = implode('', $otp);
        
        if(! session()->has('tempenterprise') ) {

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

            $is_already_with_email = DB::table('enterprise')
                                        ->where('mobile', $mobile)
                                        ->exists();

            if($is_already_with_email) {
                        
                $error = array();
                $error['success'] = 0;
                $error['message'] = 'This mobile number is already taken';

                return $error;
                
            } else {
                    
                $is_already_with_mobile = DB::table('tempenterprise')
                                            ->where('mobile', $mobile)
                                            ->where('code', $otp)
                                            ->first();
    
                if($is_already_with_mobile) {
                            
                    $enterprise = array();
                    $enterprise['name'] = $is_already_with_mobile->name;
                    $enterprise['mobile'] = $is_already_with_mobile->mobile;
                    $enterprise['email'] = $is_already_with_mobile->email;
                    $enterprise['password'] = '';
                    $enterprise['status'] = 'approved';
    
                    $is_registered = DB::table('enterprise')
                                        ->insert($enterprise);
    
                    if( !empty($is_registered) ) {
    
                        DB::table('tempenterprise')
                            ->where('mobile', $mobile)
                            ->delete();
    
                        DB::table('coaching')
                        ->insert($enterprise);

                        $is_exists = DB::table('coaching')->where('mobile',$enterprise['mobile'])->first();
                        
                        if(!empty($is_exists)){
                            session()->forget('tempenterprise');
                            session()->forget('student');
    
                            session([
                                'enterprise' => $is_exists
                            ]);
                        }
                        
                        try {
                    
                            // send mail
                            $email = $is_exists->email;
                            
                            $subject = $is_exists->name.', Welcome to CoachingSelect';
                    
                            if( !empty($email) ) {
                                    
                                $datamessage['email']=$email;
                        		$datamessage['subject']=$subject;
                        		
                        		$coaching = $is_exists;
                        		
                        	    \Mail::send('mails.coaching_signup', compact('coaching'), function ($m) use ($datamessage){
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
