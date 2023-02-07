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

class CoachingSearchController extends Controller
{

    public $found = false, $coachings = [];

    public function coaching_search() {

        $header = new HeaderController();
        $footer = new FooterController();

        $searching = $this->searching();
        
        $cities_group_by_state = $this->cities_group_by_state();

        // stream wise
        if( !empty(request()->get('course')) ) {   

            $course_list = DB::table('streams')
                            ->where('streams.name', request()->get('course'))
                            ->join('courses', 'courses.stream_id', 'streams.id')
                            ->join('coaching_courses', 'coaching_courses.name', 'courses.name')
                            ->groupBy('coaching_courses.name')
                            ->pluck('coaching_courses.name')
                            ->toArray();

            $filters_specialization = $course_list;

            $array['specialization'] = $course_list;
            
            request()->merge(['filters' => $array]); //add request

            $_GET['filters']['specialization'] = $course_list;
              
        }

        // Executive Education
        if( 
            !empty(request()->get('course')) 
            and 
            request()->get('course') == 'Executive Education'
            and
            empty($array['specialization'])
        ) {   
            $coachings = collect();    

        } else {

            $coachings = $this->coachings(request());
        }

        if( 
            empty($coachings->toArray()) 
            and 
            request()->get('course') == 'Executive Education'
        ) { 
            unset(  
                $_GET['filters']['specialization']
            );
            request()->request->remove('filters');
        } 
        // Executive Education

        $online_coachings = $this->online_coachings();

        $filters = $this->filters();

        $metatitle= "Best Coaching for";
        $metadescription= 'Go through the complete list of best coaching in India at CoachingSelect. Get Address, Contact Numbers, Website, Email Id, Reviews and map more for Coaching Classes';
        $metakeywords= 'CoachingSelect, coaching, education, colleges,universities, institutes,career, career options, career prospects,engineering, mba, medical, mbbs,study abroad, foreign education, college, university, institute,courses, coaching, technical education, higher education, forum, community, education career experts,ask experts, admissions, results, events,scholarships, student forum';
        if( !empty(request('exam')) ){

            $metatitle .= " ".request('exam');
            $exam= request('exam');
            $metadescription = "Best Coaching for $exam- Coaching Select brings the best online $exam preparation courses with ✔Classroom programs ✔Live Online Classes ✔Recorded Video Lectures and ✔Online Tests. Get Phone Numbers, Address, Reviews, Photos, Maps for top $exam Training near me in india on Coaching Select save with exclusive offers. Enroll with $exam Classes for your $exam Preparation to boost your chances as 1 in every 4 candidates who enroll for $exam online Classes. Enroll Now!.";
            $metakeywords ="best coaching Institutes for $exam, Exam coaching centre near me, best online coaching for $exam, Top Medical colleges in india,Top colleges in india, online tuition classes, best coaching classes, Reviews, Map, Address, Phone Number, Contact Number, local, popular Institutes For $exam, Institutes For $exam, Top 5 coaching for $exam in City, Top 10 Coaching  for $exam Preparation in India, Discounts and offers on coachings Institutes, Scholarship exams by coaching Institutes, scholarship on $exam Coaching";
        }
             
        $metatitle .= " in";
        
        if( !empty(request('city')) )
            $metatitle .= " ".request('city');
        else
            $metatitle .= " India";

        $metatitle .= " ".date('Y')." - Fees, Courses, Offers, Reviews, Ranking ".date('Y')."";

        
        return view('website.coaching_search', compact('metatitle', 'header', 'footer', 'searching', 'cities_group_by_state', 'coachings', 'online_coachings', 'filters','metadescription','metakeywords'));
    }

    public function searching() {
        $searching = array();

        $query = DB::table('coaching')
                    ->join('coaching_courses', 'coaching_courses.coaching_id', 'coaching.id')
                    ->distinct('coaching_courses.name')
                    ->select('coaching_courses.name');
        
        $searching['online'] = DB::table('coaching')
                                ->join('coaching_courses', 'coaching_courses.coaching_id', 'coaching.id')
                                ->join('courses', 'courses.name', 'coaching_courses.name')
                                ->distinct('coaching_courses.name')
                                ->select('coaching_courses.name')
                                ->where('coaching.offering', 'LIKE', '%'.'online'.'%')
                                ->where('coaching.status', 'enable')
                                ->where('courses.status', 'enable')
                                ->where('courses.type', 'coaching')
                                ->where('coaching_courses.status', 'enable')
                                ->get();
                                
        $searching['classroom'] = DB::table('coaching')
                                ->join('coaching_courses', 'coaching_courses.coaching_id', 'coaching.id')
                                ->join('courses', 'courses.name', 'coaching_courses.name')
                                ->distinct('coaching_courses.name')
                                ->select('coaching_courses.name')
                                ->where('coaching.offering', 'LIKE', '%'.'classroom'.'%')
                                ->where('coaching.status', 'enable')
                                ->where('courses.status', 'enable')
                                ->where('courses.type', 'coaching')
                                ->where('coaching_courses.status', 'enable')
                                ->get();
                                
        $searching['tutor'] = DB::table('coaching')
                                ->join('coaching_courses', 'coaching_courses.coaching_id', 'coaching.id')
                                ->join('courses', 'courses.name', 'coaching_courses.name')
                                ->distinct('coaching_courses.name')
                                ->select('coaching_courses.name')
                                ->where('coaching.offering', 'LIKE', '%'.'tutor'.'%')
                                ->where('coaching.status', 'enable')
                                ->where('courses.status', 'enable')
                                ->where('courses.type', 'coaching')
                                ->where('coaching_courses.status', 'enable')
                                ->get();
                                
        $searching['all'] = DB::table('coaching')
                                ->join('coaching_courses', 'coaching_courses.coaching_id', 'coaching.id')
                                ->join('courses', 'courses.name', 'coaching_courses.name')
                                ->distinct('coaching_courses.name')
                                ->select('coaching_courses.name')
                                ->where('coaching.status', 'enable')
                                ->where('courses.status', 'enable')
                                ->where('courses.type', 'coaching')
                                ->where('coaching_courses.status', 'enable')
                                ->get();

        return $searching;
    }

    public function cities_group_by_state() {
        return DB::table('cities')
                ->join('coaching_centers', 'coaching_centers.name', 'cities.name')
                ->join('coaching_centers_branches', 'coaching_centers.id', 'coaching_centers_branches.coaching_centers_id')
                ->join('states', 'states.id', 'cities.state_id')
                ->where('coaching_centers.status', 'enable')
                ->where('coaching_centers_branches.status', 'enable')
                ->groupBy('cities.name')
                ->select('states.name as state', 'cities.name as name')
                ->get()
                ->groupBy('state');
    }

    public function coachings($request) {

        $offering = $request->tab;

        if( 
            empty($offering) ) {
            $offering = 'classroom';
        }

        $exam = $request->exam;
        $city = $request->city;
        $filters = '';
        $filters_city = '';
        $filters_fees = '';
        $filters_ratings = '';
        $filters_specialization = '';
        $filters_offering = '';
        $filters_distance = '';

        $name = $request->coaching_name;

        if( !empty($request->filters) ) {
            
            $filters = $request->filters;

            if( !empty($filters['city']) ) {
                $filters_city = $filters['city'];
            }
            
            if( !empty($filters['fees']) ) {
                $filters_fees = $filters['fees'];
            }
            
            if( !empty($filters['ratings']) ) {
                $filters_ratings = $filters['ratings'];
            }

            if( !empty($filters['specialization']) ) {
                $filters_specialization = $filters['specialization'];
            }
            
            if( !empty($filters['offering']) ) {
                $filters_offering = $filters['offering'];

            }

        }

        $is_coaching_courses_already_joined = false;
        $is_coaching_centers_already_joined = false;
        $is_coaching_courses_detail_already_joined = false;
        $is_coaching_centers_branches_already_joined = false;

        $coachings = DB::table('coaching')
                        ->where('coaching.status', 'enable')
                        ->select('coaching.*')
                        ->distinct('coaching.id');

        if( !empty($exam) ) {
                
            $coachings = $coachings
                            ->join('coaching_courses', 'coaching_courses.coaching_id', 'coaching.id')
                            ->join('coaching_courses_detail', 'coaching_courses.id', 'coaching_courses_detail.coaching_courses_id')
                            ->where('coaching_courses.name', $exam);  

            $is_coaching_courses_already_joined = true;       
            $is_coaching_courses_detail_already_joined = true; 
            $new_coachings = (clone $coachings);
        }    
        
        if( !empty($city) ) {

            $coachings = $coachings
                            ->join('coaching_centers', 'coaching_centers.coaching_id', 'coaching.id')
                            ->join('coaching_centers_branches', 'coaching_centers.id', 'coaching_centers_branches.coaching_centers_id')
                            ->where('coaching_centers.name', $city);        

            $is_coaching_centers_already_joined = true;
            $is_coaching_centers_branches_already_joined = true;

        }   

        if( !empty($offering) ) {

            if($offering == 'all') {

            } else {

                $coachings = $coachings
                            ->where('coaching.offering', 'LIKE', '%' . $offering . '%');
            }
        }
        
        if( !empty($exam) ) {
                
            $coachings = $coachings->where('coaching_courses.name', $exam);
        }

        if( !empty($filters_ratings) ) {
                                
                $flag = false;
                if( in_array('2 - 3 Star', $filters_ratings) ) {
                    $coachings = $coachings
                                ->whereBetween('coaching.ratings', [2, 3]);
                    $flag = true;
                } 
                                
                if( in_array('3 - 4 Star', $filters_ratings) ) {
                    $coachings = $flag
                        ? $coachings->orwhereBetween('coaching.ratings', [3, 4])
                        : $coachings->whereBetween('coaching.ratings', [3, 4]);
                
                    $flag = true;
                } 
                                
                if( in_array('4 - 5 Star', $filters_ratings) ) {
                    $coachings = $flag
                        ? $coachings->orwhereBetween('coaching.ratings', [4, 5])
                        : $coachings->whereBetween('coaching.ratings', [4, 5]);
                }
        }
                
        if( !empty($filters_offering) ) {   

            $flag = false;

            $filters_offering_new = [];

            foreach($filters_offering as $key => $offerings) {
                 
                switch ($offerings) {        
                        
                    case 'Online Coaching':
                        
                        $filters_offering_new[$key] = 'online';
                                    
                        $flag = true;
                        break;          
                        
                    case 'Classroom Coaching':
                         
                        $filters_offering_new[$key] = 'classroom';

                        $flag = true;
                        break;     
                        
                    case 'Tutor':
                        $filters_offering_new[$key] = 'tutor';

                        $flag = true;
                        break;                 
                }                
                
            }
            
            if( count($filters_offering) >= 2 ) {
            
                $coachings = $coachings
                            ->where('coaching.offering', 'LIKE', '%'.implode(',', $filters_offering_new).'%');
                    
            } else {

                $coachings = $coachings
                            ->where('coaching.offering', implode(',', $filters_offering_new));
                        
            }
            
            if($offering == 'all') {
                if( !empty($filters_offering) ) {
                    
                    if( !empty($exam) ) {
                        $new_coachings = $new_coachings
                                ->where('coaching.offering', implode(',', $filters_offering_new));
                    }
                }
            }

        }   
        
        if( !empty($name) ) {

            $coachings = $coachings
                         ->where('coaching.name', 'LIKE', '%' . $name . '%');

            // search lead
            $this->search_lead($name);
        } 
        
        if( !empty($filters_specialization) ) {   

            
            if($is_coaching_courses_already_joined ) {
                $coachings = $coachings
                            ->whereIn('coaching_courses.name', $filters_specialization);
            } else {
                $coachings = $coachings
                            ->join('coaching_courses', 'coaching_courses.coaching_id', 'coaching.id')
                            ->whereIn('coaching_courses.name', $filters_specialization);

                $is_coaching_courses_already_joined = true;             
            }
            
            if($is_coaching_courses_detail_already_joined ) {
                // don't join
            } else {
                $coachings = $coachings
                                ->join('coaching_courses_detail', 'coaching_courses_detail.coaching_courses_id', 'coaching_courses.id');
                                    
                $is_coaching_courses_detail_already_joined = true; 
            }  
        }  
        
        // is enable
        if($is_coaching_courses_already_joined ) {
            $coachings = $coachings
                            ->where('coaching_courses.status', 'enable');
        }
        
        if($is_coaching_centers_already_joined ) {
            $coachings = $coachings
                            ->where('coaching_centers.status', 'enable');
        }
        
        if($is_coaching_courses_detail_already_joined ) {
            $coachings = $coachings
                            ->where('coaching_courses_detail.status', 'enable');
        }
        
        if($is_coaching_centers_branches_already_joined ) {
            $coachings = $coachings
                            ->where('coaching_centers_branches.status', 'enable');
        }
                        
        $coachings = $coachings
                        ->orderBy('is_featured','desc');
        
        $coachings = $coachings
                        ->get();

        if( !empty($offering) ) {

            if($offering == 'all') {

                if( !empty($filters_offering) ) {
                    
                } else 
                if( !empty($exam) ) {
                    $new_coachings = $new_coachings->where('coaching.offering', 'LIKE', '%online%')->get();
                            
                    $coachings = $coachings->merge($new_coachings)->unique();
                }
            } 
        }

        if( !empty($coachings) ) {
            
            foreach($coachings as $key => $coaching) {

                if( !empty($coaching) ) {   

                    if( !empty($filters_fees) ) {

                        if( !empty($exam) ) {
                            $this->filters_fees($coaching->id, $filters_fees, $exam);
                        } else {                            
                            $this->filters_fees($coaching->id, $filters_fees);
                        }                        
                    }

                    $coaching->ratings = $this->ratings($coaching->id);

                    DB::table('coaching')
                    ->where('id', $coaching->id)
                    ->update([
                        'ratings' => $coaching->ratings
                    ]);
                                    
                    if( !empty($city) ) {
                        
                        $coaching->branches_in_same_center = DB::table('coaching_centers_branches')
                                                            ->join('coaching_centers', 'coaching_centers.id', 'coaching_centers_branches.coaching_centers_id')
                                                            ->where('coaching_centers_branches.coaching_id', $coaching->id)
                                                            ->where('coaching_centers.name', $city)
                                                            ->select('coaching_centers_branches.name')
                                                            ->groupBy('coaching_centers_branches.name')
                                                            ->where('coaching_centers.status', 'enable')
                                                            ->where('coaching_centers_branches.status', 'enable')
                                                            ->get();

                    } 

                    $coaching->facility = DB::table('coaching_facility')
                                            ->join('facility', 'facility.name', 'coaching_facility.name')
                                            ->where('coaching_facility.coaching_id', $coaching->id)
                                            ->where('coaching_facility.status', 'enable')
                                            ->get();

                    $coaching->courses = DB::table('coaching_courses_detail')
                                            ->join('coaching_courses', 'coaching_courses.id', 'coaching_courses_detail.coaching_courses_id')
                                            ->where('coaching_courses.coaching_id', $coaching->id)
                                            ->where('coaching_courses.status', 'enable')
                                            ->select('coaching_courses_detail.*', 'coaching_courses.name as coaching_courses_name')
                                            ->where('coaching_courses.status', 'enable')
                                            ->where('coaching_courses_detail.status', 'enable')
                                            ->get()
                                            ->groupBy(
                                                function($query) {
                                                    return $query->coaching_courses_name;
                                                }
                                            );

                    $coaching->offer_percentage = DB::table('coaching_courses_detail')
                                                    ->where('coaching_id', $coaching->id)
                                                    ->orderBy('offer_percentage', 'desc')
                                                    ->take(1)
                                                    ->value('offer_percentage');

                    if(
                        session()->has('student')
                    ) {

                        $user_id = session()->get('student')->id;
                        $coaching_id = $coaching->id;

                        $my_views = DB::table('coaching_search')
                                    ->where('coaching_id', $coaching_id)
                                    ->where('user_id', $user_id)
                                    ->first();

                        $view = array();
                        $view['coaching_id'] = $coaching_id;
                        $view['user_id'] = $user_id;
                        $view['view'] = 1;       
                        
                        $is_viewed = false;

                        if( !empty($my_views) ) {

                            DB::table('coaching_search')
                                ->where('coaching_id', $coaching_id)
                                ->where('user_id', $user_id)
                                ->increment('view', 1);

                            $is_viewed = true;

                        } else {
                            DB::table('coaching_search')
                            ->insert($view);
                        
                            $is_viewed = true;
                        }
                    
                    }
                } 

            }
        
        }

        if( !empty($filters_fees) ) {

            $coachings = $coachings->filter(function ($coaching, $key) {

                return in_array($coaching->id, $this->coachings);
            });

        }

        return $coachings;

    }

    public function online_coachings() {

        $coachings = DB::table('coaching')
                    ->join(
                        'coaching_courses_detail', 
                        'coaching_courses_detail.coaching_id',
                        'coaching.id'
                    )
                    ->where('coaching.status', 'enable')
                    ->where('coaching_courses_detail.is_featured', 1)
                    ->orderBy('coaching_courses_detail.offer_percentage', 'desc')
                    ->where('coaching_courses_detail.offering', 'LIKE', '%online%')                   
                    ->select(
                        'coaching.*'
                    )
                    ->groupBy('coaching_courses_detail.name')
                    ->get();

        if( !empty($coachings) ) {
    
            $i = 1;
            foreach($coachings as $coaching) {

                if( !empty($coaching) ) { 

                    $already_exists_courses_names = $coachings->flatten()->pluck('course.name')->wherenotNull()->toArray();
                    
                    $course = DB::table('coaching_courses_detail')
                                ->where('coaching_id', $coaching->id)
                                ->orderBy('offer_percentage', 'desc')
                                ->where('offering', 'LIKE', '%online%')
                                ->where('is_featured', 1)
                                ->take(1);

                    if($i == 1) {

                        $course = $course
                                    ->first();
                    } else {  
                        
                        $course = $course
                                    ->whereNotIn('name', $already_exists_courses_names)
                                    ->first();

                    }

                    $i += 1;

                    $coaching->course = $course;
                                                                
                    $coaching->total_courses = DB::table('coaching_courses_detail')
                                                ->where('coaching_id', $coaching->id)
                                                ->count();
                                                        
                    $coaching->ratings = $this->ratings($coaching->id);
                }

            }
        
        }

        return $coachings;

    }

    public function filters() {

        $filters['city'] = DB::table('coaching_centers')
                            ->join('coaching', 'coaching_centers.coaching_id', 'coaching.id')
                            ->join('coaching_centers_branches', 'coaching_centers.id', 'coaching_centers_branches.coaching_centers_id')
                            ->select('coaching_centers.name'
                            )
                            ->groupBy('coaching_centers.name')
                            ->where('coaching_centers.status', 'enable')
                            ->where('coaching_centers_branches.status', 'enable')
                            ->where('coaching.status', 'enable')
                            ->get();

        if( !empty($filters['city']) ) {
            foreach ($filters['city'] as $center) {
                $center->total_coachings = DB::table('coaching_centers')
                                            ->join('coaching_centers_branches', 'coaching_centers.id', 'coaching_centers_branches.coaching_centers_id')
                                            ->join('coaching', 'coaching.id', 'coaching_centers.coaching_id')
                                            ->where('coaching_centers.name', $center->name)
                                            ->distinct('coaching_centers.coaching_id')
                                            ->where('coaching_centers.status', 'enable')
                                            ->where('coaching_centers_branches.status', 'enable')
                                            ->where('coaching.status', 'enable')
                                            ->count();
            }
        }

        $filters['fees']['Less than 50,000'] = DB::table('coaching_courses_detail')
                                        ->join('coaching', 'coaching_courses_detail.coaching_id', 'coaching.id')
                                        ->join('coaching_courses', 'coaching_courses_detail.coaching_courses_id', 'coaching_courses.id')
                                        ->where('coaching_courses_detail.fee', '<', 50000)
                                        ->distinct('coaching.id')
                                        ->where('coaching_courses.status', 'enable')
                                        ->where('coaching_courses_detail.status', 'enable')
                                        ->where('coaching.status', 'enable')
                                        ->count();
                    
        $filters['fees']['₹50,001 - ₹1,00,000'] = DB::table('coaching_courses_detail')
                                        ->join('coaching', 'coaching_courses_detail.coaching_id', 'coaching.id')
                                        ->join('coaching_courses', 'coaching_courses_detail.coaching_courses_id', 'coaching_courses.id')
                                        ->whereBetween('coaching_courses_detail.fee', [50001,100000])
                                        ->distinct('coaching.id')
                                        ->where('coaching_courses.status', 'enable')
                                        ->where('coaching_courses_detail.status', 'enable')
                                        ->where('coaching.status', 'enable')
                                        ->count();
                            
        $filters['fees']['₹1,00,001 - ₹1,50,000'] = DB::table('coaching_courses_detail')
                                        ->join('coaching', 'coaching_courses_detail.coaching_id', 'coaching.id')
                                        ->join('coaching_courses', 'coaching_courses_detail.coaching_courses_id', 'coaching_courses.id')
                                        ->whereBetween('coaching_courses_detail.fee', [100001,150000])
                                        ->distinct('coaching.id')
                                        ->where('coaching_courses.status', 'enable')
                                        ->where('coaching_courses_detail.status', 'enable')
                                        ->where('coaching.status', 'enable')
                                        ->count();

        $filters['fees']['₹1,50,001 - ₹2,00,000'] = DB::table('coaching_courses_detail')
                                        ->join('coaching', 'coaching_courses_detail.coaching_id', 'coaching.id')
                                        ->join('coaching_courses', 'coaching_courses_detail.coaching_courses_id', 'coaching_courses.id')
                                        ->whereBetween('coaching_courses_detail.fee', [150001,200000])
                                        ->distinct('coaching.id')
                                        ->where('coaching_courses.status', 'enable')
                                        ->where('coaching_courses_detail.status', 'enable')
                                        ->where('coaching.status', 'enable')
                                        ->count();
                    
        $filters['fees']['₹2,00,001 & Above'] = DB::table('coaching_courses_detail')
                                        ->join('coaching', 'coaching_courses_detail.coaching_id', 'coaching.id')
                                        ->join('coaching_courses', 'coaching_courses_detail.coaching_courses_id', 'coaching_courses.id')
                                        ->where('coaching_courses_detail.fee', '>=', 200001)
                                        ->distinct('coaching.id')
                                        ->where('coaching_courses.status', 'enable')
                                        ->where('coaching_courses_detail.status', 'enable')
                                        ->where('coaching.status', 'enable')
                                        ->count();

        $filters['ratings']['2 - 3 Star'] = DB::table('coaching')
                                        ->whereBetween('coaching.ratings', [2, 3])
                                        ->distinct('coaching.id')
                                        ->where('status', 'enable')
                                        ->count();
        
        $filters['ratings']['3 - 4 Star'] = DB::table('coaching')
                                        ->whereBetween('coaching.ratings', [3, 4])
                                        ->distinct('coaching.id')
                                        ->where('status', 'enable')
                                        ->count();
        
        $filters['ratings']['4 - 5 Star'] = DB::table('coaching')
                                        ->whereBetween('coaching.ratings', [4, 5])
                                        ->distinct('coaching.id')
                                        ->where('status', 'enable')
                                        ->count();
                                        
        $filters['specialization'] = DB::table('coaching_courses')
                            ->join('coaching', 'coaching_courses.coaching_id', 'coaching.id')
                            ->join('coaching_courses_detail', 'coaching_courses.id', 'coaching_courses_detail.coaching_courses_id')
                            ->select('coaching_courses.name'
                            )
                            ->groupBy('coaching_courses.name')
                            ->where('coaching_courses.status', 'enable')
                            ->where('coaching_courses_detail.status', 'enable')
                            ->where('coaching.status', 'enable')
                            ->get();

        if( !empty($filters['specialization']) ) {
            foreach ($filters['specialization'] as $center) {
                $center->total_coachings = DB::table('coaching_courses')
                                            ->join('coaching_courses_detail', 'coaching_courses.id', 'coaching_courses_detail.coaching_courses_id')
                                            ->join('coaching', 'coaching_courses_detail.coaching_id', 'coaching.id')
                                            ->where('coaching_courses.name', $center->name)
                                            ->distinct('coaching_courses.coaching_id')
                                            ->where('coaching_courses.status', 'enable')
                                            ->where('coaching_courses_detail.status', 'enable')
                                            ->where('coaching.status', 'enable')
                                            ->count();
            }
        }

        $filters['offering']['Online Coaching'] = DB::table('coaching')
                                                    ->where('offering', 'LIKE', '%'.'online'.'%')
                                                    ->where('status', 'enable')
                                                    ->count();

        $filters['offering']['Classroom Coaching'] = DB::table('coaching')
                                                        ->where('offering', 'LIKE', '%'.'classroom'.'%')
                                                        ->where('status', 'enable')
                                                        ->count();
        
        $filters['offering']['Tutor'] = DB::table('coaching')
                                        ->where('offering', 'LIKE', '%'.'tutor'.'%')
                                        ->where('status', 'enable')
                                        ->count();
        
        $filters['distance']['Up to 5 Km'] = 0;
        $filters['distance']['6 Km - 10 Km'] = 0;
        $filters['distance']['11Km – 15 Km'] = 0;
        $filters['distance']['16 Km - 20 Km'] = 0;
        $filters['distance']['21 Km & Above'] = 0;

        return $filters;

    }

    
    public function ratings($coaching_id) {   
        
        $faculty_stars = DB::table('coaching_reviews')
                            ->where('coaching_id', $coaching_id)
                            ->sum('faculty_stars');
                        
        $study_materials_stars = DB::table('coaching_reviews')
                                    ->where('coaching_id', $coaching_id)
                                    ->sum('study_materials_stars');
                        
        $doubt_clearing_stars = DB::table('coaching_reviews')
                                    ->where('coaching_id', $coaching_id)
                                    ->sum('doubt_clearing_stars');
                        
        $mentorship_stars = DB::table('coaching_reviews')
                                ->where('coaching_id', $coaching_id)
                                ->sum('mentorship_stars');
                        
        $tech_support_stars = DB::table('coaching_reviews')
                                ->where('coaching_id', $coaching_id)
                                ->sum('tech_support_stars');

        $total_stars = ($faculty_stars + $study_materials_stars + $doubt_clearing_stars + $mentorship_stars + $tech_support_stars);
        
        $total_reviews = DB::table('coaching_reviews')
                        ->where('coaching_id', $coaching_id)
                        ->select('id')
                        ->get()
                        ->count();

        $total_ratings = ($total_stars > 0) ? ($total_stars / $total_reviews) : 0;

        $total_ratings = ($total_ratings / 5); # as total ratings mediums are 5

        $coaching_ratings = is_float($total_ratings) ? 
                            number_format($total_ratings, 1, '.', '') :
                            $total_ratings;

        return $coaching_ratings;
    }

    public function distance($lat1, $lon1, $lat2, $lon2, $unit) {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }

    }

    public function calculate_distance($coachings) {

        $total = 0;

        if( !empty($coachings) ) {
            foreach ($coachings as $coaching ) {
            }
        }

        return $total;

    }

    public function filters_fees($coaching_id, $filters_fees, $exam = '') {

        if( !empty($filters_fees) ) {

            $in_total_range = 0;

            foreach($filters_fees as $key => $filters_fee) {

                if( $filters_fee == 'Less than 50,000' ) {
                    $array['min'] = '';
                    $array['max'] = 50000;
                    $filters_fees[$key] = $array;
                } 
                
                if( $filters_fee == '₹50,001 - ₹1,00,000' ) {
                    $array['min'] = 50001;
                    $array['max'] = 100000;    
                    
                    $filters_fees[$key] = $array;                            
                } 
                
                if( $filters_fee == '₹1,00,001 - ₹1,50,000' ) {
                    $array['min'] = 100001;
                    $array['max'] = 150000;  
                    $filters_fees[$key] = $array;                    
                } 
                
                if( $filters_fee == '₹1,50,001 - ₹2,00,000' ) {
                    $array['min'] = 150001;
                    $array['max'] = 200000;     
                    $filters_fees[$key] = $array;                                
                } 
                
                if( $filters_fee == '₹2,00,001 & Above' ) {
                    $array['min'] = 200001;
                    $array['max'] = '';    
                    $filters_fees[$key] = $array;                       
                }

            }

            foreach($filters_fees as $key => $filters_fee) {

                $coach = DB::table('coaching_courses_detail')
                            ->where('coaching_courses_detail.status', 'enable')
                            ->where('coaching_courses_detail.coaching_id', $coaching_id);

                if( !empty($filters_fee['min']) ) {
                    $coach = $coach
                            ->where('coaching_courses_detail.fee', '>=', $filters_fee['min']);
                }
                if( !empty($filters_fee['max']) ) {
                    $coach = $coach
                            ->where('coaching_courses_detail.fee', '<=', $filters_fee['max']);                    
                }
                                    
                if( !empty($exam) ) {
                        
                    $coach = $coach
                                ->join('coaching_courses', 'coaching_courses.id', 'coaching_courses_detail.coaching_courses_id')
                                ->where('coaching_courses.name', $exam);  

                }  
                
                $coach = $coach->get();                            

                if( !empty($coach) ) {
                    if( !empty($coach->toArray()) ) {
                        $in_total_range += 1;
                    } else {
                    }
                }

            }

            if($in_total_range) {
                $this->coachings[] = $coaching_id;
            }
            
        }

    }

    public function search_lead($text = '') {

        if( !empty($text) ) {
            $lead['text'] = $text;
        } else {
            $lead['text'] = request()->get('text');
        }

        $text = $lead['text'];

        $lead['location'] = '';

        $is_found = DB::table('coaching')
                    ->where('name', $text)
                    ->get();

        if(
            !empty($is_found->toArray())
        ) {
            $lead['is_found'] = 'Found';
        } else {
            $lead['is_found'] = 'Not Found';
        }            

        DB::table('search_lead')
        ->insert($lead);

        return 1;
    }

}