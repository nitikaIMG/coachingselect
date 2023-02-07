<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;
use Session;

class CoachingController extends Controller
{
    public function add_coaching()
    {
        $input = request()->except('_token');

        if (request()->isMethod('get')) {
            
            $allcountry = DB::table('countries')
                        ->select('id', 'name')
                        ->get();
            return view('coaching.add_coaching',compact('allcountry'));
        } else {

            $is_exists = DB::table('coaching')
                ->where('name', $input['name'])
                ->exists();

            if ($is_exists) {
                return back()->with('error', 'A coaching already exists with this name');
            }

            if (empty(request('image'))) {
                $input['image'] = '';
            } else {
                $image = '';

                $file = request('image');

                $thumbnailPath = public_path('coaching/');

                $fileName = 'coaching-' . time() . random_int(0, 10);

                $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                if ($input['image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }
            }
            
            if( !empty($input['offering']) ) {

                $input['offering'] = implode(',', $input['offering']);
            } else {
                return redirect()->back()->with('error', 'offering is required');
            }

            $des_pass = $input['password'];

            $country_id = $input['country_id'] ?? '';

            $state_id = $input['state_id'] ?? '';

            $city_id = $input['city_id'] ?? '';

            $address = $input['address'] ?? '';

            $input['country_id'] = $input['country_id'] ?? '';

            $input['state_id'] = $input['state_id'] ?? '';

            $input['city_id'] = $input['city_id'] ?? '';

            $input['address'] = $input['address'] ?? '';

            $input['country'] = DB::table('countries')
                                ->where('id', $country_id)
                                ->value('name');
                                
            $input['state'] = DB::table('states')
                                ->where('id', $state_id)
                                ->value('name');

            $input['city'] = DB::table('cities')
                                ->where('id', $city_id)
                                ->value('name');
            
            $input['decrypted_password'] = $des_pass;

            $input['password'] = Hash::make($input['password']);

            $input['added_from'] = 'admin';


            $input['coaching_id'] = DB::table('coaching')->insertGetId($input);

            if( !empty($input['country']) and !empty($input['city']) and !empty($input['state'])) {

                # add first branch of this coaching
                $city = DB::table('cities')
                            ->where('name', $input['city'])
                            ->first();

                if( !empty($city) ) {
                
                    $center_data = array();
                    $center_data['coaching_id'] = $input['coaching_id'];
                    $center_data['name'] = $city->name;

                    $coaching_center = DB::table('coaching_centers')
                                        ->where('coaching_id', $input['coaching_id'])
                                        ->where('name', $city->name)
                                        ->first();

                    if( !empty($coaching_center) ) {   

                        $coaching_centers_id = $coaching_center->id;

                    } else {

                        $coaching_centers_id = DB::table('coaching_centers')->insertGetId($center_data);
                    
                    }

                    $branch_data = array();                    
                    $branch_data['is_main_branch'] = 1;
                    $branch_data['coaching_id'] = $input['coaching_id'];
                    $branch_data['coaching_centers_id'] = $coaching_centers_id;
                    $branch_data['name'] = $input['name'];
                    $branch_data['address'] = !empty($input['address']) ? $input['address'] : '';
                    $branch_data['email'] = !empty($input['email']) ? $input['email'] : '';
                    $branch_data['mobile'] = !empty($input['mobile']) ? $input['mobile'] : '';
                    $branch_data['website'] = !empty($input['website']) ? $input['website'] : '';
                    $branch_data['twitter'] = !empty($input['twitter']) ? $input['twitter'] : '';
                    $branch_data['instagram'] = !empty($input['instagram']) ? $input['instagram'] : '';
                    $branch_data['facebook'] = !empty($input['facebook']) ? $input['facebook'] : '';
                    $branch_data['youtube'] = !empty($input['youtube']) ? $input['youtube'] : '';
                    $branch_data['linkedin'] = !empty($input['linkedin']) ? $input['linkedin'] : '';
                    $branch_data['latitude'] = !empty($input['latitude']) ? $input['latitude'] : '';
                    $branch_data['longitude'] = !empty($input['longitude']) ? $input['longitude'] : '';
                    
                    $is_already_exists = DB::table('coaching_centers_branches')
                                        ->where('coaching_id', $input['coaching_id'])
                                        ->where('name', $input['name'])
                                        ->exists();

                    if($is_already_exists) {
                        return redirect()
                                ->back()
                                ->with('error', 'This branch already exists');
                    }

                    DB::table('coaching_centers_branches')->insert($branch_data);    
                }
            }
            
            return redirect()->action('CoachingController@view_coaching')->with('success', 'Coaching Added successfully');
        }
    }

    public function edit_coaching()
    {

        $input = request()->except('_token');

        if (request()->isMethod('get')) {

            if (empty($input['id'])) {
                return redirect()->action('CoachingController@view_coaching');
            }

            $coaching = DB::table('coaching')
                ->where('id', $input['id'])
                ->first();
            $allstate = DB::table('states')
                        ->select('id', 'name')
                        ->where('status', 1)
                        ->get();
            $allcountry = DB::table('countries')
                        ->select('id', 'name')
                        ->get();

            if( empty($coaching) ) {
                abort(404);
            }

            return view('coaching.edit_coaching', compact('coaching','allstate','allcountry'));
        } else {

            $is_exists = DB::table('coaching')
                ->where('id', '!=', $input['id'])
                ->where('name', $input['name'])
                ->exists();

            if ($is_exists) {
                return back()->with('error', 'Coaching already exists with this name');
            }

            if (!request()->file('image')) {

                unset($input['image']);
            } else {

                $image = DB::table('coaching')->where('id', $input['id'])->value('image');

                @unlink(asset('/public/coaching/' . $image));

                $file = request('image');

                $thumbnailPath = public_path('coaching/');

                $fileName = 'coaching-' . time() . random_int(0, 10);

                $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                if ($input['image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }
            }
            $des_pass = $input['password'];

            $input['decrypted_password'] = $des_pass;

            $input['offering'] = implode(',', $input['offering']);

            $input['password'] = Hash::make($input['password']);
            
            $country_id = $input['country_id'];

            $state_id = $input['state_id'];

            $city_id = $input['city_id'];
            
            $input['state'] = DB::table('states')
                                ->where('id', $state_id)
                                ->value('name');
            $input['country'] = DB::table('countries')
                                ->where('id', $country_id)
                                ->value('name');
            $input['city'] = DB::table('cities')
                                ->where('id', $city_id)
                                ->value('name');

            // enterprise also update
            $coaching_name = DB::table('coaching')
                            ->where('id', $input['id'])
                            ->value('name');
            
            $input1 = $input;

            unset($input1['id']);

            DB::table('enterprise')
            ->where('name', $coaching_name)
            ->update($input1);
            
            DB::table('coaching')->where('id', $input['id'])->update($input);

            $input['coaching_id'] = $input['id'];

            if( !empty($input['country']) and !empty($input['city']) and !empty($input['state'])) {
                # add first branch of this coaching
                $city = DB::table('cities')
                            ->where('name', $input['city'])
                            ->first();

                if( !empty($city) ) {
                
                    $center_data = array();
                    $center_data['coaching_id'] = $input['coaching_id'];
                    $center_data['name'] = $city->name;

                    $coaching_center = DB::table('coaching_centers')
                                        ->where('coaching_id', $input['coaching_id'])
                                        ->where('name', $city->name)
                                        ->first();

                    if( !empty($coaching_center) ) {   

                        $coaching_centers_id = $coaching_center->id;

                    } else {

                        $coaching_centers_id = DB::table('coaching_centers')->insertGetId($center_data);
                    
                    }

                    $branch_data = array();
                    $branch_data['is_main_branch'] = 1;
                    $branch_data['coaching_id'] = $input['coaching_id'];
                    $branch_data['coaching_centers_id'] = $coaching_centers_id;
                    $branch_data['name'] = $input['name'];
                    $branch_data['address'] = !empty($input['address']) ? $input['address'] : '';
                    $branch_data['email'] = !empty($input['email']) ? $input['email'] : '';
                    $branch_data['mobile'] = !empty($input['mobile']) ? $input['mobile'] : '';
                    $branch_data['latitude'] = !empty($input['latitude']) ? $input['latitude'] : '';
                    $branch_data['longitude'] = !empty($input['longitude']) ? $input['longitude'] : '';
                    
                    $is_already_exists = DB::table('coaching_centers_branches')
                                        ->where('coaching_id', $input['coaching_id'])
                                        ->where('is_main_branch', 1)
                                        ->exists();

                    if($is_already_exists) {

                        unset(
                            $branch_data['name']
                        );
                        
                        DB::table('coaching_centers_branches')
                            ->where('coaching_id', $input['coaching_id'])
                            ->where('is_main_branch', 1)
                            ->update($branch_data);

                    } else {

                        DB::table('coaching_centers_branches')->insert($branch_data);    
                    }
                }
            }

            return redirect()->action('CoachingController@view_coaching')->with('success', 'Coaching updated successfully');
        }
    }
    
    public function delete_coaching()
    {

        $input = request()->except('_token');

        $old_status = DB::table('coaching')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('coaching')->where('id', $input['id'])->update(['status' => $new_status]);
        
        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Coaching ' . $new_status . ' successfully');
        else {
            
            try {
  
                // send mail
                
                $coaching = DB::table('coaching')
                            ->where('id', $input['id'])
                            ->first();
                            
                $email = $coaching->email;
                
                $coaching_name = $coaching->name;
                        
                $subject = $coaching_name.', is Live Now on coachingselect.com';
                
                if( !empty($email) ) {
                        
                    $datamessage['email']=$email;
            		$datamessage['subject']=$subject;
            		
            	    \Mail::send('mails.coaching_live', compact('coaching_name'), function ($m) use ($datamessage){
            			$m->from('support@coachingselect.com', 'CoachingSelect');
            			$m->to($datamessage['email'])->subject($datamessage['subject']);
            		});
            		
                }
                                
            } catch(\Exception $e) {
                // ignore mail error
                
            }
            
            return redirect()->back()->with('success', 'Coaching ' . $new_status . ' successfully');
        }
    }

    public function view_coaching()
    {

        $input = request()->except('_token');

        $courses = DB::table('courses') 
                    ->join('streams', 'streams.id', 'courses.stream_id')
                    ->where('streams.status', 'enable')
                    ->where('courses.status', 'enable')
                    ->select('courses.*')
                    ->get();

        return view('coaching.view_coaching', compact('courses'));
    }

    public function view_coaching_dt(Request $request)
    {

        $columns = array(
            0 => 'coaching.id',
            1 => 'coaching.name',
            2 => 'coaching.is_featured',
            3 => 'coaching.added_from',
            4 => 'coaching.image',
            5 => 'coaching.offering',
            6 => 'coaching.created_at',
            7 => 'coaching.status',
            8 => 'coaching.city',
            9 => 'coaching.is_paid_member',
            10 => 'coaching.id',
            11 => 'coaching.faculty_student_ratio',
            12 => 'coaching.is_paid_member',
            13 => 'coaching.status',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('coaching');

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('coaching.name', 'LIKE', '%'.$name.'%');
            }
        }
        
        if (request()->has('added_from')) {
            $added_from = request('added_from');
            if ($added_from != "") {
                $query->where('coaching.added_from', $added_from);
            }
        }

        if(request()->has('start_date')){
            $start_date = request('start_date');
            
            if($start_date!=""){
                $query = $query->whereDate('coaching.created_at', '>=',date('Y-m-d',strtotime($start_date)));
            }
        }

        if(request()->has('end_date')){
            $end_date = request('end_date');
            if($end_date!=""){
                $query = $query->whereDate('coaching.created_at', '<=',date('Y-m-d',strtotime($end_date)));
            }
        }

        if(request()->has('city')){
            $city = request('city');

            if($city!="" and $city != 'null'){
                $query = $query
                            ->join('coaching_centers', 'coaching_centers.coaching_id', 'coaching.id')
                            ->join('coaching_centers_branches', 'coaching_centers_branches.coaching_centers_id', 'coaching_centers.id')
                            ->where('coaching_centers.name', 'LIKE', '%'. $city . '%')
                            ->distinct('coaching.id');
            }
        }

        if(request()->has('offering')){
            $offering = request('offering');
            
            if($offering!=""){
                $query = $query->where('coaching.offering', 'LIKE', '%'. $offering . '%');
            }
        }

        if(request()->has('course')){
            $course = request('course');
            if($course!="" and $course != 'null'){
                $query = $query
                            ->join('coaching_courses', 'coaching_courses.coaching_id', 'coaching.id')
                            ->join('coaching_courses_detail', 'coaching_courses_detail.coaching_courses_id', 'coaching_courses.id')
                            ->where('coaching_courses.name', 'LIKE', '%'. $course . '%')
                            ->distinct('coaching.id');
            }
        }

        if(request()->has('is_paid')){
            $is_paid = request('is_paid');
            if($is_paid!=""){
                $query = $query->where('coaching.is_paid_member', 'LIKE', '%'. $is_paid . '%');
            }
        }

        if(request()->has('is_featured')){
            $is_featured = request('is_featured');
            if($is_featured!=""){
                $query = $query->where('coaching.is_featured', 'LIKE', '%'. $is_featured . '%');
            }
        }

        $posts = $query;

        if(
            $request->input('order.0.column') == 0 and $request->input('order.0.dir') == 'asc'
        ) {
            $posts = $posts
                    ->orderBy('created_at', 'desc');
        } else {
            $posts = $posts->orderBy($order, $dir);
        }

        $totalData = $query
            ->whereIn('coaching.status', ['enable', 'disable'])
            ->count();

        $totalFiltered = $totalData;

        $posts = $query
            ->offset($start)
            ->limit($limit);
    
        $posts = $posts
                    ->select('coaching.*')
                    ->whereIn('coaching.status', ['enable', 'disable'])
                    ->get();

        if (!empty($posts)) {
            $data = array();
            if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                $count = $totalFiltered - $start;
            } else {
                $count = $start + 1;
            }

            foreach ($posts as $post) {

                $confirm = "return confirmation('Are you sure?') ";
                $default_img = "
                this.src='"  .asset('/public/s_img_new.php').'?image='. asset("public/logo.png") . "&width=60&height=60&zc=0'";

                $nestedData['id'] = $count;
                
                $nestedData['is_pending_reviews'] = DB::table('coaching_reviews')
                                                    ->where('coaching_id', $post->id)
                                                    ->where('is_seen', 0)
                                                    ->count();

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger " href="' . action('CoachingController@delete_coaching', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('CoachingController@delete_coaching', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';

                $is_featured = '';
                if($post->is_featured) {
                   $is_featured = 'active'; 
                }

                $is_featured = '
                <form 
                    class="is_featured"
                    method="post"
                    action="'.action('CoachingController@is_featured').'?id='.$post->id.'">'
                .csrf_field().'
                <input type="hidden" name="id" value="'.$post->id.'" />
                <button 
                type="submit" 
                class="'.$is_featured.' btn-sm btn btn-outline-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"></path>
                    </svg>
                    <span class="visually-hidden"></span>
                </button>';

                $nestedData['is_pending_request'] = 0;

                $is_paid_member = $post->is_paid_member;
                if($is_paid_member == 'request') {

                    $is_paid_member = '
                    <form 
                        class="become_prime_member"
                        method="post"
                        action="'.action('CoachingController@become_prime_member').'?id='.$post->id.'">'
                    .csrf_field().'
                    <input type="hidden" name="id" value="'.$post->id.'" />
                    <button 
                    type="submit" 
                    class="btn-xs btn btn-outline-secondary">
                        Request Received
                    </button>';

                    $nestedData['is_pending_request'] = 1;
                
                }

                $nestedData['is_featured'] = $is_featured;
                $nestedData['name'] = $post->name;

                $nestedData['added_from'] = $post->added_from;

                $nestedData['image'] = '<img src="' .asset('/public/s_img_new.php').'?image='. asset('public/coaching/' . $post->image) . '&width=60&height=60&zc=0"' .'  onerror="' . $default_img . '" width="80">';
                $nestedData['offering'] = $post->offering;
                $nestedData['center'] = $post->city;
                $nestedData['est_yr'] = $post->est_yr;
                $nestedData['mobile'] = $post->mobile;
                $nestedData['email'] = $post->email;
                $nestedData['password'] = $post->decrypted_password;
                $nestedData['scholarship'] = ( 
                                                ( !empty($post->scholarship) ) ? 
                                                (
                                                    ( ($post->scholarship_type == 'rs') ? ('upto ') : ('') ).
                                                        $post->scholarship . ' ' .
                                                    ( ($post->scholarship_type == 'per') ? ( '%' ) : '')
                                                ) : ''
                                            );
                $nestedData['avg_fees'] = $post->avg_fees;
                $nestedData['batch_size'] = $post->batch_size;
                $nestedData['faculty_student_ratio'] = $post->faculty_student_ratio;
                $nestedData['is_paid_member'] = $is_paid_member;
                $nestedData['status'] = $post->status;
                
                $nestedData['created_at'] = date('d/m/Y', strtotime($post->created_at));
                
                if( strlen($post->super_specialty) >= 40 ) {
                    $nestedData['super_speciality'] = '<span data-balloon-length="xlarge" aria-label="' . $post->super_specialty . '" data-balloon-pos="up">' . substr($post->super_specialty, 0, 40) . '...</span>';
                } else {
                    $nestedData['super_speciality'] = $post->super_specialty;
                }
                                
                if( strlen($post->tagline) >= 40 ) {
                    $nestedData['tagline'] = '<span data-balloon-length="xlarge" aria-label="' . $post->tagline . '" data-balloon-pos="up">' . substr($post->tagline, 0, 40) . '...</span>';
                } else {
                    $nestedData['tagline'] = $post->tagline;
                }
                
                $nestedData['number_of_branches'] = $post->number_of_branches;

                $nestedData['general_info'] = '
                <a class="btn btn-sm w-30px h-30px d-inline-flex p-0 align-items-center justify-content-center mx-1 btn-success" href="' . action('CoachingController@edit_coaching', 'id=' . $post->id) . '" aria-label="Edit" data-balloon-pos="up" ><i class="fad fa-pencil-alt"></i></a>';

                $nestedData['enable_disable'] =  $nestedData['general_info']. $new_status;

                $nestedData['courses'] = '
                <div class="d-flex align-items-center">
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-secondary" href="' . action('CoachingController@add_courses_detail', 'id=' . $post->id) . '" aria-label="Add Courses Detail" data-balloon-pos="up"><i class="fas fa-plus"></i></a>
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-info" href="' . action('CoachingController@view_coaching_courses_detail', 'id=' . $post->id) . '" aria-label="View Courses Detail" data-balloon-pos="up"><i class="fas fa-eye"></i></a>
                </div>';

                $nestedData['faculty'] = '
                <div class="d-flex align-items-center">
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-secondary" href="' . action('CoachingController@add_faculty', 'id=' . $post->id) . '" aria-label="Add Faculty" data-balloon-pos="up"><i class="fas fa-plus"></i></a>
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-info" href="' . action('CoachingController@view_coaching_faculty', 'id=' . $post->id) . '" aria-label="View faculty" data-balloon-pos="up"><i class="fas fa-eye"></i></a>
                </div>';

                $nestedData['results'] = '
                <div class="d-flex align-items-center">
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-secondary" href="' . action('CoachingController@add_results', 'id=' . $post->id) . '" aria-label="Add Results" data-balloon-pos="up"><i class="fas fa-plus"></i></a>
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-info" href="' . action('CoachingController@view_coaching_results', 'id=' . $post->id) . '" aria-label="View Results" data-balloon-pos="up"><i class="fas fa-eye"></i></a>
                </div>';

                $nestedData['photos'] = '
                <div class="d-flex align-items-center">
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-dark" href="' . action('CoachingController@add_photos', 'id=' . $post->id) . '" aria-label="Add Photos" data-balloon-pos="up"><i class="fas fa-plus"></i></a>
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-info" href="' . action('CoachingController@view_coaching_photos', 'id=' . $post->id) . '" aria-label="View Photos" data-balloon-pos="up"><i class="fas fa-eye"></i></a>
                </div>';

                $nestedData['videos'] = '
                <div class="d-flex align-items-center">
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-secondary" href="' . action('CoachingController@add_videos', 'id=' . $post->id) . '" aria-label="Add Videos" data-balloon-pos="up"><i class="fas fa-plus"></i></a>
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-info" href="' . action('CoachingController@view_coaching_videos', 'id=' . $post->id) . '" aria-label="View Videos" data-balloon-pos="up"><i class="fas fa-eye"></i></a>
                </div>';

                $nestedData['facility'] = '
                <div class="d-flex align-items-center">
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-secondary" href="' . action('CoachingController@add_facilities', 'id=' . $post->id) . '" aria-label="Add Facility" data-balloon-pos="up"><i class="fas fa-plus"></i></a>
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-info" href="' . action('CoachingController@view_coaching_facility', 'id=' . $post->id) . '" aria-label="View Facility" data-balloon-pos="up"><i class="fas fa-eye"></i></a>
                </div>';

                $nestedData['centers'] = '
                <div class="d-flex align-items-center">
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-secondary" href="' . action('CoachingController@add_branch', 'id=' . $post->id) . '" aria-label="Add Branch" data-balloon-pos="up"><i class="fas fa-plus"></i></a>
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-info" href="' . action('CoachingController@view_coaching_centers_branches', 'id=' . $post->id) . '" aria-label="View Branch" data-balloon-pos="up"><i class="fas fa-eye"></i></a>
                </div>';
                
                $nestedData['testimonials'] = '
                <div class="d-flex align-items-center">
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-secondary" href="' . action('CoachingController@add_testimonials', 'id=' . $post->id) . '" aria-label="Add testimonials" data-balloon-pos="up"><i class="fas fa-plus"></i></a>
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-info" href="' . action('CoachingController@view_coaching_testimonials', 'id=' . $post->id) . '" aria-label="View testimonials" data-balloon-pos="up"><i class="fas fa-eye"></i></a>
                </div>';
                
                $nestedData['reviews'] = '
                <div class="d-flex align-items-center">
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-info" href="' . action('CoachingController@view_coaching_reviews', 'id=' . $post->id) . '" aria-label="View reviews" data-balloon-pos="up"><i class="fas fa-eye"></i></a>
                </div>';

                $data[] = $nestedData;
                if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                    $count -= 1;
                } else {
                    $count += 1;
                }
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function all_courses(Request $request)
    {

        $columns = array(
            0 => 'courses.id',
            1 => 'courses.name',
            2 => 'streams.id',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('courses')
            ->join('streams', 'streams.id', 'courses.stream_id');

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('courses.name', $name);
            }
        }

        if (request()->has('stream_id')) {
            $stream_id = request('stream_id');
            if ($stream_id != "") {
                $query->where('courses.stream_id', $stream_id);
            }
        }

        $totalData = $query->count();
        $totalFiltered = $totalData;

        $posts = $query
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->select('courses.*', 'streams.name as stream')
            ->get();

        $streams = DB::table('streams')->select('id', 'name')->get();

        if (!empty($posts)) {
            $data = array();
            $count = 1;

            foreach ($posts as $post) {

                $confirm = "return confirmation('Are you sure?') ";

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? 'disable' : 'enable';

                $onclick = "select_course('" . $post->name . "')";

                $nestedData['name'] = $post->name;
                $nestedData['action'] = '<button type="button" class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-success" onclick="' . $onclick . '"  aria-label="Add" data-balloon-pos="up"><i class="fas fa-plus"></i></button>';

                $data[] = $nestedData;
                $count += 1;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function select_course()
    {
        $new_course = request()->get('course');

        if (session()->has('courses')) {
            $courses = session()->get('courses');

            $courses[$new_course] = $new_course;

            session(['courses' => $courses]);
        } else {
            $courses = array();
            $courses[$new_course] = $new_course;

            session(['courses' => $courses]);
        }

        return $courses;
    }

    public function deselect_course()
    {
        $new_course = request()->get('course');

        if (session()->has('courses')) {
            $courses = session()->get('courses');

            unset($courses[$new_course]);

            session(['courses' => $courses]);
        } else {
            $courses = array();

            unset($courses[$new_course]);

            session(['courses' => $courses]);
        }

        return $courses;
    }

    public function courses()
    {
        return DB::table('courses')->select('name as text', 'name as value')->get();
    }

    public function add_faculty()
    {

        $input = request()->except('_token');

        if (request()->isMethod('get')) {

            if (empty($input['id'])) {
                return redirect()->action('CoachingController@view_coaching');
            }

            $coaching = DB::table('coaching')
                ->where('id', $input['id'])
                ->first();

            if (empty($coaching)) {
                return back()->with('error', 'Invalid coaching id provided');
            } else {
                $coaching_id = $input['id'];
            }

            $coaching_name = $coaching->name;

            return view('coaching.add_faculty', compact('coaching_id', 'coaching_name'));
        } else {

            $is_exists = DB::table('coaching')
                ->where('id', $input['coaching_id'])
                ->exists();

            if (!$is_exists) {
                return back()->with('error', 'Coaching does not exists');
            }

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

                    $image = '';
                    if(!empty($faculty['image'])){
                        $file = $faculty['image'];

                        $thumbnailPath = public_path('coaching_faculty/');

                        $fileName = 'coaching_faculty-' . time() . random_int(0, 10);

                        $faculty_data['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                        if ($faculty_data['image'] == '') {
                            return redirect()->back()->with('error', 'invalid image provided');
                        }
                    }
                    
                    DB::table('coaching_faculty')->insert($faculty_data);
                }
            }

            return redirect()
                    ->action('CoachingController@view_coaching')
                    ->with('success', 'Coaching Faculty Added successfully');
        }
    }

    public function add_courses()
    {

        $input = request()->except('_token');

        if (request()->isMethod('get')) {

            if (empty($input['id'])) {
                return redirect()->action('CoachingController@view_coaching');
            }

            $coaching = DB::table('coaching')
                ->where('id', $input['id'])
                ->first();

            if (empty($coaching)) {
                return back()->with('error', 'Invalid coaching id provided');
            } else {
                $coaching_id = $input['id'];
            }

            session()->forget('courses');

            $streams = DB::table('streams')
                ->where('status', 'enable')
                ->select('id', 'name')
                ->get();

            return view('coaching.add_courses', compact('streams', 'coaching_id'));
        } else {

            $is_exists = DB::table('coaching')
                ->where('id', $input['coaching_id'])
                ->exists();

            if (!$is_exists) {
                return back()->with('error', 'Coaching does not exists');
            }

            # insert courses into courses tbl
            $courses = explode(',', $input['courses']);

            unset($input['courses']);
            unset($input['view_course_dt_length']);

            $coaching_id = $input['coaching_id'];

            $courses = ( ( !empty($courses) ) ? ($courses) : ( session()->has('courses') ) ) ? ( session()->get('courses') ) : ('');

            if (!empty($courses)) {
                foreach ($courses as $course) {

                    $course_data = array();
                    $course_data['coaching_id'] = $coaching_id;
                    $course_data['name'] = $course;

                    DB::table('coaching_courses')->insert($course_data);
                }
            }

            if (session()->has('courses')) {
                session()->forget('courses');
            }

            return redirect()->back()->with('success', 'Coaching Courses Added successfully');
        }
    }

    public function add_results()
    {

        $input = request()->except('_token');

        if (request()->isMethod('get')) {

            if (empty($input['id'])) {
                return redirect()->action('CoachingController@view_coaching');
            }

            $coaching = DB::table('coaching')
                ->where('id', $input['id'])
                ->first();

            if (empty($coaching)) {
                return back()->with('error', 'Invalid coaching id provided');
            } else {
                $coaching_id = $input['id'];
            }
            
            $coaching_name = $coaching->name;

            $coaching_courses = DB::table('courses')
                                ->where('type', 'coaching')
                                ->where('status','enable')
                                ->get();

            return view('coaching.add_results', compact('coaching_courses', 'coaching_id', 'coaching_name'));
        } else {

            $is_exists = DB::table('coaching')
                ->where('id', $input['coaching_id'])
                ->exists();

            if (!$is_exists) {
                return back()->with('error', 'Coaching does not exists');
            }

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

                    if($coaching->est_yr > $result_data['year']) {
                        return redirect()
                                ->back()
                                ->with('error', 'Year must be greater than est year');
                    }

                    if( !empty($result['image']) ) {
                        
                        $image = '';

                        $file = $result['image'];

                        $thumbnailPath = public_path('coaching_results/');

                        $fileName = 'coaching_results-' . time() . random_int(0, 10);

                        $result_data['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                        if ($result_data['image'] == '') {
                            return redirect()->back()->with('error', 'invalid image provided');
                        }

                    }

                    DB::table('coaching_results')->insert($result_data);
                }
            }

            return redirect()
                    ->action('CoachingController@view_coaching')
                    ->with('success', 'Coaching Results Added successfully');
        }
    }

    public function add_photos()
    {

        $input = request()->except('_token');

        if (request()->isMethod('get')) {

            if (empty($input['id'])) {
                return redirect()->action('CoachingController@view_coaching');
            }

            $coaching = DB::table('coaching')
                ->where('id', $input['id'])
                ->first();

            if (empty($coaching)) {
                return back()->with('error', 'Invalid coaching id provided');
            } else {
                $coaching_id = $input['id'];
            }

            $coaching_name = $coaching->name;

            return view('coaching.add_photos', compact('coaching_id', 'coaching_name'));
        } else {

            $is_exists = DB::table('coaching')
                ->where('id', $input['coaching_id'])
                ->exists();

            if (!$is_exists) {
                return back()->with('error', 'Coaching does not exists');
            }

            $photos = $input['image'];

            if (!empty($photos)) {
                foreach ($photos as $photo) {

                    $photo_data = array();
                    $photo_data['coaching_id'] = $input['coaching_id'];

                    $image = '';

                    $file = $photo;

                    $thumbnailPath = public_path('coaching_photos/');

                    $fileName = 'coaching_photos-' . time() . random_int(0, 10);

                    $photo_data['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                    if ($photo_data['image'] == '') {
                        return redirect()->back()->with('error', 'invalid image provided');
                    }

                    DB::table('coaching_photos')->insert($photo_data);
                }
            }

            return redirect()
                    ->action('CoachingController@view_coaching')
                    ->with('success', 'Coaching photos Added successfully');
        }
    }

    public function add_videos()
    {

        $input = request()->except('_token');

        if (request()->isMethod('get')) {

            if (empty($input['id'])) {
                return redirect()->action('CoachingController@view_coaching');
            }

            $coaching = DB::table('coaching')
                ->where('id', $input['id'])
                ->first();

            if (empty($coaching)) {
                return back()->with('error', 'Invalid coaching id provided');
            } else {
                $coaching_id = $input['id'];
            }

            $coaching_name = $coaching->name;

            return view('coaching.add_videos', compact('coaching_id', 'coaching_name'));
        } else {

            $is_exists = DB::table('coaching')
                ->where('id', $input['coaching_id'])
                ->exists();

            if (!$is_exists) {
                return back()->with('error', 'Coaching does not exists');
            }

            $videos = $input['videos'];

            if (!empty($videos)) {
                foreach ($videos as $video) {

                    $video_data = array();
                    $video_data['coaching_id'] = $input['coaching_id'];
                    $video_data['title'] = !empty($video['title']) ? $video['title'] : '';
                    $video_data['description'] = !empty($video['description']) ? $video['description'] : '';
                    $video_data['video'] = !empty($video['video']) ? $video['video'] : '';

                    DB::table('coaching_videos')->insert($video_data);
                }
            }

            return redirect()
                    ->action('CoachingController@view_coaching')
                    ->with('success', 'Coaching Videos Added successfully');
        }
    }

    public function all_facilities(Request $request)
    {

        $columns = array(
            0 => 'facility.id',
            1 => 'facility.name',
            2 => 'streams.id',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('facility')->where('status','enable');

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('facility.name', $name);
            }
        }

        if (request()->has('facility_type')) {
            $facility_type = request('facility_type');
            if ($facility_type != "") {
                $query->where('facility.type', $facility_type);
            }
        }

        $totalData = $query->count();
        $totalFiltered = $totalData;

        $posts = $query
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->select('facility.*')
            ->get();

        if (!empty($posts)) {
            $data = array();
            $count = 1;

            foreach ($posts as $post) {

                $confirm = "return confirmation('Are you sure?') ";

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? 'disable' : 'enable';

                $onclick = "select_facility('" . $post->name . "')";

                $nestedData['name'] = $post->name;
                $nestedData['action'] = '<button type="button" class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-success" onclick="' . $onclick . '" aria-label="Add" data-balloon-pos="up"><i class="fas fa-plus"></i></button>';

                $data[] = $nestedData;
                $count += 1;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function add_facilities()
    {

        $input = request()->except('_token');

        if (request()->isMethod('get')) {

            if (empty($input['id'])) {
                return redirect()->action('CoachingController@view_coaching');
            }

            $coaching = DB::table('coaching')
                ->where('id', $input['id'])
                ->first();

            if (empty($coaching)) {
                return back()->with('error', 'Invalid coaching id provided');
            } else {
                $coaching_id = $input['id'];
            }

            $coaching_name = $coaching->name;

            session()->forget('facilities');

            $facilities = DB::table('facility')->where('status','enable')
                ->select('id', 'name', 'type')
                ->groupBy('type')
                ->get();

            return view('coaching.add_facilities', compact('facilities', 'coaching_id', 'coaching_name'));
        } else {

            $is_exists = DB::table('coaching')
                ->where('id', $input['coaching_id'])
                ->exists();

            if (!$is_exists) {
                return back()->with('error', 'Coaching does not exists');
            }

            # insert facilities into facilities tbl
            $facilities = explode(',', $input['facilities']);

            unset($input['facilities']);
            unset($input['view_course_dt_length']);

            $coaching_id = $input['coaching_id'];

            $facilities = ( ( !empty($facilities) ) ? ( $facilities ) : ( session()->has('facilities') ) ) ? ( session()->get('facilities') ) : ('');

            if (!empty($facilities)) {
                foreach ($facilities as $facility) {

                    $facility_data = array();
                    $facility_data['coaching_id'] = $coaching_id;
                    $facility_data['name'] = $facility;

                    $is_already_exists = DB::table('coaching_facility')
                                            ->where('coaching_id', $coaching_id)
                                            ->where('name', $facility)
                                            ->exists();

                    if($is_already_exists) {
                        return redirect()
                                ->back()
                                ->with('error', 'Facility already exists in this coaching');
                    }

                    DB::table('coaching_facility')->insert($facility_data);
                }
            }

            if (session()->has('facilities')) {
                session()->forget('facilities');
            }

            return redirect()
                    ->action('CoachingController@view_coaching')
                    ->with('success', 'Coaching Facility Added successfully');
        }
    }

    public function select_facility()
    {
        $new_facility = request()->get('facility');

        if (session()->has('facilities')) {
            $facilities = session()->get('facilities');

            $facilities[$new_facility] = $new_facility;

            session(['facilities' => $facilities]);
        } else {
            $facilities = array();
            $facilities[$new_facility] = $new_facility;

            session(['facilities' => $facilities]);
        }

        return $facilities;
    }

    public function deselect_facility()
    {
        $new_facility = request()->get('facility');

        if (session()->has('facilities')) {
            $facilities = session()->get('facilities');

            unset($facilities[$new_facility]);

            session(['facilities' => $facilities]);
        } else {
            $facilities = array();

            unset($facilities[$new_facility]);

            session(['facilities' => $facilities]);
        }

        return $facilities;
    }

    # coaching courses
    public function view_coaching_courses()
    {

        $input = request()->except('_token');

        if (empty($input['id'])) {
            return redirect()->action('CoachingController@view_coaching');
        }

        $coaching = DB::table('coaching')
            ->where('id', $input['id'])
            ->first();

        if (empty($coaching)) {
            return back()->with('error', 'Invalid coaching id provided');
        } else {
            $coaching_id = $input['id'];
        }

        $streams = DB::table('streams')->select('id', 'name')->get();

        return view('coaching.view_coaching_courses', compact('streams', 'coaching_id'));
    }

    public function view_coaching_courses_dt(Request $request)
    {

        $columns = array(
            0 => 'coaching_courses.id',
            1 => 'streams.name',
            2 => 'courses.name',
            3 => 'coaching_courses.status',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $coaching_id = $request->input('coaching_id');

        $query = DB::table('coaching_courses')
            ->join('coaching', 'coaching.id', 'coaching_courses.coaching_id')
            ->join('courses', 'courses.name', 'coaching_courses.name')
            ->join('streams', 'streams.id', 'courses.stream_id')
            ->where('coaching_courses.coaching_id', $coaching_id);


        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('coaching_courses.name', 'LIKE', '%' . $name . '%');
            }
        }

        if (request()->has('stream_id')) {
            $stream_id = request('stream_id');
            if ($stream_id != "") {
                $query->where('streams.id', $stream_id);
            }
        }

        $totalData = $query->count();
        $totalFiltered = $totalData;

        $posts = $query
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->select('coaching_courses.*', 'streams.name as stream')
            ->get();

        if (!empty($posts)) {
            $data = array();
            if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                $count = $totalFiltered - $start;
            } else {
                $count = $start + 1;
            }

            foreach ($posts as $post) {

                $confirm = "return confirmation('Are you sure?') ";

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('CoachingController@delete_coaching_courses', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('CoachingController@delete_coaching_courses', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';

                $nestedData['name'] = $post->name;
                $nestedData['stream'] = $post->stream;
                $nestedData['status'] = $post->status;
                $nestedData['action'] = '<div class="d-flex align-items-center">'.$new_status . '
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-info" href="' . action('CoachingController@add_courses_detail', 'id=' . $post->id) . '" aria-label="Add Course Detail" data-balloon-pos="up"><i class="fas fa-plus"></i></a>
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-info" href="' . action('CoachingController@view_coaching_courses_detail', 'id=' . $post->id) . '" aria-label="View Course Details" data-balloon-pos="up"><i class="fas fa-eye"></i></a>
                </div>';

                $data[] = $nestedData;
                if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                    $count -= 1;
                } else {
                    $count += 1;
                }
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function delete_coaching_courses()
    {

        $input = request()->except('_token');

        $old_status = DB::table('coaching_courses')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('coaching_courses')->where('id', $input['id'])->update(['status' => $new_status]);

        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Coaching Courses ' . $new_status . ' successfully');
        else
            return redirect()->back()->with('success', 'Coaching Courses ' . $new_status . ' successfully');
    }

    # coaching faculty
    public function view_coaching_faculty()
    {
        $input = request()->except('_token');

        if (empty($input['id'])) {
            return redirect()->action('CoachingController@view_coaching');
        }

        $coaching = DB::table('coaching')
            ->where('id', $input['id'])
            ->first();

        if (empty($coaching)) {
            return back()->with('error', 'Invalid coaching id provided');
        } else {
            $coaching_id = $input['id'];
        }
    
        $coaching_name = $coaching->name;

        return view('coaching.view_coaching_faculty', compact('coaching_id', 'coaching_name'));
    }

    public function view_coaching_faculty_dt(Request $request)
    {

        $columns = array(
            0 => 'coaching_faculty.id',
            1 => 'coaching_faculty.name',
            2 => 'coaching_faculty.name',
            3 => 'coaching_faculty.created_at',
            4 => 'coaching_faculty.fee',
            5 => 'coaching_faculty.offer_percentage',
            6 => 'coaching_faculty.is_paid',
            7 => 'coaching_faculty.created_at',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $coaching_id = $request->input('coaching_id');

        $query = DB::table('coaching_faculty')
            ->where('coaching_id', $coaching_id);

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('coaching_faculty.name', 'LIKE', '%' . $name . '%');
            }
        }
        if(request()->has('start_date')){
            $start_date = request('start_date');
            
            if($start_date!=""){
                $query = $query->whereDate('coaching_faculty.created_at', '>=',date('Y-m-d',strtotime($start_date)));
            }
        }

        if(request()->has('end_date')){
            $end_date = request('end_date');
            if($end_date!=""){
                $query = $query->whereDate('coaching_faculty.created_at', '<=',date('Y-m-d',strtotime($end_date)));
            }
        }

        $totalData = $query->count();
        $totalFiltered = $totalData;

        $posts = $query
            ->offset($start)
            ->limit($limit);

        if(
            $request->input('order.0.column') == 0 and $request->input('order.0.dir') == 'asc'
        ) {
            $posts = $posts->orderBy('created_at', 'desc');
        } else {
            $posts = $posts->orderBy($order, $dir);
        }
    
        $posts = $posts
                ->orderBy($order, $dir)
                ->get();

        if (!empty($posts)) {
            $data = array();
            $count = 1;

            foreach ($posts as $post) {

                $confirm = "return confirmation('Are you sure?') ";

                $default_img = "this.src='" . asset("public/logo.png") . "'";

                $image = asset('public/coaching_faculty/' . $post->image);

                if (!@GetImageSize($image)) {
                    $image = asset('public/logo.png');
                }

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('CoachingController@delete_coaching_faculty', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('CoachingController@delete_coaching_faculty', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';

                $nestedData['name'] = $post->name;
                $nestedData['designation'] = $post->designation;
                $nestedData['education'] = $post->education;
                $nestedData['experience'] = $post->experience;
                $nestedData['link'] = $post->link;
                $nestedData['status'] = $post->status;
                
                $nestedData['created_at'] = date('d/m/Y', strtotime($post->created_at));
                $nestedData['image'] = '<img src="' . asset('public/coaching_faculty/' . $post->image) . '" width=60 onerror="' . $default_img . '">';
                $nestedData['action'] = '<div class="d-flex"><button type="button" class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-primary" data-toggle="modal" data-target="#exampleModalCenter' . $post->id . '"  aria-label="Edit" data-balloon-pos="up">
                <i class="fad fa-pencil"></i>
                </button>
                <div class="modal fade" id="exampleModalCenter' . $post->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter' . $post->id . 'Title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Faculty</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form action="' . action('CoachingController@edit_coaching_faculty') . '" class="form" enctype="multipart/form-data" method="post">                                
                                ' . csrf_field() . '
                                <input type="hidden" class="form-control" value="' . $post->id . '" name="id">
                                <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <input type="file" class="form-control uploaded" style="--upload-pic:url(' . $image . ');" upload-pic="" name="image">
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" value="' . $post->name . '" name="name" required placeholder="Enter Name">
                                </div>                                
                                <div class="form-group">
                                    <label class="control-label">Designation</label>
                                    <input type="text" class="form-control" value="' . $post->designation . '" name="designation" placeholder="Enter designation">
                                </div>                                
                                <div class="form-group">
                                    <label class="control-label">Education</label>
                                    <input type="text" class="form-control" value="' . $post->education . '" name="education" placeholder="Enter education">
                                </div>                                
                                <div class="form-group">
                                    <label class="control-label">Experience</label>
                                    <input type="text" class="form-control" value="' . $post->experience . '" name="experience" placeholder="Enter experience">
                                </div>                                
                                <div class="form-group">
                                    <label class="control-label">LinkedIn Url</label>
                                    <input type="text" class="form-control" value="' . $post->link . '" name="link" placeholder="Enter link" onchange="return is_linkedin_url(this)">
                                </div>
                                <input type="submit" class="btn btn-sm btn-primary my-2" value="Update">
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                ' . $new_status . '</div>';

                $data[] = $nestedData;
                $count += 1;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function edit_coaching_faculty()
    {

        if (request()->isMethod('get')) {
            return back();
        } else {

            $input = request()->except('_token');

            $is_exists = DB::table('coaching_faculty')
                ->where('id', '!=', $input['id'])
                ->where('name', $input['name'])
                ->exists();

            if (!request()->file('image')) {

                unset($input['image']);
            } else {

                $image = DB::table('coaching_faculty')->where('id', $input['id'])->value('image');

                @unlink(asset('/public/coaching_faculty/' . $image));

                $file = request('image');

                $thumbnailPath = public_path('coaching_faculty/');

                $fileName = 'faculty-' . time() . random_int(0, 10);

                $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                if ($input['image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }
            }

            DB::table('coaching_faculty')->where('id', $input['id'])->update($input);

            return redirect()->back()->with('success', 'Faculty Updated successfully');
        }
    }

    public function delete_coaching_faculty()
    {

        $input = request()->except('_token');

        $old_status = DB::table('coaching_faculty')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('coaching_faculty')->where('id', $input['id'])->update(['status' => $new_status]);

        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Coaching Faculty ' . $new_status . ' successfully');
        else 
            return redirect()->back()->with('success', 'Coaching Faculty ' . $new_status . ' successfully');
    }

    # coaching results
    public function view_coaching_results()
    {
        $input = request()->except('_token');

        if (empty($input['id'])) {
            return redirect()->action('CoachingController@view_coaching');
        }

        $coaching = DB::table('coaching')
            ->where('id', $input['id'])
            ->first();

        if (empty($coaching)) {
            return back()->with('error', 'Invalid coaching id provided');
        } else {
            $coaching_id = $input['id'];
        }
    
        $coaching_name = $coaching->name;

        return view('coaching.view_coaching_results', compact('coaching_id', 'coaching_name'));
    }

    public function view_coaching_results_dt(Request $request)
    {

        $columns = array(
            0 => 'coaching_results.id',
            1 => 'courses.name',
            2 => 'coaching_results.name',
            3 => 'coaching_results.name',
            4 => 'coaching_results.rank',
            5 => 'coaching_results.category',
            6 => 'coaching_results.year',
            7 => 'coaching_results.created_at',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $coaching_id = $request->input('coaching_id');

        $query = DB::table('coaching_results')
            ->join('courses', 'courses.id', 'coaching_results.coaching_courses_id')
            ->where('coaching_results.coaching_id', $coaching_id);

        $coaching_courses = DB::table('courses')
                                    ->where('type', 'coaching')
                                    ->where('status','enable')
                                    ->get();

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('coaching_results.name', 'LIKE', '%' . $name . '%');
            }
        }
        if(request()->has('start_date')){
            $start_date = request('start_date');
            
            if($start_date!=""){
                $query = $query->whereDate('coaching_results.created_at', '>=',date('Y-m-d',strtotime($start_date)));
            }
        }

        if(request()->has('end_date')){
            $end_date = request('end_date');
            if($end_date!=""){
                $query = $query->whereDate('coaching_results.created_at', '<=',date('Y-m-d',strtotime($end_date)));
            }
        }

        $totalData = $query->count();
        $totalFiltered = $totalData;

        $posts = $query
            ->offset($start)
            ->limit($limit);

        if(
            $request->input('order.0.column') == 0 and $request->input('order.0.dir') == 'asc'
        ) {
            $posts = $posts->orderBy('created_at', 'desc');
        } else {
            $posts = $posts->orderBy($order, $dir);
        }
    
        $posts = $posts
                ->select('coaching_results.*', 'courses.name as coaching_courses_name')
                ->get();

        if (!empty($posts)) {
            $data = array();
            if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                $count = $totalFiltered - $start;
            } else {
                $count = $start + 1;
            }

            foreach ($posts as $post) {

                $confirm = "return confirmation('Are you sure?') ";

                $default_img = "this.src='" . asset("public/logo.png") . "'";

                $image = asset('public/coaching_results/' . $post->image);

                if (!@GetImageSize($image)) {
                    $image = asset('public/logo.png');
                }

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('CoachingController@delete_coaching_results', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('CoachingController@delete_coaching_results', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';

                $year_list = '<div class="form-group"><select name="year" id="year" class="form-control  show-tick" data-width="full" data-container="body" data-live-search="true">
                <option value="" disabled selected>Select Year</option>';

                foreach(range(date('Y'), 1970) as $year) {
                    $is_selected = '';

                    if($post->year == $year) {
                        $is_selected = 'selected';
                    }

                    $year_list .= '<option value="'.$year.'" '.$is_selected.'>'.$year.'</option>';
                }

                $year_list .= '</select></div>';

                $nestedData['coaching_courses_name'] = $post->coaching_courses_name;
                $nestedData['name'] = $post->name;
                $nestedData['rank'] = $post->rank;
                $nestedData['category'] = $post->category;
                $nestedData['year'] = $post->year;
                $nestedData['status'] = $post->status;
                
                $nestedData['created_at'] = date('d/m/Y', strtotime($post->created_at));
                $nestedData['image'] = '<img src="' . asset('public/coaching_results/' . $post->image) . '" width=60 onerror="' . $default_img . '">';
                $nestedData['action'] = '<div class="d-flex"><button type="button" class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-primary" data-toggle="modal" data-target="#exampleModalCenter' . $post->id . '" aria-label="Edit" data-balloon-pos="up">
                <i class="fad fa-pencil"></i>
                </button>
                <div class="modal fade" id="exampleModalCenter' . $post->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter' . $post->id . 'Title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit results</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form action="' . action('CoachingController@edit_coaching_results') . '" class="form" enctype="multipart/form-data" method="post">                                
                                ' . csrf_field() . '
                                <input type="hidden" class="form-control" value="' . $post->id . '" name="id">
                                <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <input type="file" class="form-control uploaded" style="--upload-pic:url(' . $image . ');" upload-pic="" name="image">
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Course</label><br>
                                            <select class="form-control  show-tick" data-width="full" data-container="body" data-live-search="true" required name="coaching_courses_id">
                                                 <option value="">Select Course</option>';

                                            if (!empty($coaching_courses)) {
                                                foreach ($coaching_courses as $course) {

                                                    $is_selected = '';

                                                    if ($course->name == $post->coaching_courses_name) {
                                                        $is_selected = 'selected';
                                                    }

                                                  $nestedData['action'] .=  '<option value="' . $course->id . '" ' . $is_selected . '>' . $course->name . '</option>';
                                                }
                                            }

        $nestedData['action'] .= '</select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" value="' . $post->name . '" name="name" required placeholder="Enter Name">
                                </div>                           
                                <div class="form-group">
                                    <label class="control-label">Rank</label>
                                    <input type="text" class="form-control" value="' . $post->rank . '" name="rank" placeholder="Enter rank" >
                                </div>                            
                                <div class="form-group">
                                    <label class="control-label">Category</label>
                                    <input type="text" class="form-control" value="' . $post->category . '" name="category" placeholder="Enter category">
                                </div>
                                <div class="form-group">
                                <label class="control-label">Year</label>
                                '.$year_list.'
                                </div>
                                <input type="submit" class="btn btn-sm btn-primary my-2" value="Update">
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                ' . $new_status . '</div>';

                $data[] = $nestedData;
                if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                    $count -= 1;
                } else {
                    $count += 1;
                }
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function edit_coaching_results()
    {

        if (request()->isMethod('get')) {
            return back();
        } else {

            $input = request()->except('_token');

            $is_exists = DB::table('coaching_results')
                ->where('id', '!=', $input['id'])
                ->where('name', $input['name'])
                ->exists();

            if ($is_exists) {
            }

            if (!request()->file('image')) {

                unset($input['image']);
            } else {

                $image = DB::table('coaching_results')->where('id', $input['id'])->value('image');

                @unlink(asset('/public/coaching_results/' . $image));

                $file = request('image');

                $thumbnailPath = public_path('coaching_results/');

                $fileName = 'results-' . time() . random_int(0, 10);

                $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                if ($input['image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }
            }

            DB::table('coaching_results')->where('id', $input['id'])->update($input);

            return redirect()->back()->with('success', 'Coaching Results Updated successfully');
        }
    }

    public function delete_coaching_results()
    {

        $input = request()->except('_token');

        $old_status = DB::table('coaching_results')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('coaching_results')->where('id', $input['id'])->update(['status' => $new_status]);

        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Coaching results ' . $new_status . ' successfully');
        else
            return redirect()->back()->with('success', 'Coaching results ' . $new_status . ' successfully');
    }

    # coaching photos
    public function view_coaching_photos()
    {
        $input = request()->except('_token');

        if (empty($input['id'])) {
            return redirect()->action('CoachingController@view_coaching');
        }

        $coaching = DB::table('coaching')
            ->where('id', $input['id'])
            ->first();

        if (empty($coaching)) {
            return back()->with('error', 'Invalid coaching id provided');
        } else {
            $coaching_id = $input['id'];
        }

        $coaching_name = $coaching->name;

        return view('coaching.view_coaching_photos', compact('coaching_id', 'coaching_name'));
    }

    public function view_coaching_photos_dt(Request $request)
    {

        $columns = array(
            0 => 'coaching_photos.id',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $coaching_id = $request->input('coaching_id');

        $query = DB::table('coaching_photos')
            ->where('coaching_photos.coaching_id', $coaching_id);

        $totalData = $query->count();
        $totalFiltered = $totalData;

        $posts = $query
            ->offset($start)
            ->limit($limit);

        if(
            $request->input('order.0.column') == 0 and $request->input('order.0.dir') == 'asc'
        ) {
            $posts = $posts->orderBy('created_at', 'desc');
        } else {
            $posts = $posts->orderBy($order, $dir);
        }
    
        $posts = $posts
            ->orderBy($order, $dir)
            ->get();

        if (!empty($posts)) {
            $data = array();
            $count = 1;

            foreach ($posts as $post) {

                $confirm = "return confirmation('Are you sure?') ";

                $default_img = "this.src='" . asset("public/logo.png") . "'";

                $image = asset('public/coaching_photos/' . $post->image);

                if (!@GetImageSize($image)) {
                    $image = asset('public/logo.png');
                }

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('CoachingController@delete_coaching_photos', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('CoachingController@delete_coaching_photos', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';

                $nestedData['image'] = '<img src="' . asset('public/coaching_photos/' . $post->image) . '" width=60 onerror="' . $default_img . '">';
                $nestedData['status'] = $post->status;
                $nestedData['action'] = '<div class="d-flex"><button type="button" class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-primary" data-toggle="modal" data-target="#exampleModalCenter' . $post->id . '" aria-label="Edit" data-balloon-pos="up">
                <i class="fad fa-pencil"></i>
                </button>
                <div class="modal fade" id="exampleModalCenter' . $post->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter' . $post->id . 'Title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit photos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form action="' . action('CoachingController@edit_coaching_photos') . '" class="form" enctype="multipart/form-data" method="post">                                
                                ' . csrf_field() . '
                                <input type="hidden" class="form-control" value="' . $post->id . '" name="id">
                                <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <input type="file" class="form-control uploaded" style="--upload-pic:url(' . $image . ');" upload-pic="" name="image">
                                    
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                                </div>
                                <input type="submit" class="btn btn-sm btn-primary my-2" value="Update">
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                ' . $new_status . '</div>';

                $data[] = $nestedData;
                $count += 1;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function edit_coaching_photos()
    {

        if (request()->isMethod('get')) {
            return back();
        } else {

            $input = request()->except('_token');

            if (!request()->file('image')) {

                unset($input['image']);
            } else {

                $image = DB::table('coaching_photos')->where('id', $input['id'])->value('image');

                @unlink(asset('/public/coaching_photos/' . $image));

                $file = request('image');

                $thumbnailPath = public_path('coaching_photos/');

                $fileName = 'photos-' . time() . random_int(0, 10);

                $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                if ($input['image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }
            }

            DB::table('coaching_photos')->where('id', $input['id'])->update($input);

            return redirect()->back()->with('success', 'Coaching photos Updated successfully');
        }
    }

    public function delete_coaching_photos()
    {

        $input = request()->except('_token');

        $old_status = DB::table('coaching_photos')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('coaching_photos')->where('id', $input['id'])->update(['status' => $new_status]);

        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Coaching photos ' . $new_status . ' successfully');
        else
            return redirect()->back()->with('success', 'Coaching photos ' . $new_status . ' successfully');
    }

    # coaching videos
    public function view_coaching_videos()
    {
        $input = request()->except('_token');

        if (empty($input['id'])) {
            return redirect()->action('CoachingController@view_coaching');
        }

        $coaching = DB::table('coaching')
            ->where('id', $input['id'])
            ->first();

        if (empty($coaching)) {
            return back()->with('error', 'Invalid coaching id provided');
        } else {
            $coaching_id = $input['id'];
        }

        $coaching_name = $coaching->name;

        return view('coaching.view_coaching_videos', compact('coaching_id', 'coaching_name'));
    }

    public function view_coaching_videos_dt(Request $request)
    {

        $columns = array(
            0 => 'coaching_videos.id',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $coaching_id = $request->input('coaching_id');

        $query = DB::table('coaching_videos')
            ->where('coaching_videos.coaching_id', $coaching_id);

        $totalData = $query->count();
        $totalFiltered = $totalData;

        $posts = $query
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        if (!empty($posts)) {
            $data = array();
            $count = 1;

            foreach ($posts as $post) {

                $confirm = "return confirmation('Are you sure?') ";

                $default_img = "this.src='" . asset("public/logo.png") . "'";

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('CoachingController@delete_coaching_videos', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('CoachingController@delete_coaching_videos', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';

                $nestedData['video'] = '<iframe src="' . $post->video . '" type="video/mp4"> </iframe>';
                $nestedData['status'] = $post->status;
                $nestedData['action'] = '<div class="d-flex"><button type="button" class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-primary" data-toggle="modal" data-target="#exampleModalCenter' . $post->id . '" aria-label="Edit" data-balloon-pos="up">
                <i class="fad fa-pencil"></i>
                </button>
                <div class="modal fade" id="exampleModalCenter' . $post->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter' . $post->id . 'Title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit videos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form action="' . action('CoachingController@edit_coaching_videos') . '" class="form" enctype="multipart/form-data" method="post">                                
                                ' . csrf_field() . '
                                <input type="hidden" class="form-control" value="' . $post->id . '" name="id">
                                <div class="form-group text-center">
                                <iframe src="' . $post->video . '" type="video/mp4"> </iframe>
                                </div>
                                <div class="form-group">
                                    <input type="url" class="form-control" name="video" value="' . $post->video . '" placeholder="Enter youtube video embed url">
                                </div>
                                <div class="form-group">
                                    <input type="text" 
                                    class="form-control" 
                                    name="title" value="' . $post->title . '" placeholder="Enter youtube title">
                                </div>
                                <input type="submit" class="btn btn-sm btn-primary my-2" value="Update">
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                ' . $new_status . '</div>';

                $data[] = $nestedData;
                $count += 1;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function edit_coaching_videos()
    {

        if (request()->isMethod('get')) {
            return back();
        } else {

            $input = request()->except('_token');

            DB::table('coaching_videos')->where('id', $input['id'])->update($input);

            return redirect()->back()->with('success', 'Coaching videos Updated successfully');
        }
    }

    public function delete_coaching_videos()
    {

        $input = request()->except('_token');

        $old_status = DB::table('coaching_videos')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('coaching_videos')->where('id', $input['id'])->update(['status' => $new_status]);

        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Coaching videos ' . $new_status . ' successfully');
        else
            return redirect()->back()->with('success', 'Coaching videos ' . $new_status . ' successfully');
    }

    # coaching facility
    public function view_coaching_facility()
    {

        $input = request()->except('_token');

        if (empty($input['id'])) {
            return redirect()->action('CoachingController@view_coaching');
        }

        $coaching = DB::table('coaching')
            ->where('id', $input['id'])
            ->first();

        if (empty($coaching)) {
            return back()->with('error', 'Invalid coaching id provided');
        } else {
            $coaching_id = $input['id'];
        }

        $coaching_name = $coaching->name;

        session()->forget('facilities');

        $facilities = DB::table('facility')
            ->select('id', 'name', 'type')
            ->groupBy('type')
            ->get();

        return view('coaching.view_coaching_facility', compact('facilities', 'coaching_id', 'coaching_name'));
    }

    public function view_coaching_facility_dt(Request $request)
    {

        $columns = array(
            0 => 'coaching_facility.id',
            1 => 'facility.type',
            2 => 'facility.name',
            3 => 'coaching_facility.created_at',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $coaching_id = $request->input('coaching_id');

        $query = DB::table('coaching_facility')
            ->join('coaching', 'coaching.id', 'coaching_facility.coaching_id')
            ->join('facility', 'facility.name', 'coaching_facility.name')
            ->where('coaching_facility.coaching_id', $coaching_id);

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('coaching_facility.name', $name);
            }
        }

        if (request()->has('facility_type')) {
            $facility_type = request('facility_type');

            if ($facility_type != "") {
                $query->where('facility.type', $facility_type);
            }
        }

        if(request()->has('start_date')){
            $start_date = request('start_date');
            
            if($start_date!=""){
                $query = $query->whereDate('coaching_facility.created_at', '>=',date('Y-m-d',strtotime($start_date)));
            }
        }

        if(request()->has('end_date')){
            $end_date = request('end_date');
            if($end_date!=""){
                $query = $query->whereDate('coaching_facility.created_at', '<=',date('Y-m-d',strtotime($end_date)));
            }
        }

        $totalData = $query->count();
        $totalFiltered = $totalData;

        $posts = $query
            ->offset($start)
            ->limit($limit);

        if(
            $request->input('order.0.column') == 0 and $request->input('order.0.dir') == 'asc'
        ) {
            $posts = $posts->orderBy('created_at', 'desc');
        } else {
            $posts = $posts->orderBy($order, $dir);
        }
    
        $posts = $posts
            ->select('coaching_facility.*', 'facility.type as facility_type')
            ->get();

        if (!empty($posts)) {
            $data = array();
            if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                $count = $totalFiltered - $start;
            } else {
                $count = $start + 1;
            }

            foreach ($posts as $post) {

                $confirm = "return confirmation('Are you sure?') ";

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('CoachingController@delete_coaching_facility', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('CoachingController@delete_coaching_facility', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';

                $nestedData['type'] = $post->facility_type;
                $nestedData['name'] = $post->name;
                $nestedData['status'] = $post->status;
                
                $nestedData['created_at'] = date('d/m/Y', strtotime($post->created_at));
                $nestedData['action'] = $new_status;

                $data[] = $nestedData;
                if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                    $count -= 1;
                } else {
                    $count += 1;
                }
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function delete_coaching_facility()
    {

        $input = request()->except('_token');

        $old_status = DB::table('coaching_facility')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('coaching_facility')->where('id', $input['id'])->update(['status' => $new_status]);

        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Coaching facility ' . $new_status . ' successfully');
        else
            return redirect()->back()->with('success', 'Coaching facility ' . $new_status . ' successfully');
    }

    # coaching centers
    public function add_centers()
    {

        $input = request()->except('_token');

        if (request()->isMethod('get')) {

            if (empty($input['id'])) {
                return redirect()->action('CoachingController@view_coaching');
            }

            $coaching = DB::table('coaching')
                ->where('id', $input['id'])
                ->first();

            if (empty($coaching)) {
                return back()->with('error', 'Invalid coaching id provided');
            } else {
                $coaching_id = $input['id'];
            }

            $coaching_name = $coaching->name;

            session()->forget('centers');

            $states = DB::table('states')
                ->select('id', 'name')
                ->get();

            return view('coaching.add_centers', compact('states', 'coaching_id', 'coaching_name'));
        } else {

            $is_exists = DB::table('coaching')
                ->where('id', $input['coaching_id'])
                ->exists();

            if (!$is_exists) {
                return back()->with('error', 'Coaching does not exists');
            }

            # insert centers into centers tbl
            $centers = explode(',', $input['centers']);

            unset($input['centers']);
            unset($input['view_course_dt_length']);

            $coaching_id = $input['coaching_id'];

            $centers = ( ( !empty($centers) ) ? ( $centers ) : ( session()->has('centers') ) ) ? ( session()->get('centers') ) : '';

            if (!empty($centers)) {
                foreach ($centers as $center) {

                    $center_data = array();
                    $center_data['coaching_id'] = $coaching_id;
                    $center_data['name'] = $center;

                    DB::table('coaching_centers')->insert($center_data);
                }
            }

            if (session()->has('centers')) {
                session()->forget('centers');
            }

            return redirect()->back()->with('success', 'Coaching Centers Added successfully');
        }
    }

    public function all_centers(Request $request)
    {

        $columns = array(
            0 => 'cities.id',
            1 => 'cities.name',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $query = DB::table('cities')
            ->join('states', 'states.id', 'cities.state_id');

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('cities.name', $name);
            }
        }

        if (request()->has('state_id')) {
            $state_id = request('state_id');
            if ($state_id != "") {
                $query->where('cities.state_id', $state_id);
            }
        }

        $totalData = $query->count();
        $totalFiltered = $totalData;

        $posts = $query
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->select('cities.*', 'states.name as state')
            ->get();

        $states = DB::table('states')->select('id', 'name')->get();

        if (!empty($posts)) {
            $data = array();
            $count = 1;

            foreach ($posts as $post) {

                $confirm = "return confirmation('Are you sure?') ";

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? 'disable' : 'enable';

                $onclick = "select_center('" . $post->name . "')";

                $nestedData['name'] = $post->name;
                $nestedData['action'] = '<button type="button" class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-success" onclick="' . $onclick . '" aria-label="Add" data-balloon-pos="up"><i class="fas fa-plus"></i></button>';

                $data[] = $nestedData;
                $count += 1;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function select_center()
    {
        $new_center = request()->get('center');

        if (session()->has('centers')) {
            $centers = session()->get('centers');

            $centers[$new_center] = $new_center;

            session(['centers' => $centers]);
        } else {
            $centers = array();
            $centers[$new_center] = $new_center;

            session(['centers' => $centers]);
        }

        return $centers;
    }

    public function deselect_center()
    {
        $new_center = request()->get('center');

        if (session()->has('centers')) {
            $centers = session()->get('centers');

            unset($centers[$new_center]);

            session(['centers' => $centers]);
        } else {
            $centers = array();

            unset($centers[$new_center]);

            session(['centers' => $centers]);
        }

        return $centers;
    }

    public function view_coaching_centers()
    {

        $input = request()->except('_token');

        if (empty($input['id'])) {
            return redirect()->action('CoachingController@view_coaching');
        }

        $coaching = DB::table('coaching')
            ->where('id', $input['id'])
            ->first();

        if (empty($coaching)) {
            return back()->with('error', 'Invalid coaching id provided');
        } else {
            $coaching_id = $input['id'];
        }

        $coaching_name = $coaching->name;

        $states = DB::table('states')->select('id', 'name')->get();

        return view('coaching.view_coaching_centers', compact('states', 'coaching_id', 'coaching_name'));
    }

    public function view_coaching_centers_dt(Request $request)
    {

        $columns = array(
            0 => 'coaching_centers.id',
            1 => 'coaching_centers.name',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $coaching_id = $request->input('coaching_id');

        $query = DB::table('coaching_centers')
            ->join('coaching', 'coaching.id', 'coaching_centers.coaching_id')
            ->join('cities', 'cities.name', 'coaching_centers.name')
            ->join('states', 'states.id', 'cities.state_id')
            ->where('coaching_centers.coaching_id', $coaching_id);

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('coaching_centers.name', $name);
            }
        }

        if (request()->has('state_id')) {
            $state_id = request('state_id');
            if ($state_id != "") {
                $query->where('states.id', $state_id);
            }
        }

        $totalData = $query->count();
        $totalFiltered = $totalData;

        $posts = $query
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->select('coaching_centers.*', 'states.name as state')
            ->get();

        if (!empty($posts)) {
            $data = array();
            $count = 1;

            foreach ($posts as $post) {

                $confirm = "return confirmation('Are you sure?') ";

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('CoachingController@delete_coaching_centers', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('CoachingController@delete_coaching_centers', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';

                $nestedData['name'] = $post->name;
                $nestedData['state'] = $post->state;
                $nestedData['status'] = $post->status;
                $nestedData['action'] = '
                <div class="d-flex align-items-center">'.$new_status . '
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-info" href="' . action('CoachingController@add_branch', 'id=' . $post->id) . '" aria-label="Add Center Branches" data-balloon-pos="up"><i class="fas fa-plus"></i></a>
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-info" href="' . action('CoachingController@view_coaching_centers_branches', 'id=' . $post->id) . '" aria-label="View Center Branches" data-balloon-pos="up"><i class="fas fa-eye"></i></a>
                </div>';

                $data[] = $nestedData;
                $count += 1;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function delete_coaching_centers()
    {

        $input = request()->except('_token');

        $old_status = DB::table('coaching_centers')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('coaching_centers')->where('id', $input['id'])->update(['status' => $new_status]);

        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Coaching centers ' . $new_status . ' successfully');
        else
            return redirect()->back()->with('success', 'Coaching centers ' . $new_status . ' successfully');
    }

    public function add_branch()
    {
        $input = request()->except('_token');

        if (request()->isMethod('get')) {

            if (empty($input['id'])) {
                return redirect()->action('CoachingController@view_coaching');
            }

            $coaching = DB::table('coaching')
                                ->where('id', $input['id'])
                                ->first();

            if (empty($coaching)) {
                return back()->with('error', 'Invalid coaching id provided');
            } else {
                $coaching_id = $input['id'];
            }

            
            $states = DB::table('states')
                        ->select('id', 'name')
                        ->where('status', 1)
                        ->get();
            $countries = DB::table('countries')
                        ->select('id', 'name')
                        ->get();

            return view('coaching.add_branch', compact('coaching_id', 'states','countries'));
        } else {

            $is_exists = DB::table('coaching')
                ->where('id', $input['coaching_id'])
                ->exists();

            if (!$is_exists) {
                return back()->with('error', 'Coaching does not exists');
            }

            $branches = $input['branch'];

            if (!empty($branches)) {
                foreach ($branches as $branch) {
                    
                    $city = DB::table('cities')
                                ->where('id', $branch['city_id'])
                                ->orWhere('name', $branch['city_id'])
                                ->first();
                    
                    // dd($city);
                    
                    if( empty($city) ) {
                        return redirect()->back()->with('error', 'City does not exists');
                    }

                    $center_data = array();
                    $center_data['coaching_id'] = $input['coaching_id'];
                    $center_data['name'] = $city->name;

                    $coaching_center = DB::table('coaching_centers')
                                        ->where('coaching_id', $input['coaching_id'])
                                        ->where('name', $city->name)
                                        ->first();

                    if( !empty($coaching_center) ) {   

                        $coaching_centers_id = $coaching_center->id;

                    } else {

                        $coaching_centers_id = DB::table('coaching_centers')->insertGetId($center_data);
                    
                    }

                    $branch_data = array();
                    $branch_data['coaching_id'] = $input['coaching_id'];
                    $branch_data['coaching_centers_id'] = $coaching_centers_id;
                    $branch_data['name'] = $branch['name'];
                    $branch_data['address'] = $branch['address'];
                    $branch_data['mobile'] = $branch['mobile'];
                    $branch_data['email'] = $branch['email'];
                    $branch_data['website'] = $branch['website'];
                    $branch_data['twitter'] = !empty($branch['twitter']) ? $branch['twitter'] : '';
                    $branch_data['instagram'] = !empty($branch['instagram']) ? $branch['instagram'] : '';
                    $branch_data['facebook'] = !empty($branch['facebook']) ? $branch['facebook'] : '';
                    $branch_data['youtube'] = !empty($branch['youtube']) ? $branch['youtube'] : '';
                    $branch_data['linkedin'] = !empty($branch['linkedin']) ? $branch['linkedin'] : '';
                    $branch_data['latitude'] = !empty($branch['latitude']) ? $branch['latitude'] : '';
                    $branch_data['longitude'] = !empty($branch['longitude']) ? $branch['longitude'] : '';
                    
                    $is_already_exists = DB::table('coaching_centers_branches')
                                        ->where('coaching_id', $input['coaching_id'])
                                        ->where('name', $branch['name'])
                                        ->exists();

                    if($is_already_exists) {
                        return redirect()
                                ->back()
                                ->with('error', 'This branch already exists');
                    }

                    DB::table('coaching_centers_branches')->insert($branch_data);
                }
            }

            return redirect()
                        ->action('CoachingController@view_coaching')
                        ->with('success', 'Coaching branch Added successfully');
        }
    }

    public function view_coaching_centers_branches()
    {
        $input = request()->except('_token');

        if (empty($input['id'])) {
            return redirect()->action('CoachingController@view_coaching');
        }

        $coaching = DB::table('coaching')
            ->where('id', $input['id'])
            ->first();

        if (empty($coaching)) {
            return back()->with('error', 'Invalid coaching id provided');
        } else {
            $coaching_id = $input['id'];
        }

        $coaching_name = $coaching->name;

        return view('coaching.view_coaching_centers_branches', compact('coaching_id', 'coaching_name'));
    }

    public function view_coaching_centers_branches_dt(Request $request)
    {

        $columns = array(
            0 => 'coaching_centers_branches.id',
            1 => 'coaching_centers.name',
            2 => 'coaching_centers_branches.name',
            3 => 'coaching_centers_branches.created_at',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $coaching_id = $request->input('coaching_id');

        $query = DB::table('coaching_centers_branches')
                    ->where('coaching_centers_branches.coaching_id', $coaching_id)
                    ->join('coaching_centers', 'coaching_centers.id', 'coaching_centers_branches.coaching_centers_id');

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('coaching_centers_branches.name', 'LIKE', '%' . $name . '%');
            }
        }

        if(request()->has('start_date')){
            $start_date = request('start_date');
            
            if($start_date!=""){
                $query = $query->whereDate('coaching_centers_branches.created_at', '>=',date('Y-m-d',strtotime($start_date)));
            }
        }

        if(request()->has('end_date')){
            $end_date = request('end_date');
            if($end_date!=""){
                $query = $query->whereDate('coaching_centers_branches.created_at', '<=',date('Y-m-d',strtotime($end_date)));
            }
        }

        $totalData = $query->count();
        $totalFiltered = $totalData;

        $posts = $query
            ->offset($start)
            ->limit($limit);

        if(
            $request->input('order.0.column') == 0 and $request->input('order.0.dir') == 'asc'
        ) {
            $posts = $posts->orderBy('created_at', 'desc');
        } else {
            $posts = $posts->orderBy($order, $dir);
        }
    
        $posts = $posts
            ->select('coaching_centers_branches.*', 'coaching_centers.name as coaching_centers_name')
            ->get();

        if (!empty($posts)) {
            $data = array();
            if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                $count = $totalFiltered - $start;
            } else {
                $count = $start + 1;
            }

            foreach ($posts as $post) {

                $confirm = "return confirmation('Are you sure?') ";
                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('CoachingController@delete_coaching_centers_branches', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('CoachingController@delete_coaching_centers_branches', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';

                $nestedData['coaching_centers_name'] = $post->coaching_centers_name;
                $nestedData['name'] = $post->name;
                
                if( strlen($post->address) >= 40 ) {
                    $nestedData['address'] = '<span data-balloon-length="xlarge" aria-label="' . $post->address . '" data-balloon-pos="up">' . substr($post->address, 0, 40) . '...</span>';
                } else {
                    $nestedData['address'] = $post->address;
                }
    
                $nestedData['mobile'] = $post->mobile;
                $nestedData['email'] = $post->email;
                $nestedData['website'] = $post->website;
                $nestedData['status'] = $post->status;
                
                $nestedData['created_at'] = date('d/m/Y', strtotime($post->created_at));
                $nestedData['action'] = '<div class="d-flex"><a href="' . action('CoachingController@edit_coaching_centers_branches', 'id=' . $post->id) . '" class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-primary" Z  aria-label="Edit" data-balloon-pos="up">
                <i class="fad fa-pencil"></i>
                </a>                
                ' . $new_status . '</div>';

                $data[] = $nestedData;
                if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                    $count -= 1;
                } else {
                    $count += 1;
                }
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function edit_coaching_centers_branches()
    {

        $input = request()->except('_token');

        if (request()->isMethod('get')) {
            
            if (empty($input['id'])) {
                return redirect()->action('CoachingController@view_coaching');
            }

            $coaching_centers_branch = DB::table('coaching_centers_branches')
                                        ->where('id', $input['id'])
                                        ->first();

            if(! $coaching_centers_branch) {
                abort(404);
            }

            $coaching_name = DB::table('coaching')
                                ->where('id', $coaching_centers_branch->coaching_id)
                                ->value('name');

            $coaching_id = $coaching_centers_branch->coaching_id;
            
            $countries = DB::table('countries')
                        ->select('id', 'name')
                        ->get();

            # get country, state from center
            $coaching_centers_branch->city = DB::table('coaching_centers')
                                                ->join('cities', 'cities.name', 'coaching_centers.name')
                                                ->where('coaching_centers.id', $coaching_centers_branch->coaching_centers_id)
                                                ->value('cities.id');

            $state_id = DB::table('cities')
                            ->where('id', $coaching_centers_branch->city)
                            ->value('state_id');
                        
            $state = DB::table('states')
                            ->where('id', $state_id)
                            ->first();

            $country_id = $state->country_id;

            $coaching_centers_branch->state = $state->id;

            $coaching_centers_branch->country = DB::table('countries')
                                                ->where('id', $country_id)
                                                ->value('id');
            # get country, state from center

            return view('coaching.edit_coaching_centers_branches', compact('coaching_centers_branch', 'coaching_name', 'coaching_id', 'countries'));

        } else {

            $input = array_merge($input, $input['branch'][0]);

            unset($input['branch']);

            $is_exists = DB::table('coaching_centers_branches')
                ->where('id', '!=', $input['id'])
                ->where('name', $input['name'])
                ->where('coaching_id', $input['coaching_id'])
                ->exists();

            if ($is_exists) {
                return back()->with('error', 'This branch already exists');
            }

            $city = DB::table('cities')
                        ->where('id', $input['city_id'])
                        ->first();
             
            $coaching_centers_id = $input['coaching_centers_id'];
            
            if( !empty($city) ) {
                
                $center_data = array();
                $center_data['coaching_id'] = $input['coaching_id'];
                $center_data['name'] = $city->name;
                
                $coaching_center = DB::table('coaching_centers')
                ->where('coaching_id', $input['coaching_id'])
                ->where('name', $city->name)
                ->first();
                
                if( !empty($coaching_center) ) {   
                    
                    $coaching_centers_id = $coaching_center->id;
                } else {
                    
                    $coaching_centers_id = DB::table('coaching_centers')->insertGetId($center_data);
                    
                }
            }
                
            $branch_data = array();
            $branch_data['coaching_id'] = $input['coaching_id'];
            $branch_data['coaching_centers_id'] = $coaching_centers_id;
            $branch_data['name'] = $input['name'];
            $branch_data['address'] = $input['address'];
            $branch_data['mobile'] = $input['mobile'];
            $branch_data['email'] = $input['email'];
            $branch_data['website'] = $input['website'];
            $branch_data['twitter'] = !empty($input['twitter']) ? $input['twitter'] : '';
            $branch_data['instagram'] = !empty($input['instagram']) ? $input['instagram'] : '';
            $branch_data['facebook'] = !empty($input['facebook']) ? $input['facebook'] : '';
            $branch_data['youtube'] = !empty($input['youtube']) ? $input['youtube'] : '';
            $branch_data['linkedin'] = !empty($input['linkedin']) ? $input['linkedin'] : '';
            $branch_data['latitude'] = !empty($input['latitude']) ? $input['latitude'] : '';
            $branch_data['longitude'] = !empty($input['longitude']) ? $input['longitude'] : '';

            // update main branch work
           $old_address = DB::table('coaching_centers_branches')
                                ->where('id', $input['id'])
                                ->value('address');
           // update main branch work

            DB::table('coaching_centers_branches')->where('id', $input['id'])->update($branch_data);

            // update main branch
            $is_main_branch = DB::table('coaching_centers_branches')
                                ->where('id', $input['id'])
                                ->value('is_main_branch');

            if( $is_main_branch ) {

                $coaching = array();

                $country_id = $coaching['country_id'] = $input['country_id'];

                $state_id = $coaching['state_id'] = $input['state_id'];

                $city_id = $coaching['city_id'] = $input['city_id'];
                
                $coaching['state'] = DB::table('states')
                                    ->where('id', $state_id)
                                    ->value('name');
                $coaching['country'] = DB::table('countries')
                                    ->where('id', $country_id)
                                    ->value('name');
                $coaching['city'] = DB::table('cities')
                                    ->where('id', $city_id)
                                    ->value('name');
                
                $coaching['address'] = $input['address'] ?? '';

                $coaching['latitude'] = $branch_data['latitude'];
                $coaching['longitude'] = $branch_data['longitude'];
                
                $coaching['mobile'] = $input['mobile'];
                $coaching['email'] = $input['email'];


                DB::table('coaching')
                ->where('id', $input['coaching_id'])
                ->update($coaching);
            }

            return redirect()
                    ->action('CoachingController@view_coaching_centers_branches', 'id='.$input['coaching_id'])
                    ->with('success', 'Branch Updated successfully');
        }
    }

    public function delete_coaching_centers_branches()
    {

        $input = request()->except('_token');

        $old_status = DB::table('coaching_centers_branches')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('coaching_centers_branches')->where('id', $input['id'])->update(['status' => $new_status]);

        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Coaching branch ' . $new_status . ' successfully');
        else 
            return redirect()->back()->with('success', 'Coaching branch ' . $new_status . ' successfully');
    }

    # coaching testimonials
    public function add_testimonials()
    {

        $input = request()->except('_token');

        if (request()->isMethod('get')) {

            if (empty($input['id'])) {
                return redirect()->action('CoachingController@view_coaching');
            }

            $coaching = DB::table('coaching')
                ->where('id', $input['id'])
                ->first();

            if (empty($coaching)) {
                return back()->with('error', 'Invalid coaching id provided');
            } else {
                $coaching_id = $input['id'];
            }

            $coaching_name = $coaching->name;

            $coaching_courses = DB::table('courses')
                                    ->where('type', 'coaching')
                                    ->where('status','enable')
                                    ->get();

            return view('coaching.add_testimonials', compact('coaching_courses', 'coaching_id', 'coaching_name'));
        } else {

            $is_exists = DB::table('coaching')
                ->where('id', $input['coaching_id'])
                ->exists();

            if (!$is_exists) {
                return back()->with('error', 'Coaching does not exists');
            }

            $testimonials = $input['testimonials'];

            if (!empty($testimonials)) {
                foreach ($testimonials as $testimonial) {

                    $testimonial_data = array();
                    $testimonial_data['coaching_id'] = $input['coaching_id'];
                    $testimonial_data['coaching_courses_id'] = $testimonial['coaching_courses_id'];
                    $testimonial_data['name'] = $testimonial['name'];
                    $testimonial_data['rank'] = !empty($testimonial['rank']) ? $testimonial['rank'] : '';
                    $testimonial_data['category'] = !empty($testimonial['category']) ? $testimonial['category'] : '';
                    $testimonial_data['year'] = !empty($testimonial['year']) ? $testimonial['year'] : '';
                    $testimonial_data['description'] = !empty($testimonial['description']) ? $testimonial['description'] : '';

                    if( !empty($testimonial['image']) ) {
                     
                        $image = '';

                        $file = $testimonial['image'];

                        $thumbnailPath = public_path('coaching_testimonials/');

                        $fileName = 'coaching_testimonials-' . time() . random_int(0, 10);

                        $testimonial_data['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                        if ($testimonial_data['image'] == '') {
                            return redirect()->back()->with('error', 'invalid image provided');
                        }
                    }

                    DB::table('coaching_testimonials')->insert($testimonial_data);
                }
            }

            return redirect()
                    ->action('CoachingController@view_coaching')
                    ->with('success', 'Coaching testimonials Added successfully');
        }
    }

    public function view_coaching_testimonials()
    {
        $input = request()->except('_token');

        if (empty($input['id'])) {
            return redirect()->action('CoachingController@view_coaching');
        }

        $coaching = DB::table('coaching')
            ->where('id', $input['id'])
            ->first();

        if (empty($coaching)) {
            return back()->with('error', 'Invalid coaching id provided');
        } else {
            $coaching_id = $input['id'];
        }

        $coaching_name = $coaching->name;

        return view('coaching.view_coaching_testimonials', compact('coaching_id', 'coaching_name'));
    }

    public function view_coaching_testimonials_dt(Request $request)
    {

        $columns = array(
            0 => 'coaching_testimonials.id',
            1 => 'courses.name',
            2 => 'coaching_testimonials.name',
            3 => 'coaching_testimonials.name',
            4 => 'coaching_testimonials.created_at',
            5 => 'coaching_testimonials.year',
            6 => 'coaching_testimonials.status',
            7 => 'coaching_testimonials.image',
            8 => 'coaching_testimonials.description',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $coaching_id = $request->input('coaching_id');

        $query = DB::table('coaching_testimonials')
            ->join('courses', 'courses.id', 'coaching_testimonials.coaching_courses_id')
            ->where('coaching_testimonials.coaching_id', $coaching_id);

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('coaching_testimonials.name', 'LIKE', '%' . $name . '%');
            }
        }
        if(request()->has('start_date')){
            $start_date = request('start_date');
            
            if($start_date!=""){
                $query = $query->whereDate('coaching_testimonials.created_at', '>=',date('Y-m-d',strtotime($start_date)));
            }
        }

        if(request()->has('end_date')){
            $end_date = request('end_date');
            if($end_date!=""){
                $query = $query->whereDate('coaching_testimonials.created_at', '<=',date('Y-m-d',strtotime($end_date)));
            }
        }

        $totalData = $query->count();
        $totalFiltered = $totalData;

        $posts = $query
            ->offset($start)
            ->limit($limit);

        if(
            $request->input('order.0.column') == 0 and $request->input('order.0.dir') == 'asc'
        ) {
            $posts = $posts->orderBy('created_at', 'desc');
        } else {
            $posts = $posts->orderBy($order, $dir);
        }
    
        $posts = $posts
            ->select('coaching_testimonials.*', 'courses.name as coaching_courses_name')
            ->get();

        $coaching_courses = DB::table('courses')
                            ->where('type', 'coaching')
                            ->where('status','enable')
                            ->get();
                            
        if (!empty($posts)) {
            $data = array();
            if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                $count = $totalFiltered - $start;
            } else {
                $count = $start + 1;
            }

            foreach ($posts as $post) {

                $year_list = '<div class="form-group"><select name="year" id="year" required class="form-control  show-tick" data-width="full" data-container="body" data-live-search="true">
                <option value="" disabled selected>Select Year</option>';

                foreach(range(date('Y'), 1970) as $year) {
                    $is_selected = '';

                    if($post->year == $year) {
                        $is_selected = 'selected';
                    }

                    $year_list .= '<option value="'.$year.'" '.$is_selected.'>'.$year.'</option>';
                }

                $year_list .= '</select></div>';

                $confirm = "return confirmation('Are you sure?') ";

                $default_img = "this.src='" . asset("public/logo.png") . "'";

                $image = asset('public/coaching_testimonials/' . $post->image);

                if (!@GetImageSize($image)) {
                    $image = asset('public/logo.png');
                }

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('CoachingController@delete_coaching_testimonials', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('CoachingController@delete_coaching_testimonials', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';

                $nestedData['coaching_courses_name'] = $post->coaching_courses_name;
                $nestedData['name'] = $post->name;
                $nestedData['rank'] = $post->rank;
                $nestedData['category'] = $post->category;
                $nestedData['year'] = $post->year;
                $nestedData['status'] = $post->status;
                
                $nestedData['created_at'] = date('d/m/Y', strtotime($post->created_at));
                
                if( strlen($post->description) >= 40 ) {
                    $nestedData['description'] = '<span data-balloon-length="xlarge" aria-label="' . $post->description . '" data-balloon-pos="up">' . substr($post->description, 0, 40) . '...</span>';
                } else {
                    $nestedData['description'] = $post->description;
                }
                
                $nestedData['image'] = '<img src="' . asset('public/coaching_testimonials/' . $post->image) . '" width=60 onerror="' . $default_img . '">';
                $nestedData['action'] = '<div class="d-flex"><button type="button" class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-primary" data-toggle="modal" data-target="#exampleModalCenter' . $post->id . '" aria-label="Edit" data-balloon-pos="up">
                <i class="fad fa-pencil"></i>
                </button>
                <div class="modal fade" id="exampleModalCenter' . $post->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter' . $post->id . 'Title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit testimonials</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form action="' . action('CoachingController@edit_coaching_testimonials') . '" class="form" enctype="multipart/form-data" method="post">                                
                                ' . csrf_field() . '
                                <input type="hidden" class="form-control" value="' . $post->id . '" name="id">
                                <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <input type="file" class="form-control uploaded" style="--upload-pic:url(' . $image . ');" upload-pic="" name="image">
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal" class="upload-pic-view d-none" id="pdf-eye"><i class="fas fa-eye"></i></a>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Course</label><br>
                                            <select class="form-control  show-tick" data-width="full" data-container="body" data-live-search="true" required name="coaching_courses_id">
                                                 <option value="">Select Course</option>';

                                            if (!empty($coaching_courses)) {
                                                foreach ($coaching_courses as $course) {

                                                    $is_selected = '';

                                                    if ($course->name == $post->coaching_courses_name) {
                                                        $is_selected = 'selected';
                                                    }

                                                  $nestedData['action'] .=  '<option value="' . $course->id . '" ' . $is_selected . '>' . $course->name . '</option>';
                                                }
                                            }

        $nestedData['action'] .= '</select>
                                </div> 
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" value="' . $post->name . '" name="name" required placeholder="Enter Name">
                                </div>                           
                                <div class="form-group">
                                    <label class="control-label">Rank</label>
                                    <input type="text" class="form-control" value="' . $post->rank . '" name="rank" placeholder="Enter rank">
                                </div>                            
                                <div class="form-group">
                                    <label class="control-label">Category</label>
                                    <input type="text" class="form-control" value="' . $post->category . '" name="category" placeholder="Enter category">
                                </div>                            
                                <div class="form-group">
                                    <label class="control-label">Year</label>                                    
                                    '.$year_list.'
                                </div>                          
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea class="form-control" name="description" placeholder="Enter description">
                                    '. $post->description .'
                                    </textarea>
                                </div>
                                <input type="submit" class="btn btn-sm btn-primary my-2" value="Update">
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                ' . $new_status . '</div>';

                $data[] = $nestedData;
                if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                    $count -= 1;
                } else {
                    $count += 1;
                }
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function edit_coaching_testimonials()
    {

        if (request()->isMethod('get')) {
            return back();
        } else {

            $input = request()->except('_token');

            $is_exists = DB::table('coaching_testimonials')
                ->where('id', '!=', $input['id'])
                ->where('name', $input['name'])
                ->exists();

            if (!request()->file('image')) {

                unset($input['image']);
            } else {

                $image = DB::table('coaching_testimonials')->where('id', $input['id'])->value('image');

                @unlink(asset('/public/coaching_testimonials/' . $image));

                $file = request('image');

                $thumbnailPath = public_path('coaching_testimonials/');

                $fileName = 'testimonials-' . time() . random_int(0, 10);

                $input['image'] = Helpers::imageSingleUpload($file, $thumbnailPath, $fileName);

                if ($input['image'] == '') {
                    return redirect()->back()->with('error', 'invalid image provided');
                }
            }

            DB::table('coaching_testimonials')->where('id', $input['id'])->update($input);

            return redirect()->back()->with('success', 'Coaching testimonials Updated successfully');
        }
    }

    public function delete_coaching_testimonials()
    {

        $input = request()->except('_token');

        $old_status = DB::table('coaching_testimonials')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('coaching_testimonials')->where('id', $input['id'])->update(['status' => $new_status]);

        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Coaching testimonials ' . $new_status . ' successfully');
        else
            return redirect()->back()->with('success', 'Coaching testimonials ' . $new_status . ' successfully');
    }
    
    public function  add_courses_detail ()
    {
        $input = request()->except('_token');

        if (request()->isMethod('get')) {

            if (empty($input['id'])) {
                return redirect()->action('CoachingController@view_coaching');
            }

            $coaching = DB::table('coaching')
                        ->where('id', $input['id'])
                        ->first();

            if (empty($coaching)) {
                return back()->with('error', 'Invalid coaching id provided');
            } else {
                $coaching_id = $input['id'];
            }

            $coaching_name = $coaching->name;

            $streams = DB::table('streams')
                        ->select('id', 'name')
                        ->where('status', 'enable')
                        ->get();

            return view('coaching.add_courses_detail', compact('coaching_id', 'streams', 'coaching_name'));
        } else {

            $is_exists = DB::table('coaching')
                            ->where('id', $input['coaching_id'])
                            ->exists();

            if (!$is_exists) {
                return back()->with('error', 'Coaching does not exists');
            }

            $courses = $input['courses_detail'];

            if (!empty($courses)) {
                foreach ($courses as $courses_detail) {

                    $course = DB::table('courses')
                                ->where('id', $courses_detail['course_id'])
                                ->first();
                    
                    if( empty($course) ) {
                        return redirect()->back()->with('error', 'Course does not exists');
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

                        $coaching_courses_id = DB::table('coaching_courses')->insertGetId($course_data);
                    
                    }
                    
                    $courses_detail_data = array();
                    $courses_detail_data['coaching_id'] = $input['coaching_id'];
                    $courses_detail_data['coaching_courses_id'] = $coaching_courses_id;
                    $courses_detail_data['offering'] = implode(',', $courses_detail['offering']);
                    $courses_detail_data['name'] = $courses_detail['name'] ?? '';
                    $courses_detail_data['targeting'] = $courses_detail['targeting'] ?? '';
                    $courses_detail_data['description'] = $courses_detail['description'] ?? '';
                    $courses_detail_data['duration'] = $courses_detail['duration'] ?? '';
                    $courses_detail_data['batch_details'] = $courses_detail['batch_details'] 
                         ?? '';
                    $courses_detail_data['fee'] = $courses_detail['fee'] ?? 0;
                    $courses_detail_data['registration_fee'] = $courses_detail['registration_fee'] ?? 0;
                    $courses_detail_data['gst_inclusive_exclusive'] = $courses_detail['gst_inclusive_exclusive'] ?? '';
                    $courses_detail_data['fee_type'] = $courses_detail['fee_type'] ?? '';
                    $courses_detail_data['offer_percentage'] = $courses_detail['offer_percentage'] ?? 0;

                    $courses_detail_data['is_paid'] = !empty($courses_detail['is_paid']) ? $courses_detail['is_paid'] : '';
                    
                    $is_already_exists = DB::table('coaching_courses_detail')
                                        ->where('coaching_id', $input['coaching_id'])
                                        ->where('coaching_courses_id', $coaching_courses_id)
                                        ->where('name', $courses_detail['name'])
                                        ->exists();

                    if($is_already_exists) {
                        return redirect()
                                ->back()
                                ->with('error', 'This course already exists');
                    }

                    DB::table('coaching_courses_detail')->insert($courses_detail_data);
                }
            }

            return redirect()
                    ->action('CoachingController@view_coaching')
                    ->with('success', 'Coaching courses detail added successfully');
        }
    }

    public function view_coaching_courses_detail()
    {
        $input = request()->except('_token');

        if (empty($input['id'])) {
            return redirect()->action('CoachingController@view_coaching');
        }

        $coaching = DB::table('coaching')
                        ->where('id', $input['id'])
                        ->first();

        if (empty($coaching)) {
            return back()->with('error', 'Invalid coaching id provided');
        } else {
            $coaching_id = $input['id'];
        }

        $coaching_name = $coaching->name;

        return view('coaching.view_coaching_courses_detail', compact('coaching_id', 'coaching_name'));
    }

    public function view_coaching_courses_detail_dt(Request $request)
    {

        $columns = array(
            0 => 'coaching_courses_detail.id',
            1 => 'coaching_courses_detail.name',
            2 => 'coaching_courses.name',
            3 => 'coaching_courses_detail.name',
            4 => 'coaching_courses_detail.fee',
            5 => 'coaching_courses_detail.offer_percentage',
            6 => 'coaching_courses_detail.is_paid',
            7 => 'coaching_courses_detail.created_at',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $coaching_id = $request->input('coaching_id');

        $query = DB::table('coaching_courses_detail')
                    ->where('coaching_courses_detail.coaching_id', $coaching_id)
                    ->join('coaching_courses', 'coaching_courses.id', 'coaching_courses_detail.coaching_courses_id');

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('coaching_courses_detail.name', 'LIKE', '%' . $name . '%');
            }
        }
        if(request()->has('start_date')){
            $start_date = request('start_date');
            
            if($start_date!=""){
                $query = $query->whereDate('coaching_courses_detail.created_at', '>=',date('Y-m-d',strtotime($start_date)));
            }
        }

        if(request()->has('end_date')){
            $end_date = request('end_date');
            if($end_date!=""){
                $query = $query->whereDate('coaching_courses_detail.created_at', '<=',date('Y-m-d',strtotime($end_date)));
            }
        }

        $posts = $query;

        if(
            $request->input('order.0.column') == 0 and $request->input('order.0.dir') == 'asc'
        ) {
            $posts = $posts->orderBy('created_at', 'desc');
        } else {
            $posts = $posts->orderBy($order, $dir);
        }
        
        $totalData = $posts->count();
        $totalFiltered = $totalData;

        $posts = $posts
            ->offset($start)
            ->limit($limit);
    
        $posts = $posts
            ->select('coaching_courses_detail.*', 'coaching_courses.name as coaching_courses_name')
            ->get();

        if (!empty($posts)) {
            $data = array();
            if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                $count = $totalFiltered - $start;
            } else {
                $count = $start + 1;
            }

            foreach ($posts as $post) {

                $confirm = "return confirmation('Are you sure?') ";
                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('CoachingController@delete_coaching_courses_detail', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('CoachingController@delete_coaching_courses_detail', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';
                
                $is_featured = '';
                if($post->is_featured) {
                   $is_featured = 'active'; 
                }

                $is_featured = '
                <form 
                    class="is_featured"
                    method="post"
                    action="'.action('CoachingController@is_featured_course').'?id='.$post->id.'">'
                .csrf_field().'
                <input type="hidden" name="id" value="'.$post->id.'" />
                <button 
                type="submit" 
                class="'.$is_featured.' btn-sm btn btn-outline-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"></path>
                    </svg>
                    <span class="visually-hidden"></span>
                </button>';

                $nestedData['is_featured'] = $is_featured;
                
                $nestedData['coaching_courses_name'] = $post->coaching_courses_name;
                $nestedData['name'] = $post->name;
                $nestedData['offering'] = $post->offering;
                $nestedData['targeting'] = $post->targeting;
                $nestedData['description'] = $post->description;
                $nestedData['duration'] = $post->duration;
                $nestedData['batch_details'] = $post->batch_details;
                $nestedData['fee'] = $post->fee;
                $nestedData['gst_inclusive_exclusive'] = $post->gst_inclusive_exclusive;
                $nestedData['fee_type'] = $post->fee_type;
                $nestedData['offer_percentage'] = $post->offer_percentage;
                $nestedData['status'] = $post->status;
                $nestedData['is_paid'] = $post->is_paid;
                
                $nestedData['created_at'] = date('d/m/Y', strtotime($post->created_at));
                $nestedData['action'] = '
                <div class="d-flex align-items-center">
                <a class="btn btn-sm w-30px h-30px d-grid p-0 align-items-center justify-content-center mx-1 btn-primary" href="' . action('CoachingController@edit_coaching_courses_detail', 'id=' . $post->id) . '" aria-label="Edit Courses Detail" data-balloon-pos="up"><i class="fas fa-pencil"></i></a>
                ' . $new_status . '</div>';

                $data[] = $nestedData;
                if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                    $count -= 1;
                } else {
                    $count += 1;
                }
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function edit_coaching_courses_detail()
    {
        $input = request()->except('_token');

        if (request()->isMethod('get')) {
            
            if (empty($input['id'])) {
                return redirect()->action('CoachingController@view_coaching');
            }

            $coaching_courses_detail = DB::table('coaching_courses_detail')
                                        ->where('id', $input['id'])
                                        ->first();

            $coaching_name = DB::table('coaching')
                                ->where('id', $coaching_courses_detail->coaching_id)
                                ->value('name');

            $course = DB::table('coaching_courses')
                        ->join('courses', 'courses.name', 'coaching_courses.name')
                        ->where('coaching_courses.id', $coaching_courses_detail->coaching_courses_id)
                        ->select('courses.id','courses.stream_id')
                        ->first();
                        
            $coaching_courses_detail->stream_id = $course->stream_id;
            $coaching_courses_detail->course_id = $course->id;
            
            $streams = DB::table('streams')->select('id', 'name')->get();
            $courses = DB::table('courses')
                        ->select('id', 'name')
                        ->where('stream_id', $course->stream_id)
                        ->get();

            return view('coaching.edit_coaching_courses_detail', compact('streams','coaching_courses_detail', 'coaching_name', 'courses'));
        } else {

            $coaching_courses_detail = DB::table('coaching_courses_detail')
                                        ->where('id', $input['id'])
                                        ->first();

            $input['coaching_id'] = $coaching_courses_detail->coaching_id;
            
            $input['offering'] = implode(',', $input['offering']);
            

            $course = DB::table('courses')
                        ->where('id', $input['course_id'])
                        ->first();
            
            if( empty($course) ) {
                return redirect()->back()->with('error', 'Course does not exists');
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

                $coaching_courses_id = DB::table('coaching_courses')->insertGetId($course_data);
            
            }

            $input['coaching_courses_id'] = $coaching_courses_id;

            unset(
                $input['stream_id'],
                $input['course_id']
            );
            
            $is_already_exists = DB::table('coaching_courses_detail')
                                ->where('id', '!=', $input['id'])
                                ->where('coaching_id', $input['coaching_id'])
                                ->where('coaching_courses_id', $input['coaching_courses_id'])
                                ->where('name', $input['name'])
                                ->exists();

            if($is_already_exists) {
                return redirect()
                        ->back()
                        ->with('error', 'This course already exists');
            }
            
            DB::table('coaching_courses_detail')->where('id', $input['id'])->update($input);

            return redirect()
                    ->action('CoachingController@view_coaching_courses_detail', 'id='.$coaching_courses_detail->coaching_id)
                    ->with('success', 'Course detail updated successfully');
        }
    }

    public function delete_coaching_courses_detail()
    {

        $input = request()->except('_token');

        $old_status = DB::table('coaching_courses_detail')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('coaching_courses_detail')->where('id', $input['id'])->update(['status' => $new_status]);

        if($new_status == 'disable')
            return redirect()->back()->with('danger', 'Coaching course detail ' . $new_status . ' successfully');
        else 
            return redirect()->back()->with('success', 'Coaching course detail ' . $new_status . ' successfully');
    }

    
    public function view_coaching_reviews()
    {
        $input = request()->except('_token');

        if (empty($input['id'])) {
            return redirect()->action('CoachingController@view_coaching');
        }

        $coaching = DB::table('coaching')
            ->where('id', $input['id'])
            ->first();

        if (empty($coaching)) {
            return back()->with('error', 'Invalid coaching id provided');
        } else {
            $coaching_id = $input['id'];
        }

        $coaching_name = $coaching->name;

        return view('coaching.view_coaching_reviews', compact('coaching_id', 'coaching_name'));
    }

    public function view_coaching_reviews_dt(Request $request)
    {

        $columns = array(
            0 => 'coaching_reviews.id',
            1 => 'students.name',
            2 => 'coaching_reviews.course',
            3 => 'coaching_reviews.description',
            4 => 'coaching_reviews.id',
            5 => 'coaching_reviews.created_at',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $coaching_id = $request->input('coaching_id');

        $query = DB::table('coaching_reviews')
            ->join('students', 'students.id', 'coaching_reviews.user_id')
            ->where('coaching_reviews.coaching_id', $coaching_id);

        if (request()->has('name')) {
            $name = request('name');
            if ($name != "") {
                $query->where('students.name', 'LIKE', '%' . $name . '%');
            }
        }

        if(request()->has('start_date')){
            $start_date = request('start_date');
            
            if($start_date!=""){
                $query = $query->whereDate('coaching_reviews.created_at', '>=',date('Y-m-d',strtotime($start_date)));
            }
        }

        if(request()->has('end_date')){
            $end_date = request('end_date');
            if($end_date!=""){
                $query = $query->whereDate('coaching_reviews.created_at', '<=',date('Y-m-d',strtotime($end_date)));
            }
        }
        $totalData = $query->count();
        $totalFiltered = $totalData;

        $posts = $query
            ->offset($start)
            ->limit($limit);

        if(
            $request->input('order.0.column') == 0 and $request->input('order.0.dir') == 'asc'
        ) {
            $posts = $posts->orderBy('created_at', 'desc');
        } else {
            $posts = $posts->orderBy($order, $dir);
        }
    
        $posts = $posts
            ->select('coaching_reviews.*', 'students.name as student_name')
            ->get();

        if (!empty($posts)) {
            $data = array();
            if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                $count = $totalFiltered - $start;
            } else {
                $count = $start + 1;
            }

            foreach ($posts as $post) {

                DB::table('coaching_reviews')
                ->where('id', $post->id)
                ->update([
                    'is_seen' => 1
                ]);

                $confirm = "return confirmation('Are you sure?') ";

                $nestedData['id'] = $count;

                $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('CoachingController@delete_coaching_reviews', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('CoachingController@delete_coaching_reviews', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';

                $nestedData['student_name'] = $post->student_name;
                $nestedData['name'] = $post->course;
                $nestedData['status'] = $post->status;
                
                $nestedData['created_at'] = date('d/m/Y', strtotime($post->created_at));
                $nestedData['action'] = $new_status;

                # ratings of student                
                $faculty_stars = $post->faculty_stars;
                $study_materials_stars = $post->study_materials_stars;
                $doubt_clearing_stars = $post->doubt_clearing_stars;
                $mentorship_stars = $post->mentorship_stars;
                $tech_support_stars = $post->tech_support_stars;
                               
                $total_stars = ($faculty_stars + $study_materials_stars + $doubt_clearing_stars + $mentorship_stars + $tech_support_stars);
                
                $total_ratings = $total_stars / 1;

                $total_ratings = ($total_ratings / 5); # as total ratings mediums are 5

                $total_ratings = is_float($total_ratings) ? 
                                    number_format($total_ratings, 1, '.', '') :
                                    $total_ratings;
                # ratings of student

                $nestedData['total_ratings'] = $total_ratings;
                $nestedData['description'] = '<p style="white-space: initial;">'.$post->description.'</p>';

                $data[] = $nestedData;
                if($request->input('order.0.column') == '0' and $request->input('order.0.dir') == 'desc') {
                    $count -= 1;
                } else {
                    $count += 1;
                }
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }    

    public function delete_coaching_reviews()
    {

        $input = request()->except('_token');

        $old_status = DB::table('coaching_reviews')->where('id', $input['id'])->value('status');

        $new_status = ($old_status == 'enable') ? 'disable' : 'enable';

        DB::table('coaching_reviews')->where('id', $input['id'])->update(['status' => $new_status]);

        if($new_status == 'disable') {
            
            try {
  
                // send mail
                
                $review = DB::table('coaching_reviews')
                            ->where('id', $input['id'])
                            ->first();
                            
                $email = DB::table('students')
                        ->where('students.id', $review->user_id)
                        ->value('students.email');
                        
                $student_name = DB::table('students')
                                ->where('students.id', $review->user_id)
                                ->value('students.name');
                        
                $coaching_name = DB::table('coaching')
                                ->where('coaching.id', $review->coaching_id)
                                ->value('coaching.name');
                 
                $review = $review->description;
                
                $subject = $student_name.', Sorry your review was not approved';
                
                if( !empty($email) ) {
                        
                    $datamessage['email']=$email;
            		$datamessage['subject']=$subject;
            		
            	    \Mail::send('mails.review_unapproved', compact('student_name', 'coaching_name', 'review'), function ($m) use ($datamessage){
            			$m->from('support@coachingselect.com', 'CoachingSelect');
            			$m->to($datamessage['email'])->subject($datamessage['subject']);
            		});
            		
                }
                                
            } catch(\Exception $e) {
                // ignore mail error
            }
            
            return redirect()->back()->with('danger', 'Coaching review ' . $new_status . ' successfully');
        }
        else {
            
            return redirect()->back()->with('success', 'Coaching review ' . $new_status . ' successfully');
        }
        
    }

    
    public function is_featured()
    {
        if(
            request()->isMethod('post')
        ) {

            $input = request()->except('_token');

            $old_is_featured = DB::table('coaching')->where('id', $input['id'])->value('is_featured');

            $new_is_featured = ($old_is_featured == '0') ? '1' : '0';

            DB::table('coaching')->where('id', $input['id'])->update(['is_featured' => $new_is_featured]);
    
        } else {
            return back();
        }
    }

    public function is_featured_course()
    {
        if(
            request()->isMethod('post')
        ) {

            $input = request()->except('_token');

            $old_is_featured = DB::table('coaching_courses_detail')->where('id', $input['id'])->value('is_featured');

            $new_is_featured = ($old_is_featured == '0') ? '1' : '0';

            DB::table('coaching_courses_detail')->where('id', $input['id'])->update(['is_featured' => $new_is_featured]);
    
        } else {
            return back();
        }
    }

    public function become_prime_member() {
        
        if( request()->isMethod('post') ) {

            $input = request()->all(['id']);
            $input['is_paid_member'] = 'yes';

            DB::table('coaching')
                ->where('id', $input['id'])
                ->update($input);
                               
            return redirect()
                    ->back()
                    ->with('success', 'Prime member request approved');

        } else {
            return redirect()->back();
        }

    }

}