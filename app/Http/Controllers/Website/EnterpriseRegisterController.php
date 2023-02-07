<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

use App\Helpers\Helpers;

class EnterpriseRegisterController extends Controller
{

    public function tempregister() {

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

            $countries = DB::table('countries')
                            ->select('id', 'name')
                            ->get();
                            
            return redirect()
                        ->action('Website\IndexController@index')
                        ->with('error', 'Please register with the popup');

        } else {
                
            $name = request()->get('name');
            $email = request()->get('email');
            $mobile = request()->get('mobile');
            $password = request()->get('password');
            $decrypted_password = $password;
            $address = request()->get('address');
            
            $latitude = request()->get('latitude');
            $longitude = request()->get('longitude');
            
            $country = request()->get('country');
            $state = request()->get('state');
            $city = request()->get('city');
            $url = request()->get('url');

            if( 
                empty($name) or 
                empty($email) or 
                empty($mobile) or 
                empty($password) or 
                empty($address) or 
                empty($country) or 
                empty($state) or 
                empty($city) 
            ) {

                $error = array();
                $error['success'] = 0;
                $error['message'] = 'Please fill out required fields and accept our terms and conditions';

                return $error;
            }
            
            if( empty($name) ) {

                $error = array();
                $error['success'] = 0;
                $error['message'] = 'Name is required';

                return $error;
            } else {

                $is_already_with_name = DB::table('enterprise')
                                            ->join('coaching', 'coaching.name', 'enterprise.name')
                                            ->where('enterprise.name', $name)
                                            ->orWhere('coaching.name', $name)
                                            ->exists();

                if($is_already_with_name) {
                    
                    $error = array();
                    $error['success'] = 0;
                    $error['message'] = 'This name already exists';

                    return $error;
                }
            }
            
            if( empty($email) ) {

                $error = array();
                $error['success'] = 0;
                $error['message'] = 'Email is required';

                return $error;

            } else {

                $is_already_with_email = DB::table('enterprise')
                                            ->join('coaching', 'coaching.email', 'enterprise.email')
                                            ->where('enterprise.email', $email)
                                            ->orWhere('coaching.email', $email)
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

                $is_already_with_mobile = DB::table('enterprise')
                                            ->join('coaching', 'coaching.mobile', 'enterprise.mobile')
                                            ->where('enterprise.mobile', $mobile)
                                            ->orWhere('coaching.mobile', $mobile)
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
            } else {

            }

            $enterprise = array();
            $enterprise['name'] = $name;
            $enterprise['mobile'] = $mobile;
            $enterprise['email'] = $email;
            $enterprise['address'] = $address;
            $enterprise['country'] = $country;
            
            $enterprise['state'] = $state;
            $enterprise['city'] = $city;
            
            $enterprise['state'] = DB::table('states')
                                    ->where('id', $state)
                                    ->orWhere('name', $state)
                                    ->value('name');
                                    
            $enterprise['city'] = DB::table('cities')
                                    ->where('id', $city)
                                    ->orWhere('name', $city)
                                    ->value('name');
                                    
            $enterprise['password'] = Hash::make($password);
            $enterprise['decrypted_password'] = $decrypted_password;
            // $enterprise['code'] = 1234;
            $enterprise['code'] = rand(1000, 9999);

            $sms = "Your secure otp is ".$enterprise['code'].". Please do not share your otp with anyone. \n Regards, \n CoachingSelect";
            $mobile = $mobile;

            Helpers::sendTextSmsNew($sms, $mobile);

            $enterprise['latitude'] = $latitude;
            $enterprise['longitude'] = $longitude;
            
            DB::table('tempenterprise')
                ->where('mobile', $mobile)
                ->orWhere('email', $email)
                ->delete();

            $is_registered = DB::table('tempenterprise')
                                ->insert($enterprise);

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
            $is_already_with_mobile = DB::table('enterprise')
                                        ->where('mobile', $mobile)
                                        ->exists();

            if($is_already_with_mobile) {
                            
                $error = array();
                $error['success'] = 0;
                $error['message'] = 'This mobile already exists';

                return $error;

            } 
        }
        
        $is_correct_otp = DB::table('tempenterprise')
                            ->where('mobile', $mobile)
                            ->where('code', $otp)
                            ->first();

        if( !empty($is_correct_otp) ){

            $enterprise = (array) $is_correct_otp;
            
            unset(
                $enterprise['id'],
                $enterprise['created_at'],
                $enterprise['updated']
            );

            $enterprise['status'] = 'approved';

            $is_registered = DB::table('enterprise')
                                ->insert($enterprise);

            if( !empty($is_registered) ) {

                DB::table('tempenterprise')
                    ->where('mobile', $mobile)
                    ->delete();

                $is_exists = DB::table('enterprise')->where('mobile',$enterprise['mobile'])->first();
                
                if(!empty($is_exists)){
                    session()->forget('student');
                    
                    session([
                        'enterprise' => $is_exists
                    ]);
                }

                $error = array();

                $this->approved($is_exists->id);

                $error['success'] = 1;
                $error['message'] = 'Login successfully';

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
            $error['message'] = 'OTP is invalid';

            return $error;
        }
    }

    public function approved($enterprise_id) {
        
        $enterprise = DB::table('enterprise')
                        ->where('id', $enterprise_id)
                        ->first();

        $enterprise = (array) $enterprise;
        
        unset(
            $enterprise['id'],
            $enterprise['created_at'],
            $enterprise['updated'],
            $enterprise['status']
        );
        
        $is_already_exists = DB::table('coaching')
                        ->where('name', $enterprise['name'])
                        ->where('email', $enterprise['email'])
                        ->where('mobile', $enterprise['mobile'])
                        ->exists();
            
        if($is_already_exists) {

            return 0;

        } else {

            $enterprise['country_id'] = DB::table('countries')
                                        ->where('name', $enterprise['country'])
                                        ->value('id');

            $enterprise['state_id'] = DB::table('states')
                                        ->where('name', $enterprise['state'])
                                        ->value('id');

            $enterprise['city_id'] = DB::table('cities')
                                        ->where('name', $enterprise['city'])
                                        ->value('id');

            $enterprise['status'] = 'approved';

            $enterprise['coaching_id'] =  DB::table('coaching')
                                    ->insertGetId($enterprise);

            $coaching_registered = DB::table('coaching')
                                    ->where('id', $enterprise['coaching_id'])
                                    ->first();

            session([
                'enterprise' => $coaching_registered
            ]);
               
               
            try {
                    
                // send mail
                $email = $coaching_registered->email;
                
                $subject = $coaching_registered->name.', Welcome to CoachingSelect';
        
                if( !empty($email) ) {
                        
                    $datamessage['email']=$email;
            		$datamessage['subject']=$subject;
            		
            		$coaching = $coaching_registered;
            		
            	    \Mail::send('mails.coaching_signup', compact('coaching'), function ($m) use ($datamessage){
            			$m->from('support@coachingselect.com', 'CoachingSelect');
            			$m->to($datamessage['email'])->subject($datamessage['subject']);
            		});
            		
                }
                
            } catch(\Exception $e) {
                // ignore mail error
            }
            
            if( !empty($enterprise['country']) and !empty($enterprise['city']) and !empty($enterprise['state'])) {
                
                # add first branch of this coaching
                $city = DB::table('cities')
                            ->where('name', $enterprise['city'])
                            ->first();

                if( !empty($city) ) {
                
                    $center_data = array();
                    $center_data['coaching_id'] = $enterprise['coaching_id'];
                    $center_data['name'] = $city->name;

                    $coaching_center = DB::table('coaching_centers')
                                        ->where('coaching_id', $enterprise['coaching_id'])
                                        ->where('name', $city->name)
                                        ->first();

                    if( !empty($coaching_center) ) {   

                        $coaching_centers_id = $coaching_center->id;

                    } else {

                        $coaching_centers_id = DB::table('coaching_centers')->insertGetId($center_data);
                    
                    }

                    $branch_data = array();                    
                    $branch_data['is_main_branch'] = 1;
                    $branch_data['coaching_id'] = $enterprise['coaching_id'];
                    $branch_data['coaching_centers_id'] = $coaching_centers_id;
                    $branch_data['name'] = $enterprise['name'];
                    $branch_data['address'] = !empty($enterprise['address']) ? $enterprise['address'] : '';
                    $branch_data['email'] = !empty($enterprise['email']) ? $enterprise['email'] : '';
                    $branch_data['mobile'] = !empty($enterprise['mobile']) ? $enterprise['mobile'] : '';
                    $branch_data['website'] = !empty($enterprise['website']) ? $enterprise['website'] : '';
                    $branch_data['twitter'] = !empty($enterprise['twitter']) ? $enterprise['twitter'] : '';
                    $branch_data['instagram'] = !empty($enterprise['instagram']) ? $enterprise['instagram'] : '';
                    $branch_data['facebook'] = !empty($enterprise['facebook']) ? $enterprise['facebook'] : '';
                    $branch_data['youtube'] = !empty($enterprise['youtube']) ? $enterprise['youtube'] : '';
                    $branch_data['linkedin'] = !empty($enterprise['linkedin']) ? $enterprise['linkedin'] : '';
                    $branch_data['latitude'] = !empty($enterprise['latitude']) ? $enterprise['latitude'] : '';
                    $branch_data['longitude'] = !empty($enterprise['longitude']) ? $enterprise['longitude'] : '';
                    
                    $is_already_exists = DB::table('coaching_centers_branches')
                                        ->where('coaching_id', $enterprise['coaching_id'])
                                        ->where('coaching_centers_id', $coaching_centers_id)
                                        ->where('name', $enterprise['name'])
                                        ->exists();

                    if($is_already_exists) {

                        return 0;
                    }

                    DB::table('coaching_centers_branches')->insert($branch_data);    
                }
            }

            return 1;
        }

    }

}