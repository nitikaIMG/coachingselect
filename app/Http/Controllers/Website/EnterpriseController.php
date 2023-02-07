<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Hash;
use DB;

use App\Http\Controllers\Website\HeaderController;
use App\Http\Controllers\Website\FooterController;
use Request;

class EnterpriseController extends Controller
{

    public function index() {
        
        if(
            session()->has('enterprise')
        ) {
                
            $header = new HeaderController();
            $footer = new FooterController();

            $coaching_id = session()->get('enterprise')->id;
            
            $enterprise = DB::table('coaching')
                        ->where('id', $coaching_id)
                        ->first();                     

            $total_views = DB::table('coaching_views')
                            ->where('coaching_id', $coaching_id)
                            ->sum('view');

            $enterprise->total_views = $total_views;
            
            $total_reviews = DB::table('coaching_reviews')
                            ->where('coaching_id', $coaching_id)
                            ->where('coaching_reviews.status', 'enable')
                            ->count();

            $total_advertisement = DB::table('advertisement')
                                    ->where('coaching_id', $coaching_id)
                                    ->where('advertisement.status', 'enable')
                                    ->count();

            $total_courses = DB::table('orders')->join('coaching_courses_detail', 'coaching_courses_detail.id', '=', 'orders.coaching_courses_detail_id')
                        ->select('coaching_courses_detail.*')
                        ->where('coaching_courses_detail.coaching_id',$coaching_id)
                        ->where('orders.status', 'TXN_SUCCESS')
                        ->count();

            $total_searchlead = DB::table('coaching_search')
                            ->where('coaching_id', $coaching_id)
                            ->count();
                            
            $query = DB::table('request_callback');

            $q2 = DB::table('student_request_callback')
                ->join('students', 'students.id', '=', 'student_request_callback.user_id')
                ->join('coaching', 'coaching.id', '=', 'student_request_callback.coaching_id')
                ->where('is_purchase_lead', 0);

            $q2 = $q2
            ->select('students.name as name','students.email as email','students.mobile as mobile','coaching.name as coachingname', 'student_request_callback.*')
            ->get();        

            $posts = $query;
        
            $posts = $posts
                    ->get();

            $posts = $posts->merge($q2);

            $posts = $posts->sortByDesc('created_at');

            $posts = $posts->filter(
                function($data, $key) use($coaching_id){
                    return $data->coaching_id == $coaching_id;
                }
            );
            
            $total_pagelead = $posts->count();

            $enterprise->total_reviews = $total_reviews;
   
            // purchase lead
            $query = DB::table('student_request_callback')
                ->join('coaching', 'coaching.id', '=', 'student_request_callback.coaching_id')
                ->join('coaching_courses_detail', 'coaching_courses_detail.id', '=', 'student_request_callback.coaching_courses_detail_id')
                ->select('coaching.name as cname', 'coaching_courses_detail.name as ccname', 'student_request_callback.*',
                    'coaching.id as coaching_id'
                )
                ->where('is_purchase_lead', 1);

            $posts = $query;
        
            $posts = $posts
                    ->get();

            $posts = $posts->sortByDesc('created_at');

            $posts = $posts->filter(
                function($data, $key) use($coaching_id){
                    return $data->coaching_id == $coaching_id;
                }
            );
            
            $total_purchaselead = $posts->count();

            session([
                'enterprise' => $enterprise
            ]);
            
            $metatitle = "Dashboard | CoachingSelect.com";
                        
            return view('website.enterprise.index', compact('metatitle','header', 'footer', 'enterprise','total_advertisement','total_courses','total_searchlead','total_pagelead', 'total_purchaselead'));
        
        } else {

            return redirect()
                        ->action('Website\EnterpriseLoginController@login')
                        ;
        }
    }

    public function reviews(Request $request) {
        
        if(
            session()->has('enterprise')
        ) {
                
            $header = new HeaderController();
            $footer = new FooterController();

            $coaching_id = session()->get('enterprise')->id;

            $enterprise = new \stdClass();

            $query = DB::table('coaching_reviews')
                        ->join('students', 'students.id', 'coaching_reviews.user_id')
                        ->where('coaching_reviews.coaching_id', $coaching_id);
                
            $posts = $query
                ->select(
                    'coaching_reviews.*', 
                    'students.name as student_name', 
                    'students.image as student_image',
                    'students.email as student_email',
                    'students.mobile as student_mobile'
                )
                ->where('coaching_reviews.status', 'enable')
                ->get();

            if (!empty($posts)) {
                $data = array();
                
                $count = 1;

                foreach ($posts as $post) {

                    $confirm = "return confirmation('Are you sure?') ";

                    $nestedData['id'] = $count;

                    $new_status = ($post->status == 'enable') ? '<a class="btn btn-sm btn-danger" href="' . action('CoachingController@delete_coaching_reviews', 'id=' . $post->id) . '" onclick="' . $confirm . '">Disable</a>' : '<a class="btn btn-sm btn-outline-danger" href="' . action('CoachingController@delete_coaching_reviews', 'id=' . $post->id) . '" onclick="' . $confirm . '">Enable</a>';

                    $nestedData['student_name'] = $post->student_name;
                    $nestedData['student_image'] = $post->student_image;
                    $nestedData['student_email'] = $post->student_email;
                    $nestedData['student_mobile'] = $post->student_mobile;
                    $nestedData['name'] = $post->course;
                    $nestedData['status'] = $post->status;
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
                    $nestedData['description'] = $post->description;

                    $data[] = $nestedData;
                    
                    $count += 1;
                }
            }

            if( !empty($nestedData) ) {
                $posts = $data;
            } else {
                $posts = [];
            }

            $enterprise->reviews = $posts;

            $metatitle = "Enterprise Student Reviews | CoachingSelect.com";
            
            return view('website.enterprise.reviews', compact('metatitle','header', 'footer', 'enterprise'));
        
        } else {

            return redirect()
                        ->action('Website\EnterpriseLoginController@login')
                        ;
       
        }
    }


    public function totalclicks(Request $request) {
        
        if(
            session()->has('enterprise')
        ) {
                
            $header = new HeaderController();
            $footer = new FooterController();

            $coaching_id = session()->get('enterprise')->id;

            $enterprise = new \stdClass();

            $query = DB::table('advertisement')
                        ->join('coaching', 'coaching.id', 'advertisement.coaching_id')
                        ->where('advertisement.coaching_id', $coaching_id)
                        ->where('advertisement.status', 'enable');
                
            $posts = $query
                ->select(
                    'advertisement.*'
                )
                ->get();

            if (!empty($posts)) {
                $data = array();
                
                $count = 1;

                foreach ($posts as $post) {

                    $confirm = "return confirmation('Are you sure?') ";

                    $nestedData['id'] = $count;

                    $nestedData['clicks'] = $post->clicks;

                    $nestedData['type'] = $post->type;

                    $nestedData['image'] = $post->image;

                    $data[] = $nestedData;
                    
                    $count += 1;
                }
            }

            if( !empty($nestedData) ) {
                $posts = $data;
            } else {
                $posts = [];
            }

            $enterprise->totalclicks = $posts;
            
            $metatitle = "Enterprise Advertisement | CoachingSelect.com";

            return view('website.enterprise.totalclicks', compact('metatitle','header', 'footer', 'enterprise'));
        
        } else {

            return redirect()
                        ->action('Website\EnterpriseLoginController@login')
                        ;

        }
    }
    public function totalcourses(Request $request) {
        
        if(
            session()->has('enterprise')
        ) {
                
            $header = new HeaderController();
            $footer = new FooterController();

            $coaching_id = session()->get('enterprise')->id;

            $enterprise = new \stdClass();


            $query = DB::table('orders')->join('coaching_courses_detail', 'coaching_courses_detail.id', '=', 'orders.coaching_courses_detail_id')->where('coaching_courses_detail.coaching_id',$coaching_id);
                        

                
            $posts = $query
                    ->where('orders.status', 'TXN_SUCCESS')
                    ->select(
                        'orders.*','coaching_courses_detail.*'
                    )
                    ->orderBy('orders.created_at', 'desc')
                    ->get();

            if (!empty($posts)) {
                $data = array();
                
                $count = 1;

                foreach ($posts as $post) {

                    $confirm = "return confirmation('Are you sure?') ";

                    $nestedData['id'] = $count;

                    $nestedData['student_name'] = $post->student_name;

                    $nestedData['name'] = $post->name;
                    $nestedData['parent_name'] = $post->parent_name;
                    $nestedData['total_price'] = $post->total_price;

                    $discount_price = ($post->fee * $post->offer_percentage) / 100;
                    $final_price = ($post->fee - $discount_price);
                
                    if($post->gst_inclusive_exclusive == 'exclusive')
                        $final_price = $final_price+$final_price * 18 / 100;
                    
                    $nestedData['final_price'] = $final_price;
                    $nestedData['registration_fee'] = $post->registration_fee;
                    $nestedData['remaining_fee'] = $post->remaining_amount;
                    
                    if($nestedData['total_price'] != 0) {
                        $nestedData['total_price'] = '₹'.$nestedData['total_price'];
                    }
                    
                    if($nestedData['final_price'] != 0) {
                        $nestedData['final_price'] = '₹'.$nestedData['final_price'];
                    } 
                    
                    if($nestedData['registration_fee'] != 0) {
                        $nestedData['registration_fee'] = '₹'.$nestedData['registration_fee'];
                    }  
                    
                    if($nestedData['remaining_fee'] != 0) {
                        $nestedData['remaining_fee'] = '₹'.$nestedData['remaining_fee'];
                    } 

                    $nestedData['email'] = $post->email;

                    $nestedData['mobile'] = $post->mobile;

                    $data[] = $nestedData;
                    
                    $count += 1;
                }
            }

            if( !empty($nestedData) ) {
                $posts = $data;
            } else {
                $posts = [];
            }

            $enterprise->totalcourses = $posts;
            
            $metatitle = "Enterprise Courses | CoachingSelect.com";

            return view('website.enterprise.totalcourses', compact('metatitle','header', 'footer', 'enterprise'));
        
        } else {

            return redirect()
                        ->action('Website\EnterpriseLoginController@login')
                        ;
        
        }
    }
    public function searchlead(Request $request) {
        
        if(
            session()->has('enterprise')
        ) {
                
            $header = new HeaderController();
            $footer = new FooterController();

            $coaching_id = session()->get('enterprise')->id;

            $enterprise = new \stdClass();


            $query = DB::table('coaching_search')->join('students', 'students.id', '=', 'coaching_search.user_id')
                        ->select('students.*')->where('coaching_id',$coaching_id);
                
            $posts = $query
                ->select(
                    'coaching_search.*','students.*'
                )
                ->get();
            if (!empty($posts)) {
                $data = array();
                
                $count = 1;

                foreach ($posts as $post) {

                    $confirm = "return confirmation('Are you sure?') ";

                    $nestedData['id'] = $count;

                    $nestedData['name'] = $post->name;
                    $nestedData['email'] = $post->email;
                    $nestedData['mobile'] = $post->mobile;

                    $nestedData['view'] = $post->view;
                    $nestedData['status'] = $post->status;
                    $data[] = $nestedData;
                    
                    $count += 1;
                }
            }

            if( !empty($nestedData) ) {
                $posts = $data;
            } else {
                $posts = [];
            }

            $enterprise->searchlead = $posts;
            
            $metatitle = "Enterprise Search Lead | CoachingSelect.com";

            return view('website.enterprise.searchlead', compact('metatitle','header', 'footer', 'enterprise'));
        
        } else {

            return redirect()
                        ->action('Website\EnterpriseLoginController@login')
                        ;

        }
    }

    public function pagelead(Request $request) {
        
        if(
            session()->has('enterprise')
        ) {
                
            $header = new HeaderController();
            $footer = new FooterController();

            $coaching_id = session()->get('enterprise')->id;

            $enterprise = new \stdClass();

            $query = DB::table('request_callback');

            $q2 = DB::table('student_request_callback')
                ->join('students', 'students.id', '=', 'student_request_callback.user_id')
                ->join('coaching', 'coaching.id', '=', 'student_request_callback.coaching_id')
                ->where('is_purchase_lead', 0);

            $q2 = $q2
            ->select('students.name as name','students.email as email','students.mobile as mobile','coaching.name as coachingname', 'student_request_callback.*')
            ->get(); 
            
            $posts = $query;

            $posts = $posts
                    ->get();

            $posts = $posts->merge($q2);

            $posts = $posts->sortByDesc('created_at');

            $totalData = $posts->count();

            $totalFiltered = $totalData;

            $posts = $posts->filter(
                function($data, $key) use($coaching_id){
                    return $data->coaching_id == $coaching_id;
                }
            );

            if (!empty($posts)) {
                $data = array();

                $count = 1;

                foreach ($posts as $post) {

                    $nestedData['id'] = $count;

                    $nestedData['name'] = $post->name;                
                    $nestedData['mobile'] = $post->mobile;               
                    $nestedData['email'] = $post->email;                 
                    $nestedData['city'] = $post->city ?? '';                
                    $nestedData['class'] = $post->class ?? ''; 
                    
                    $nestedData['coaching_id'] = $post->coaching_id;                
                    
                    $nestedData['coaching_counselling_name'] = 'Counselling Callback'; 
                                
                    if($post->coaching_id != 0) {
                        $nestedData['coaching_counselling_name'] = DB::table('coaching')
                                                                    ->where('id', $post->coaching_id)
                                                                    ->value('name');   
                    }

                    $data[] = $nestedData;
                    $count += 1;
                }
            }

            $enterprise->pagelead = $data;
            
            $metatitle = "Enterprise Page Lead | CoachingSelect.com";

            return view('website.enterprise.pagelead', compact('metatitle','header', 'footer', 'enterprise'));
        
        } else {

            return redirect()
                        ->action('Website\EnterpriseLoginController@login')
                        ;

        }
    }

    public function plans(Request $request) {
        
        if(
            session()->has('enterprise')
        ) {
            $header = new HeaderController();
            $footer = new FooterController();
            
            $plans = $this->all_plan();

            $all_plans_specification = DB::table('plan_specification')
                                        ->groupBy('name')
                                        ->pluck('name')
                                        ->toArray();
            
            $metatitle = "Enterprise Plans | CoachingSelect.com";

            return view('website.enterprise.plans', compact('metatitle','header', 'footer', 'plans', 'all_plans_specification'));
        
        } else {

            return redirect()
                        ->action('Website\EnterpriseLoginController@login')
                        ;

        }
    }

    public function all_plan() {
        
        $all_plan =  DB::table('plan')
                        ->where('status', 'enable')
                        ->get()
                        ->groupBy('type');

        if( !empty($all_plan) ) {

            foreach ($all_plan as $type => $plan) {
                
                foreach ($plan as $plan_single) {
                    $plan_single->specification = DB::table('plan_specification')
                                                            ->where('plan_id', $plan_single->id)
                                                            ->get();

                    $plan_single->specification = $plan_single
                                            ->specification
                                            ->pluck('name')
                                            ->toArray();

                                            
                }

            }

        }

        return $all_plan;
    }

    // purchase lead
    public function purchaselead(Request $request) {
        
        if(
            session()->has('enterprise')
        ) {
                
            $header = new HeaderController();
            $footer = new FooterController();

            $coaching_id = session()->get('enterprise')->id;

            $enterprise = new \stdClass();

            $query = DB::table('student_request_callback')
                ->join('coaching', 'coaching.id', '=', 'student_request_callback.coaching_id')
                ->join('coaching_courses_detail', 'coaching_courses_detail.id', '=', 'student_request_callback.coaching_courses_detail_id')
                ->select('coaching.name as cname', 'coaching_courses_detail.name as ccname', 'student_request_callback.*', 
                'coaching.id as coaching_id'
            )
                ->where('is_purchase_lead', 1);
            
            $posts = $query;

            $posts = $posts
                    ->get();

            $posts = $posts->sortByDesc('created_at');

            $totalData = $posts->count();

            $totalFiltered = $totalData;

            $posts = $posts->filter(
                function($data, $key) use($coaching_id){
                    return $data->coaching_id == $coaching_id;
                }
            );

            if (!empty($posts)) {
                $data = array();

                $count = 1;

                foreach ($posts as $post) {

                    $nestedData['id'] = $count;

                    $new_status = ($post->status == 0) ? '<b class="btn btn-sm btn-danger" onClick="showreqcallback('.$post->id.')">Reply</b>' : '<b class="btn btn-sm btn-outline-danger">Replied</b>';

                    $nestedData['name'] = $post->name;                
                    $nestedData['cname'] = $post->cname;                
                    $nestedData['ccname'] = $post->ccname;                
                    $nestedData['mobile'] = $post->mobile;               
                    $nestedData['parent_name'] = $post->parent_name;               
                    $nestedData['email'] = '<span data-balloon-length="xlarge" aria-label="' . $post->email . '" data-balloon-pos="up">' . substr($post->email, 0, 20) . '...</span>';                 
                    $nestedData['action'] = '
                    <div class="d-flex">
                    ' . $new_status . '</div>';   
                    
                    $data[] = $nestedData;
                    
                    
                    $count += 1;
                }
            }

            $enterprise->purchaselead = $data;

            $metatitle = "Enterprise Purchase Lead | CoachingSelect.com";

            return view('website.enterprise.purchaselead', compact('metatitle','header', 'footer', 'enterprise'));
        
        } else {

            return redirect()
                        ->action('Website\EnterpriseLoginController@login')
                        ;

        }
    }
}