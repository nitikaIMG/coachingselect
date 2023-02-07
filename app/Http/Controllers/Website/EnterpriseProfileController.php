<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Website\HeaderController;
use App\Http\Controllers\Website\FooterController;

class EnterpriseProfileController extends Controller
{

    public function enterprise_profile() {

        if(
          ! session()->has('enterprise')
        ) {
            return redirect()
                    ->action("Website\IndexController@index")
                    ;
        }
        
        $header = new HeaderController();
        $footer = new FooterController();

        $online_facility = DB::table('facility')
                            ->where('type', 'online')
                            ->where('status', 'enable')
                            ->get();
                            
        $classroom_facility = DB::table('facility')
                            ->where('type', 'classroom')
                            ->where('status', 'enable')
                            ->get();

        $enterprise = session()->get('enterprise');

        $enterprise = DB::table('coaching')
                        ->where('id', $enterprise->id)
                        ->first();
                        
        $enterprise->facility = DB::table('coaching_facility')
                                ->where('coaching_id', $enterprise->id)
                                ->get()
                                ->pluck('name')
                                ->toArray();
    
        session([
            'enterprise' => $enterprise
        ]);

        $states = DB::table('states')
                    ->select('id', 'name')
                    ->where('status', 1)
                    ->get();

        $streams = DB::table('streams')
                        ->select('id', 'name')
                        ->where('status', 'enable')
                        ->get();

        $coaching_courses = DB::table('coaching_courses')
                                ->where('coaching_id', $enterprise->id)
                                ->select('id', 'name')
                                ->where('status', 'enable')
                                ->get();
        $ttlcourses = DB::table('courses')->where('type', 'coaching')
                                    ->where('status','enable')->get();

        $coaching_branches = DB::table('coaching_centers_branches')
                                ->where('coaching_id', $enterprise->id)
                                ->get();

        if( !empty($coaching_branches) ) {
            foreach($coaching_branches as $branch) {
                
                $branch->city = DB::table('coaching_centers')
                                ->where('id', $branch->coaching_centers_id)
                                ->value('name');

                $branch->state = DB::table('cities')
                                    ->where('name', $branch->city)
                                    ->value('state_id');

                $branch->cities = DB::table('cities')
                                    ->where('state_id', $branch->state)
                                    ->get();
                            
                $state = DB::table('states')
                                ->where('id', $branch->state)
                                ->first();

                $country_id = '';

                if(!empty($state)){        
                    $country_id = $state->country_id;

                    $branch->state = $state->name;

                    $branch->country = DB::table('countries')
                                    ->where('id', $country_id)
                                    ->value('name');
                }else{
                    $branch->state ='';
                     $branch->country = '';
                }
                
                $branch->states = DB::table('states')
                                    ->where('country_id', $country_id)
                                    ->get();

                # get country, state from center

            }
        }
        
        $countrys = DB::table('countries')
                ->select('id', 'name')
                ->get();
        
        $coaching_courses_detail = DB::table('coaching_courses_detail')
                                ->where('coaching_id', $enterprise->id)
                                ->get();

        if( !empty($coaching_courses_detail) ) {
            foreach($coaching_courses_detail as $courses_detail) {
                
                $courses_detail->course = DB::table('coaching_courses')
                                            ->where('id', $courses_detail->coaching_courses_id)
                                            ->value('name');

                $courses_detail->stream = DB::table('courses')
                                        ->where('name', $courses_detail->course)
                                        ->value('stream_id');

                $courses_detail->courses = DB::table('courses')
                                            ->where('stream_id', $courses_detail->stream)
                                            ->get();
            }
        }
        
        $coaching_results = DB::table('coaching_results')
                                ->where('coaching_id', $enterprise->id)
                                ->get();
                                
        $coaching_faculty = DB::table('coaching_faculty')
                                ->where('coaching_id', $enterprise->id)
                                ->get();

        $metatitle = "Enterprise Edit Profile | CoachingSelect.com";
                        
        return view('website.enterprise_profile', compact('metatitle','header', 'footer', 'online_facility', 'classroom_facility'
        , 'states', 'streams', 'coaching_courses',
        'coaching_branches', 'coaching_courses_detail',
        'coaching_results', 'coaching_faculty', 'countrys','ttlcourses'
        ));
    }
    
    public function enterprise_profile_update() {
        
        if( request()->isMethod('post') and session()->has('enterprise') ) {

            // send mail
            $this->send_mail();
            
            $input = request()->except(['_token', 'image']); 
            
            // can't update if enabled already
            if ( session()->has('enterprise') 
                    and 
                session()->get('enterprise')->status == 'enable' 
            ) {                    
                return redirect()->back()->with('errorProfile', "You can't update your profile again after approved by the admin");
            }
                        
            if (!request()->file('image')) {
                unset($input['image']);
            } else {

                $file = request('image');

                $thumbnailPath = public_path('coaching/');

                $fileName = 'enterprise-profile-' . time() . random_int(0, 10);

                $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                if ($input['image'] == '') {
                    return redirect()->back()->with('errorProfile', 'invalid image provided');
                }
            }
            
            if ( !empty( request()->get('mobile') ) ) {
                    
                if(!preg_match('/^[0-9]{10}$/', $input['mobile'])) {
                    
                    return redirect()->back()->with('errorProfile', 'Please enter a valid mobile number');

                }
            }
            
            if ( !empty( request()->get('alternative_mobile') ) ) {
                    
                if(!preg_match('/^[0-9]{10}$/', $input['alternative_mobile'])) {
                    
                    return redirect()->back()->with('errorProfile', 'Please enter a valid alternative mobile number');

                }
            }
            
            if ( !empty( request()->get('email') ) ) {
                    
                if( ! filter_var($input['email'], FILTER_VALIDATE_EMAIL) ) {
                    
                    return redirect()->back()->with('errorProfile', 'Please enter a valid email address');

                }
            }

            if( !empty($input['scholarship_yes_or_no']) ) {
                if($input['scholarship_yes_or_no'] == 'no') {
                    
                    $input['scholarship_name'] = '';
                    $input['scholarship'] = '';
                
                }
            }

            if( !empty($input['offering']) ) {
                $input['offering'] = implode(',', $input['offering']);
            } else {
                $input['offering'] = '';
            }

            $facilities = [];
            
            if ( !empty( request()->get('facility_type') ) ) {
                if($input['facility_type'] == 'Online + Classroom') {
                    
                    if( !empty($input['facilities_online_classroom']) ) {
                        $facilities = $input['facilities_online_classroom'];
                    }
                }
    
                else if($input['facility_type'] == 'Classroom (Online)') {
                    
                    if( !empty($input['facilities_online']) ) {
                        $facilities = $input['facilities_online'];
                    }
                }
    
                else if($input['facility_type'] == 'Classroom (Classroom)') {
                    
                    if( !empty($input['facilities_classroom']) ) {
                        $facilities = $input['facilities_classroom'];
                    }
                }
                
                unset(
                    $input['facilities'],
                    $input['facilities_online'],
                    $input['facilities_classroom'],
                    $input['facilities_online_classroom']
                );
            }

            if( !empty($input['name']) ) {
                $coaching_name = $input['name'];

                $is_exists = DB::table('coaching')
                                ->where('id', '!=', session()->get('enterprise')->id)
                                ->where('name', $coaching_name)
                                ->exists();
                    
                if($is_exists) {
                    return redirect()
                                ->back()
                                ->with('errorProfile', 'Coaching Name updated by you is already taken');
                }
            }

            $input['status'] = 'disable';

            DB::table('coaching')
                ->where('id', session()->get('enterprise')->id)
                ->update($input);
                
            $enterprise = DB::table('coaching')
                        ->where('id', session()->get('enterprise')->id)
                        ->first();

            $coaching_id = $enterprise->id;

            $checkdata = DB::table('coaching_facility')->where('coaching_id', $coaching_id)->whereNotIn('name', $facilities)->select('id','name')->get();
            if(!empty($checkdata->toArray())){
                foreach ($checkdata as $value) {
                    DB::table('coaching_facility')->where('id', $value->id)->delete();
                }
            }
                    
            if (!empty($facilities)) {
                foreach ($facilities as $facility) {
                    $checkdata = DB::table('coaching_facility')->where('coaching_id', $coaching_id)->where('name', $facility)->exists();
                    if(empty($checkdata)){
                        $facility_data = array();
                        $facility_data['coaching_id'] = $coaching_id;
                        $facility_data['name'] = $facility;
                        $facility_data['status'] = 'disable';
                        DB::table('coaching_facility')->insert($facility_data);
                    }
                }
            }
            session([
                'enterprise' => $enterprise
            ]);

            return redirect()
                    ->back()
                    ->with('successProfile', 'Profile Updated Successfully');

        } else {
            return redirect()->back();
        }

    }    
    
    public function cities() {
        $state_id = request()->get('state_id');

        $state_id = DB::table('states')
                        ->where('id', $state_id)
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
        
        if( ! session()->has('enterprise') ) {       

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
    
        $user = DB::table('coaching')
                        ->where('id', session()->get('enterprise')->id)
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
                    
            $enterprise = array();
            $enterprise['password'] = Hash::make($new_password);

            $is_changed = DB::table('coaching')
                                ->where('id', session()->get('enterprise')->id)
                                ->update($enterprise);

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
            
    public function stream_course()
    {
        $courses = DB::table('courses')
            ->where('stream_id', request()->get('stream_id'))
            ->where('status','enable')
            ->where('type', 'coaching')
            ->get();

        return $courses;
    }

    public function enterprise_branch_update() {
        
        if( request()->isMethod('post') and session()->has('enterprise') ) {

            // send mail
            $this->send_mail();
            
            $input = request()->except(['_token']);         
            $input['coaching_id'] = session()->get('enterprise')->id; 
            
            if(
                request()->has('branch')
                    and
                ! empty(
                    request()->get('branch')
                )
            ) {  
                                
                $are_not_branches = [];
                $new_branches = [];

                $branches = $input['branch'];

                if (!empty($branches)) {
                    foreach ($branches as $branch) {

                        $city = DB::table('cities');
                        
                        if(
                            is_numeric($branch['city_id'])
                        ) {
                            $city = $city->where('id', $branch['city_id']);
                        } else {                           
                            $city = $city->where('name', $branch['city_id']); 
                        }

                        $city = $city->first();
                        
                        if( empty($city) ) {
                            return redirect()->back()->with('errorProfile', 'City does not exists');
                        }

                        $center_data = array();
                        $center_data['coaching_id'] = $input['coaching_id'];
                        $center_data['name'] = $city->name;

                        $coaching_center = DB::table('coaching_centers')
                                            ->where('coaching_id', $input['coaching_id'])
                                            ->where('name', $city->name)
                                            ->first();

                        if(! empty($coaching_center) ) {   

                            $coaching_centers_id = $coaching_center->id;

                        } else {
                                
                            if( 
                                !empty(
                                    $branch['coaching_centers_id']
                                ) 
                            ) {
                                DB::table('coaching_centers')
                                ->where('id', $branch['coaching_centers_id'])
                                ->delete();
                            }

                            $coaching_centers_id = DB::table('coaching_centers')->insertGetId($center_data);
                        
                        }

                        $branch_data = array();
                        $branch_data['coaching_id'] = $input['coaching_id'];
                        $branch_data['coaching_centers_id'] = $coaching_centers_id;
                        $branch_data['name'] = $branch['name'];
                        $branch_data['address'] = $branch['address'];
                        $branch_data['mobile'] = $branch['mobile'];
                        $branch_data['email'] = $branch['email'];
                        $branch_data['website'] = !empty($branch['website']) ? $branch['website'] : '';
                        $branch_data['twitter'] = !empty($branch['twitter']) ? $branch['twitter'] : '';
                        $branch_data['instagram'] = !empty($branch['instagram']) ? $branch['instagram'] : '';
                        $branch_data['facebook'] = !empty($branch['facebook']) ? $branch['facebook'] : '';
                        $branch_data['youtube'] = !empty($branch['youtube']) ? $branch['youtube'] : '';
                        $branch_data['linkedin'] = !empty($branch['linkedin']) ? $branch['linkedin'] : '';
                        $branch_data['mobile2'] = !empty($branch['mobile2']) ? $branch['mobile2'] : '';
                        $branch_data['landline'] = !empty($branch['landline']) ? $branch['landline'] : '';
                        $branch_data['ownership'] = !empty($branch['ownership']) ? $branch['ownership'] : '';
                        $branch_data['average_intake'] = !empty($branch['average_intake']) ? $branch['average_intake'] : '';                        
                        $branch_data['latitude'] = !empty($branch['latitude']) ? $branch['latitude'] : '';                        
                        $branch_data['longitude'] = !empty($branch['longitude']) ? $branch['longitude'] : '';                        
                     
                        if( 
                            !empty($branch['id']) 
                        ) {

                            $is_exists = DB::table('coaching_centers_branches')
                                        ->where('id', '!=', $branch['id'])
                                        ->where('coaching_id', '=', $input['coaching_id'])
                                        ->where('name', $branch['name'])
                                        ->exists();

                            if ($is_exists) {
                                return back()->with('errorProfile', 'Branch ('.$branch['name'].') already exists');
                            }

                            $are_not_branches[] = $branch['id'];

                            $getCheck= DB::table('coaching_centers_branches')
                                ->where('id', $branch['id'])
                                ->update($branch_data);

                            if($getCheck==1){

                                $this_status = DB::table('coaching_centers_branches')
                                                ->where('id', $branch['id'])
                                                ->value('status');

                                if($this_status == 'disable') {

                                    $branch_data1['status'] = 'disable';

                                    DB::table('coaching_centers_branches')
                                    ->where('id', $branch['id'])
                                    ->update($branch_data1);

                                                            
                                    // update main branch
                                    $is_main_branch = DB::table('coaching_centers_branches')
                                                        ->where('id', $branch['id'])
                                                        ->value('is_main_branch');

                                    if( $is_main_branch ) {

                                        $coaching = array();
                                        
                                        $coaching['state'] = DB::table('states')
                                                            ->where('id', $branch['state_id'])
                                                            ->orwhere('name', $branch['state_id'])
                                                            ->value('name');
                                        $coaching['country'] = DB::table('countries')
                                                            ->where('name', $branch['country_id'])
                                                            ->orwhere('id', $branch['country_id'])
                                                            ->value('name');
                                        $coaching['city'] = DB::table('cities')
                                                            ->where('id', $branch['city_id'])
                                                            ->orwhere('name', $branch['city_id'])
                                                            ->value('name');

                                        $country_id = $coaching['country_id'] = DB::table('countries')
                                                                                ->where('name', $branch['country_id'])
                                                                                ->orwhere('id', $branch['country_id'])
                                                                                ->value('id');

                                        $state_id = $coaching['state_id'] = DB::table('states')
                                                                            ->where('id', $branch['state_id'])
                                                                            ->orwhere('name', $branch['state_id'])
                                                                            ->value('id');

                                        $city_id = $coaching['city_id'] = DB::table('cities')
                                                                            ->where('id', $branch['city_id'])
                                                                            ->orwhere('name', $branch['city_id'])
                                                                            ->value('id');    
                                        
                                        
                                        $coaching['address'] = $branch['address'] ?? '';

                                        $coaching['latitude'] = $branch_data['latitude'];
                                        $coaching['longitude'] = $branch_data['longitude'];
                                        
                                        $coaching['mobile'] = $branch['mobile'];
                                        $coaching['email'] = $branch['email'];

                                        DB::table('coaching')
                                        ->where('id', $input['coaching_id'])
                                        ->update($coaching);
                                    }

                                }
                            }
                        } else {

                            $is_exists = DB::table('coaching_centers_branches')
                                        ->where('coaching_id', '=', $input['coaching_id'])
                                        ->where('name', $branch['name'])
                                        ->exists();

                            if ($is_exists) {
                                return back()->with('errorProfile', 'Branch ('.$branch['name'].') already exists');
                            }

                            $branch_data['status'] = 'disable';
                            $new_branch_id = DB::table('coaching_centers_branches')
                                                ->insertGetId($branch_data);
                        
                            $new_branches[] = $new_branch_id;
                        }
                    }
                }

                if( 
                    ! empty($are_not_branches)
                ) {
                    $branches_to_be_deleted = DB::table('coaching_centers_branches')
                                            ->where('coaching_id', $input['coaching_id'])
                                            ->whereNotIn('id', $are_not_branches);

                    if( 
                        ! empty($are_not_branches)
                    ) {
                        $branches_to_be_deleted = $branches_to_be_deleted
                                                    ->whereNotIn('id', $new_branches);
                    }
                    
                    $branches_to_be_deleted = $branches_to_be_deleted
                                                ->delete();
                }
                                    
                return redirect()
                        ->back()
                        ->with('successProfile', 'Branch Added Successfully');

            }
        } else {
            return redirect()->back();
        }
        
        return redirect()->back();

    }
    
    public function enterprise_courses_update() {
        
        if( request()->isMethod('post') and session()->has('enterprise') ) {

            // send mail
            $this->send_mail();
            
            $input = request()->except(['_token']);         
            $input['coaching_id'] = session()->get('enterprise')->id; 
            
            if(
                request()->has('courses_detail')
                and
                !empty(
                    request()->get('courses_detail')
                )
            ) {    

                $are_not_courses = [];
                $new_courses = [];  
        
                $courses = $input['courses_detail'];

                if (!empty($courses)) {
                    foreach ($courses as $courses_detail) {

                        $course = DB::table('courses')
                                    ->where('id', $courses_detail['course_id'])
                                    ->first();
                        
                        if( empty($course) ) {
                            return redirect()->back()->with('errorProfile', 'Course does not exists');
                        }

                        $course_data = array();
                        $course_data['coaching_id'] = $input['coaching_id'];
                        $course_data['name'] = $course->name;
                        
                        $coaching_course = DB::table('coaching_courses')
                                            ->where('coaching_id', $input['coaching_id'])
                                            ->where('name', $course->name)
                                            ->first();

                        if( !empty($coaching_course) ) {   

                            $coaching_courses_id = $coaching_course->id;

                        } else {

                            if( 
                                !empty(
                                    $courses_detail['coaching_courses_id']
                                ) 
                            ) {
                                DB::table('coaching_courses')
                                ->where('id', $courses_detail['coaching_courses_id'])
                                ->delete();
                            }

                            $coaching_courses_id = DB::table('coaching_courses')->insertGetId($course_data);
                        
                        }
                        
                        unset(
                            $courses_detail['stream_id'],
                            $courses_detail['course_id']
                        );

                        $courses_detail_data = array();
                        $courses_detail_data['coaching_id'] = $input['coaching_id'];
                        $courses_detail_data['coaching_courses_id'] = $coaching_courses_id;
                        $courses_detail_data['offering'] = implode(',', $courses_detail['offering']) ?? '';
                        $courses_detail_data['name'] = $courses_detail['name'] ?? '';
                        $courses_detail_data['targeting'] = $courses_detail['targeting'] ?? '';
                        $courses_detail_data['description'] = $courses_detail['description'] ?? '';
                        $courses_detail_data['duration'] = $courses_detail['duration'] ?? '';

                        if( !empty($courses_detail['batch_details']) ) {
                            $courses_detail_data['batch_details'] = implode(',', $courses_detail['batch_details']);
                        } else {
                            $courses_detail_data['batch_details'] = '';
                        }

                        $courses_detail_data['fee'] = $courses_detail['fee'] ?? 0;
                        $courses_detail_data['registration_fee'] = $courses_detail['registration_fee'] ?? 0;
                        $courses_detail_data['gst_inclusive_exclusive'] = $courses_detail['gst_inclusive_exclusive'] ?? '';
                        $courses_detail_data['fee_type'] = $courses_detail['fee_type'] ?? '';
                        $courses_detail_data['offer_percentage'] = $courses_detail['offer_percentage'] ?? 0;

                        $courses_detail_data['exam_name'] = !empty($courses_detail['exam_name']) ? $courses_detail['exam_name'] : '';
                        
                        $courses_detail_data['is_paid'] = !empty($courses_detail['is_paid']) ? $courses_detail['is_paid'] : '';
                       
                        if( 
                            !empty($courses_detail['id']) 
                        ) {

                            if( 
                                !empty(
                                    $courses_detail['id']
                                ) 
                            ) {

                                $are_not_courses[] = $courses_detail['id'];

                                $getUpdate= DB::table('coaching_courses_detail')
                                    ->where('coaching_id', $input['coaching_id'])
                                    ->where('id', $courses_detail['id'])
                                    ->update($courses_detail_data);

                                if($getUpdate==1){
                                    $courses_detail_data1['status'] = 'disable';
                                    $getUpdate= DB::table('coaching_courses_detail')
                                    ->where('coaching_id', $input['coaching_id'])
                                    ->where('id', $courses_detail['id'])
                                    ->update($courses_detail_data1);
                                }

                            } else {

                                return redirect()
                                        ->back()
                                        ->with('errorProfile', 'This course already exists');
                            }

                        } else {
                            $courses_detail_data['status'] = 'disable';
                            $new_course_id = DB::table('coaching_courses_detail')
                                                ->insertGetId($courses_detail_data);
                        
                            $new_courses[] = $new_course_id;
                        }
                        
                    }
                }

                if( 
                    ! empty($are_not_courses)
                ) {
                    $courses_to_be_deleted = DB::table('coaching_courses_detail')
                                            ->where('coaching_id', $input['coaching_id'])
                                            ->whereNotIn('id', $are_not_courses);

                    if( 
                        ! empty($are_not_courses)
                    ) {
                        $courses_to_be_deleted = $courses_to_be_deleted
                                                    ->whereNotIn('id', $new_courses);
                    }
                    
                    $courses_to_be_deleted = $courses_to_be_deleted
                                                ->delete();
                }
                                        
                return redirect()
                        ->back()
                        ->with('successProfile', 'Course Added Successfully');

            }
        } else {
            return redirect()->back();
        }
        
        return redirect()->back();

    }

    public function enterprise_results_update() {
        
        if( request()->isMethod('post') and session()->has('enterprise') ) {

            // send mail
            $this->send_mail();
            
            $input = request()->except(['_token']);         
            $input['coaching_id'] = session()->get('enterprise')->id; 
            
            if(
                request()->has('results')
                and
                !empty(
                    request()->get('results')
                )
            ) {        

                $are_not_results = [];
                $new_results = [];          

                $results = $input['results'];

                if (!empty($results)) {
                    foreach ($results as $result) {

                        $coaching = DB::table('coaching')
                                    ->where('id', $input['coaching_id'])
                                    ->first();

                        $result_data = array();
                        $result_data['coaching_id'] = $input['coaching_id'];
                        $result_data['coaching_courses_id'] = $result['coaching_courses_id'];
                        $result_data['name'] = $result['name'];
                        $result_data['rank'] = !empty($result['rank']) ? $result['rank'] : '';
                        $result_data['category'] = !empty($result['category']) ? $result['category'] : '';
                        $result_data['year'] = !empty($result['year']) ? $result['year'] : '';
                        $result_data['exam_name'] = !empty($result['exam_name']) ? $result['exam_name'] : '';
                        $result_data['score'] = !empty($result['score']) ? $result['score'] : '';
                        $result_data['branch_name'] = !empty($result['branch_name']) ? $result['branch_name'] : '';
                        $result_data['testimonial'] = !empty($result['testimonial']) ? $result['testimonial'] : '';
                        

                        if(session()->get('enterprise')->est_yr > $result_data['year']) {
                            return redirect()
                                    ->back()
                                    ->with('errorProfile', 'Year must be greater than est year');
                        }

                        if(
                            !empty($result['image'])
                        ) {

                            $image = '';

                            $file = $result['image'];

                            $thumbnailPath = public_path('coaching_results/');

                            $fileName = 'coaching_results-' . time() . random_int(0, 10);

                            $result_data['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                            if ($result_data['image'] == '') {
                                return redirect()->back()->with('errorProfile', 'invalid image provided');
                            }
                        } else {
                            unset(
                                $result['image']
                            );
                        }

                        if( 
                            !empty($result['id']) 
                        ) {

                            if( 
                                !empty(
                                    $result['id']
                                ) 
                            ) {

                                $are_not_results[] = $result['id'];

                                $getUpdate= DB::table('coaching_results')
                                    ->where('coaching_id', $input['coaching_id'])
                                    ->where('id', $result['id'])
                                    ->update($result_data);
                                if($getUpdate==1){
                                    $result_data1['status'] = 'disable';
                                    DB::table('coaching_results')
                                    ->where('coaching_id', $input['coaching_id'])
                                    ->where('id', $result['id'])
                                    ->update($result_data1);
                                }
                            } else {

                                return redirect()
                                        ->back()
                                        ->with('errorProfile', 'This result already exists');
                            }

                        } else {
                            $result_data['status'] = 'disable';
                            $new_result_id = DB::table('coaching_results')
                                                ->insertGetId($result_data);
                        
                            $new_results[] = $new_result_id;
                        }

                        if( !empty($result['testimonial']) ) {

                            $testimonial_data = array();
                            $testimonial_data['coaching_id'] = $input['coaching_id'];
                            $testimonial_data['coaching_courses_id'] = $result['coaching_courses_id'];
                            $testimonial_data['name'] = $result['name'];
                            $testimonial_data['rank'] = !empty($result['rank']) ? $result['rank'] : '';
                            $testimonial_data['category'] = !empty($result['category']) ? $result['category'] : '';
                            $testimonial_data['year'] = !empty($result['year']) ? $result['year'] : '';
                            $testimonial_data['description'] = !empty($result['testimonial']) ? $result['testimonial'] : '';

                            $testimonial_data['status'] = 'disable';

                            if(
                                !empty($result['image'])
                            ) {
                                $image = '';

                                $file = $result['image'];

                                $thumbnailPath = public_path('coaching_testimonials/');

                                $fileName = 'coaching_testimonials-' . time() . random_int(0, 10);

                                $testimonial_data['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                                if ($testimonial_data['image'] == '') {
                                    return redirect()->back()->with('errorProfile', 'invalid image provided');
                                }
                            }

                            DB::table('coaching_testimonials')->insert($testimonial_data);
                        }
                    }
                }

                if( 
                    ! empty($are_not_results)
                ) {
                    $results_to_be_deleted = DB::table('coaching_results')
                                            ->where('coaching_id', $input['coaching_id'])
                                            ->whereNotIn('id', $are_not_results);

                    if( 
                        ! empty($are_not_results)
                    ) {
                        $results_to_be_deleted = $results_to_be_deleted
                                                    ->whereNotIn('id', $new_results);
                    }
                    
                    $results_to_be_deleted = $results_to_be_deleted
                                                ->delete();
                }
                                        
                return redirect()
                        ->back()
                        ->with('successProfile', 'Result Added Successfully');

            }
        } else {
            return redirect()->back();
        }
        
        return redirect()->back();

    }

    public function enterprise_faculty_update() {
        
        if( request()->isMethod('post') and session()->has('enterprise') ) {

            // send mail
            $this->send_mail();
            
            $input = request()->except(['_token']);         
            $input['coaching_id'] = session()->get('enterprise')->id; 
            
            if(
                request()->has('faculty')
                and
                !empty(
                    request()->get('faculty')
                )
            ) {     
                
                $are_not_faculty = [];
                $new_faculty = [];               

                $faculties = $input['faculty'];

                if (!empty($faculties)) {
                    foreach ($faculties as $faculty) {
                        $faculty_data = array();
                        $faculty_data['coaching_id'] = $input['coaching_id'];
                        $faculty_data['name'] = $faculty['name'];
                        $faculty_data['designation'] = $faculty['designation'];
                        $faculty_data['education'] = $faculty['education'];
                        $faculty_data['experience'] = $faculty['experience'];
                        $faculty_data['link'] = $faculty['link'];
                        $faculty_data['subject'] = $faculty['subject'];

                        if(
                            !empty($faculty['image'])
                        ) {
                            $image = '';

                            $file = $faculty['image'];

                            $thumbnailPath = public_path('coaching_faculty/');

                            $fileName = 'coaching_faculty-' . time() . random_int(0, 10);

                            $faculty_data['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                            if ($faculty_data['image'] == '') {
                                return redirect()->back()->with('errorProfile', 'invalid image provided');
                            }
                        } else {
                            unset(
                                $faculty['image']
                            );
                        }
                        
                       

                        # check if already exists
                        if(!empty($faculty['id'])){
                            $is_already_exists = DB::table('coaching_faculty')
                                                ->where('id', $faculty['id'])->first();
                            if(!empty($is_already_exists)) {
                                $are_not_faculty[] = $is_already_exists->id;
                                $getStatus= DB::table('coaching_faculty')->where('id',$is_already_exists->id)->update($faculty_data);
                                if($getStatus==1){
                                    $faculty_data1['status'] = 'disable';
                                    DB::table('coaching_faculty')->where('id',$is_already_exists->id)->update($faculty_data1);

                                }
                                
                            }   
                        }else{
                             $faculty_data['status'] = 'disable';
                            $new_faculty_id = DB::table('coaching_faculty')
                                                ->insertGetId($faculty_data);
                            $new_faculty[] = $new_faculty_id;
                        }
                                                
                    }
                }

                if(!empty($are_not_faculty)) {
                    $faculty_to_be_deleted = DB::table('coaching_faculty')
                                            ->where('coaching_id', $input['coaching_id'])
                                            ->whereNotIn('id', $are_not_faculty);

                    if(!empty($are_not_faculty)) {
                        $faculty_to_be_deleted = $faculty_to_be_deleted->whereNotIn('id', $new_faculty);
                    }
                    
                    $faculty_to_be_deleted = $faculty_to_be_deleted
                                                ->delete();
                                                
                }
                                        
                return redirect()
                        ->back()
                        ->with('successProfile', 'Faculty Added Successfully');

            }
        } else {
            return redirect()->back();
        }
        
        return redirect()->back();

    }

    public function become_prime_member() {
        
        if( request()->isMethod('post') and session()->has('enterprise') ) {

            if(
                session()->get('enterprise')->is_paid_member == 'request'
            ) {
                return redirect()
                        ->back()
                        ->with('error', 'You have already requested to become a prime member');
            }

            if(
                session()->get('enterprise')->is_paid_member == 'yes'
            ) {
                return redirect()
                        ->back()
                        ->with('error', 'You are already our prime member');
            }

            $input = array();
            $input['is_paid_member'] = 'request';

            DB::table('coaching')
                ->where('id', session()->get('enterprise')->id)
                ->update($input);
                
            $enterprise = DB::table('coaching')
                            ->where('id', session()->get('enterprise')->id)
                            ->first();

            session([
                'enterprise' => $enterprise
            ]);
            
            try {
  
                // send mail
                
                $coaching = $enterprise;
                            
                $email = $coaching->email;
                
                $coaching_name = $coaching->name;
                        
                $subject = 'Your request for a Prime Member on CoachingSelect';
                
                if( !empty($email) ) {
                        
                    $datamessage['email']=$email;
            		$datamessage['subject']=$subject;
            		
            	    \Mail::send('mails.prime_member_request', compact('coaching_name'), function ($m) use ($datamessage){
            			$m->from('support@coachingselect.com', 'CoachingSelect');
            			$m->to($datamessage['email'])->subject($datamessage['subject']);
            		});
            		
                }
                                
            } catch(\Exception $e) {
                // ignore mail error
            }
                
            return redirect()
                    ->back()
                    ->with('success', 'Your request to become a prime member has been submitted Successfully');

        } else {
            return redirect()->back();
        }

    }

    public function select_plan() {
        
        if( request()->isMethod('post') and session()->has('enterprise') ) {

            $input = array();
            $input['plan_id'] = request()->get('id');
            $input['coaching_id'] = session()->get('enterprise')->id;

            DB::table('coaching_plan_request')
            ->insert($input);
            
            try {
  
                // send mail
                
                $coaching = DB::table('coaching')
                            ->where('id', $input['coaching_id'])
                            ->first();
                            
                $email = $coaching->email;
                
                $coaching_name = $coaching->name;
                        
                $subject = 'Your request for a plan on CoachingSelect';
                
                if( !empty($email) ) {
                        
                    $datamessage['email']=$email;
            		$datamessage['subject']=$subject;
            		
            	    \Mail::send('mails.plan_request', compact('coaching_name'), function ($m) use ($datamessage){
            			$m->from('support@coachingselect.com', 'CoachingSelect');
            			$m->to($datamessage['email'])->subject($datamessage['subject']);
            		});
            		
                }
                                
            } catch(\Exception $e) {
                // ignore mail error
            }
                                
            return redirect()
                    ->action('Website\IndexController@thank_you_2', 'Thank you for showing interest in CoachingSelect Enterprise Plans');
                    
        } else {
            return redirect()->back();
        }

    }
    
    public function send_mail() {
        
        try {

            // send mail
            $email = session()->get('enterprise')->email;
                    
            $coaching_name = session()->get('enterprise')->name;
             
            $subject = $coaching_name.', your coaching information added';
    
            if( !empty($email) ) {
                    
                $datamessage['email']=$email;
        		$datamessage['subject']=$subject;
        		
        	    \Mail::send('mails.enterprise_information_added', compact('coaching_name'), function ($m) use ($datamessage){
        			$m->from('support@coachingselect.com', 'CoachingSelect');
        			$m->to($datamessage['email'])->subject($datamessage['subject']);
        		});
        		
            }
                            
        } catch(\Exception $e) {
            // ignore mail error
        }
    }
}

