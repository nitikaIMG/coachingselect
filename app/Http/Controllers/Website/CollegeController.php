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

class CollegeController extends Controller
{
    public function colleges() {

        $header = new HeaderController();
        $footer = new FooterController();
        
        $colleges = $this->all_colleges(request());
        
        $filters = $this->filters();

        $metatitle= "Top Colleges in India ".date('Y').": Ranking, Fees, Courses, Admissions, Placements, Scholarships";
        
        $metadescription = 'Miranda House, Lady Shri Ram College For Women and Loyola College are the top three colleges in India as per NIRF Rankings '.date('Y').'. Go through the complete list of best colleges in India at CoachingSelect.';

        $metakeywords = 'CoachingSelect, education, colleges,universities, institutes,career, career options, career prospects,engineering, mba, medical, mbbs,study abroad, foreign education, college, university, institute,courses, coaching, technical education, higher education,forum, community, education career experts,ask experts, admissions,results, events,scholarships,IITs,IIMs,NITs,IIITs,AIIMS,BSDU,NLUs,private colleges, govt colleges, AFMC,JIPMER,Delhi University';

        return view('website.colleges', compact(
            'metatitle',
            'metadescription',
            'metakeywords',
            'header',
            'footer',
            'colleges',
            'filters'
        ));
    }

    public function college($college_name_slug) {

        $college_name = str_replace('-', ' ', $college_name_slug);

        $college = DB::table('college')
                    ->where('college_name', $college_name)
                    ->where('status', 1)
                    ->first();

        if( !empty($college) ) {            

            $header = new HeaderController();
            $footer = new FooterController();

            $college->college_name_slug = $college_name_slug;

            $college->facilities = explode(',', $college->facilities);

            $college->facility = DB::table('facility')
                                    ->whereIn('facility.id', $college->facilities)
                                    ->where('facility.status', 'enable')
                                    ->get();
                            
            $college->photos = explode('{$}', $college->images);

            $college->videos = json_decode($college->videos);
            
            $college->state = DB::table('states')
                                ->where('id', $college->state_id)
                                ->value('name');
                                
            $college->city = DB::table('cities')
                                ->where('id', $college->city_id)
                                ->value('name');         
                                     
            $allstream = DB::table('streams')->get();
            $allcourses = DB::table('courses')->get(['id', 'stream_id', 'name']);

            # favorite college
            $college->is_this_my_favorite = false;

            if( session()->has('student') ) {
                
                $favorite = array();
                $favorite['user_id'] = session()->get('student')->id;
                $favorite['college_id'] = $college->id;

                # is in my favorite list
                $has_already_favorite = DB::table('student_favorite_college')
                                        ->where('user_id', $favorite['user_id'])
                                        ->where('college_id', $favorite['college_id'])
                                        ->exists();

                $college->is_this_my_favorite = $has_already_favorite;

            }

            $college->faq = DB::table('college_faq')
                                ->where('college_id', $college->id)
                                ->get();

            $college->valuable = DB::table('college_valuable')
                                ->where('college_id', $college->id)
                                ->get();

            $metatitle= $college->college_name;
            
            $metatitle .= " : Admissions ".date('Y').", Ranking, Fees, Courses, Placements, Scholarships";

            $metadescription= '';
            $metakeywords= '';
            
            $metadescription .= "Check $college->college_name - $college->college_name Admission Process, Cutoffs, Eligibility, Exams, Selection Criteria & Dates for various courses. Download Brochures & Admission details of $college->college_name.";
            
            $metakeywords .="coachingselect, Coaching Center, colleges,universities, institutes,career, career options, career prospects,engineering, mba, medical, mbbs,study abroad, foreign education, college, university, institute,courses, coaching, technical education, higher education,forum, community, education career experts,ask experts, admissions,results, events,scholarships";

            $college->videos = (array) $college->videos;
            
            return view('website.college', compact('metatitle','header', 'footer', 'college', 'allstream', 'allcourses','metadescription','metakeywords'));

        } else {
            abort(404);
        }

    }

    public function all_colleges($request) {
        
        $filters = '';
        $filters_states = '';
        $filters_streams = '';
        $filters_category = '';
        
        if( !empty($request->filters) ) {
            
            $filters = $request->filters;

            if( !empty($filters['states']) ) {
                $filters_states = $filters['states'];
            }
            
            if( !empty($filters['streams']) ) {
                $filters_streams = $filters['streams'];
            }
            
            if( !empty($filters['category']) ) {
                $filters_category = $filters['category'];
            }

        }

        $colleges = DB::table('college')
                    ->join('states', 'states.id', 'college.state_id')
                    ->join('cities', 'cities.id', 'college.city_id')
                    ->where('college.status', 1);
        
        if( !empty($filters_states) ) {
            $colleges = $colleges
                        ->whereIn('states.name', $filters_states);
        }            
        
        if( !empty($filters_streams) ) {

            $streams = DB::table('streams')
                        ->whereIn('name', $filters_streams)
                        // ->select('id')
                        ->pluck('id')
                        ->toArray();

            $colleges = $colleges
                        ->Where(function ($query) use($streams) {
                            for ($i = 0; $i < count($streams); $i++){
                                $query->orwhere('college.stream_id', 'like',  '%' . $streams[$i] .'%');
                            }      
                        });

        } 
        
        if( !empty($request->sort) ) {

            switch ($request->sort) {
                case 'popularity':
                    $colleges = $colleges
                                ->orderBy('college.reviews_ratings', 'desc');
                    break;
                
                case 'rating':
                    $colleges = $colleges
                                ->orderBy('college.reviews_ratings', 'desc');
                    break;
                
                case 'highest_fees':
                    break;
                
                case 'lowest_fees':
                    break;
            }

        }
        
        if( !empty($filters_category) ) {
            $colleges = $colleges
                        ->whereIn('college.category', $filters_category);
        }

        $colleges = $colleges
                        ->groupBy('college.id')
                        ->select('college.id as id', 'college.*');
                        
        $colleges = $colleges
                        ->orderBy('college.featured', 'desc')
                        ->orderBy('college.created_at', 'desc')
                        ->get();

        if( !empty($colleges) ) {
            foreach($colleges as $college) {

                if( !empty($college->landing_page_highlight_course) ) {
                    
                    $course = DB::table('courses')
                                ->where('id', $college->landing_page_highlight_course)
                                ->first();

                    if( !empty($course) ) {
                        $college->course_name = $course->name;
                        $college->course_stream_id = $course->stream_id;
                    } else {
                        $college->course_name = '';
                        $college->course_stream_id = 0;
                    }

                } else {
                
                    $college->course_name = '';
                    $college->course_stream_id = 0;

                }

                $college->state = DB::table('states')
                                    ->where('id', $college->state_id)
                                    ->value('name');
                                    
                $college->city = DB::table('cities')
                                    ->where('id', $college->city_id)
                                    ->value('name');  
                    
                $college->college_name_slug = str_replace(' ', '-', $college->college_name);

                $getcourse = json_decode($college->courses_details, true);
                $getcoursefee = json_decode($college->course_fee, true);

                if( 
                    !empty(
                    $getcoursefee
                    [$college->course_stream_id]
                    [$college->landing_page_highlight_course]
                    ) 
                ) {
                    $college->fees = $getcoursefee
                                        [$college->course_stream_id]
                                        [$college->landing_page_highlight_course];
                } else {
                    $college->fees = 0;
                }
    
            }
        }

        if( !empty($request->sort) ) {

            switch ($request->sort) {
                
                case 'highest_fees':

                    $colleges = $colleges
                                ->sortByDesc('fees');

                    break;
                
                case 'lowest_fees':

                    $colleges = $colleges
                                ->sortBy('fees');
                    break;
            }

        }

        return $colleges;
    }

    public function filters() {

        $filters['streams'] = $this
                                ->streams();
                                
        $filters['states'] = $this
                                ->states();
                                
        $filters['category'] = $this
                                ->category();

        return $filters;

    }

    public function streams() {

        $colleges = DB::table('college')
                            ->where('status', 1)
                            ->select('stream_id')
                            ->get();

        $streams_array = array();

        if( !empty($colleges) ) {
            foreach($colleges as $college) {

                $streams = $college->stream_id;
                $streams = explode(',', $streams);

                if( !empty($streams) ) {
                    foreach($streams as $stream) {

                        $streams_array[] = $stream;
                    }
                }
            }
        }

        $stream_wise_total_colleges = array_count_values($streams_array);

        $streams_array = array_unique($streams_array);
        
        $streams = array_slice($streams_array, 0, 5);

        $streams = DB::table('streams')
                    ->whereIn('id', $streams)
                    ->where('status', 'enable')
                    ->get();

        if( !empty($streams) ) {
            foreach($streams as $stream) {
                $stream->total_colleges = $stream_wise_total_colleges[$stream->id] ?? 0;
            }
        }

        return $streams;
    }

    public function states() {

        $colleges = DB::table('college')
                            ->where('status', 1)
                            ->select('state_id')
                            ->get();

        $states_array = array();

        if( !empty($colleges) ) {
            foreach($colleges as $college) {

                $state = $college->state_id;
        
                $states_array[] = $state;
            
            }
        }

        $state_wise_total_colleges = array_count_values($states_array);

        $states_array = array_unique($states_array);
        
        $states = array_slice($states_array, 0, 5);

        $states = DB::table('states')
                    ->whereIn('id', $states)
                    ->where('status', 1)
                    ->get();

        if( !empty($states) ) {
            foreach($states as $state) {
                $state->total_colleges = $state_wise_total_colleges[$state->id] ?? 0;
            }
        }

        return $states;
    }

    public function add_to_favorite($college_id) {
        
        if( session()->has('student') ) {
            
            $favorite = array();
            $favorite['user_id'] = session()->get('student')->id;
            $favorite['college_id'] = $college_id;

            $has_already_favorite = DB::table('student_favorite_college')
                                    ->where('user_id', $favorite['user_id'])
                                    ->where('college_id', $favorite['college_id'])
                                    ->exists();

            if($has_already_favorite) {
                DB::table('student_favorite_college')
                    ->where('user_id', $favorite['user_id'])
                    ->where('college_id', $favorite['college_id'])
                    ->delete();
            } else {
                DB::table('student_favorite_college')
                ->insert($favorite);
            }

            return 1;
        }

        return 0;
    }

    public function category() {
        return DB::table('college')
            ->join('college_category', 'college_category.name', 'college.category')
            ->whereNotNull('college.category')
            ->groupBy('college.category')
            ->select('college.category', DB::raw(' count(college.id) as total_colleges'))
            ->where('college_category.status', 'enable')
            ->where('college.status', '1')
            ->get();
    }

    public function sorted_based_on_highest_course_fee() {
        $colleges = DB::table('college')
                    ->where('status', 1)
                    ->get();

        $newArray = array();
        if( !empty($colleges) ) {
            foreach($colleges as $college) {
                $courses = array_values( json_decode($college->course_fee, true) );
                

                foreach($courses as $key => $value) {
                    $value = array_filter($value);
                    $maxs = 0;
                    
                    if( !empty($value) ) {
                        $maxs = (max($value));
                    }
                    else
                        $maxs = 0;

                    if( !empty($newArray[$college->id]) ) {

                        if( ($maxs > $newArray[$college->id])) {
                            $newArray[$college->id] = $maxs;
                        } 
                    } else {
                        $newArray[$college->id] = $maxs;
                    }
                }

            }
        }
                
        return $newArray;
    }

    public function sorted_based_on_lowest_course_fee() {
        $colleges = DB::table('college')
                    ->where('status', 1)
                    ->get();

        $newArray = array();
        if( !empty($colleges) ) {
            foreach($colleges as $college) {
                $courses = array_values( json_decode($college->course_fee, true) );
                

                foreach($courses as $key => $value) {
                    $value = array_filter($value);
                    $min = 0;
                    
                    if( !empty($value) ) {
                        $min = (min($value));
                    }
                    else
                        $min = 0;

                    if( !empty($newArray[$college->id]) ) {

                        if( ($min < $newArray[$college->id])) {
                            $newArray[$college->id] = $min;
                        } 
                    } else {
                        $newArray[$college->id] = $min;
                    }
                    
                }

            }
        }
        
        return $newArray;
    }
    
}