<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;

use Carbon\Carbon;

use App\Http\Controllers\Controller;

use Log;

class HeaderController extends Controller
{
    public function blogs($stream_id = '') {

        return DB::table('blogs')
                ->where('blogs.status', 'enable')
                ->take(5)
                ->join('blogs_category', 'blogs_category.id', 'blogs.blog_category_id')
                ->where('blogs.status', 'enable')
                ->where('blogs_category.status', 'enable')
                ->orderBy('blogs.created_at', 'asc')
                ->get();        
    }
    
    public function exams() {
        return DB::table('exams')
                ->join('streams', 'streams.id', 'exams.stream_id')
                ->join('courses', 'courses.id', 'exams.course_id')
                ->where('exams.status', 'enable')
                ->where('streams.status', 'enable')
                ->where('courses.status', 'enable')
                ->orWhere('exams.status', 1)
                ->select('streams.id as sid', 'streams.name', 'exams.title', 'exams.id')
                ->orderby('exams.created_at', 'asc')
                ->orderby('streams.created_at', 'asc')
                ->get()
                ->groupBy(function ($query) {
                    return $query->name;
                });
    }

    public function coachings() {
        return DB::table('courses')
                ->join('streams', 'streams.id', 'courses.stream_id')
                ->join('coaching_courses', 'coaching_courses.name', 'courses.name')
                ->join('coaching_courses_detail', 'coaching_courses.id', 'coaching_courses_detail.coaching_courses_id')
                ->join('coaching', 'coaching.id', 'coaching_courses_detail.coaching_id')
                ->where('coaching_courses.status', 'enable')
                ->where('coaching_courses_detail.status', 'enable')
                ->where('streams.status', 'enable')
                ->where('coaching.status', 'enable')
                ->where('courses.status', 'enable')
                ->where('courses.type', 'coaching')
                ->select('streams.name', 'courses.name as course_name')
                ->distinct('courses.name')
                ->orderby('streams.updated_at', 'asc')
                ->orderby('coaching_courses.updated_at', 'asc')
                ->get()
                ->groupBy(function ($query) {
                    return $query->name;
                });
    }

    public function question_papers() {
        return DB::table('question_paper_subjects')
                ->join('streams', 'streams.id', 'question_paper_subjects.stream_id')
                ->join('courses', 'courses.id', 'question_paper_subjects.course_id')
                ->where('question_paper_subjects.status', 'enable')
                ->select('streams.name', 'courses.name as course_name','courses.id')
                ->where('streams.status', 'enable')
                ->where('courses.status', 'enable')
                ->distinct('courses.name')
                ->orderby('streams.created_at', 'asc')
                ->orderby('courses.created_at', 'asc')
                ->get()
                ->groupBy(function ($query) {
                    return $query->name;
                });
    }
    
    public function advertisement($type) {
        
        $currentdate = date('Y-m-d');

        $advertisement = DB::table('advertisement')
                        ->inRandomOrder()
                        ->where('type', $type)
                        ->where('status', 'enable')
                        ->first();

        if( 
            !empty($advertisement->start_date) 
            and
            !empty($advertisement->end_date)             
        ) {
             
            if(
                $advertisement->start_date <= $currentdate
                and
                $advertisement->end_date >= $currentdate
            ) {
                // return ad
            } else {
                $advertisement = null;
            }

        } else if( 
            !empty($advertisement->start_date)          
        ) {
             
            if(
                $advertisement->start_date <= $currentdate
            ) {
                // return ad
            } else {
                $advertisement = null;
            }

        } else if( 
            !empty($advertisement->end_date)             
        ) {
             
            if(
                $advertisement->end_date >= $currentdate
            ) {
                // return ad
            } else {
                $advertisement = null;
            }
        } else {
            // return ad   
        }

        if( empty($advertisement) ) {
            $advertisement = DB::table('advertisement')
                            ->inRandomOrder()
                            ->where('type', $type)
                            ->where('status', 'enable')
                            ->where('start_date', NULL)
                            ->where('end_date', NULL)
                            ->first();
        }
        // dd($advertisement->id);
        $total_time_fetched = 0;

        if( !empty($advertisement) ) {

            if( session()->has('advertisement['.$type.']') ) {

                $advertisement = session()->get('advertisement['.$type.']');

                if( session()->has('advertisement['.$type.'][total_time_fetched]') ) {
                    // dump(session()->get('advertisement['.$type.']')->id);
                    $iid = session()->get('advertisement['.$type.']')->id;
                    $total_time_fetched = session()->get('advertisement['.$type.'][total_time_fetched]');

                    session([
                        'advertisement['.$type.'][total_time_fetched]' => $total_time_fetched + 1
                    ]);

                } else {
                    session([
                        'advertisement['.$type.'][total_time_fetched]' => 1
                    ]);

                    $total_time_fetched = 1;
                }

            } else {
                session([
                    'advertisement['.$type.']' => $advertisement
                ]);

                session([
                    'advertisement['.$type.'][total_time_fetched]' => 1
                ]);
            }
        }

        if($total_time_fetched == 2) {
            session()->forget('advertisement['.$type.']');
            
            session()->forget('advertisement['.$type.'][total_time_fetched]');
        }
        // echo '<pre>';
        // print_r($advertisement);
        // die;
        if( empty($advertisement) ) {
            return $this->advertisement($type);
        }

        

        return $advertisement;
    }

    public function coaching_search_autocomplete() {
        
        $coaching = DB::table('coaching')
                    ->where('status', 'enable')
                    ->pluck('name')
                    ->toArray();
        
        return $coaching;
    }    

    public function top_3_streams_wise_things() {

        $top_3_streams_wise_things = new \StdClass();

        $top_3_streams_wise_things->Engineering = collect();
        $top_3_streams_wise_things->Medical = collect();
        $top_3_streams_wise_things->MBA = collect();
        
        foreach($top_3_streams_wise_things as $stream_name => $collection) {

            $stream = DB::table('streams')
                        ->where('streams.name', $stream_name)
                        ->select('id')
                        ->first();

            if( !empty($stream) ) {
                            
                $top_3_streams_wise_things->$stream_name->top_colleges = DB::table('college')
                                                                    ->where('stream_id', $stream->id)
                                                                    ->select('category')
                                                                    ->distinct('category')
                                                                    ->get();
                                        
                $top_3_streams_wise_things->$stream_name->exams = DB::table('exams')
                                                            ->where('exams.stream_id', $stream->id)
                                                            ->join('courses', 'courses.id', 'exams.course_id')
                                                            ->select('courses.name')
                                                            ->distinct('courses.name')
                                                            ->get();
                                
                $top_3_streams_wise_things->$stream_name->previous_year_papers = DB::table('question_paper_subjects')
                                                                            ->where('question_paper_subjects.stream_id', $stream->id)
                                                                            ->join('courses', 'courses.id', 'question_paper_subjects.course_id')
                                                                            ->select('courses.name')
                                                                            ->distinct('courses.name')
                                                                            ->get();
                        
                $top_3_streams_wise_things->$stream_name->top_coachings = DB::table('coaching_courses')
                                                                    ->where('streams.id', $stream->id)
                                                                    ->join('courses', 'courses.name', 'coaching_courses.name')
                                                                    ->join('streams', 'streams.id', 'courses.stream_id')
                                                                    ->select('courses.name')
                                                                    ->distinct('courses.name')
                                                                    ->get();
            }  else {

                $top_3_streams_wise_things->$stream_name->top_colleges = collect();
                                        
                $top_3_streams_wise_things->$stream_name->exams = collect();
                                
                $top_3_streams_wise_things->$stream_name->previous_year_papers = collect();
                        
                $top_3_streams_wise_things->$stream_name->top_coachings = collect();
            }
        }

        return $top_3_streams_wise_things;
    }
    
    public function top_streams_wise_things() {

        $top_streams_wise_things = DB::table('streams')
                                    ->select('id', 'name')
                                    ->whereNotIn('name', ['Engineering', 'Medical', 'MBA'])
                                    ->get()
                                    ->groupBy(
                                        function($query) {
                                            return $query->name;
                                        }
                                    );

        if( !empty($top_streams_wise_things) ) {

            foreach($top_streams_wise_things as $index => $stream) {

                $stream = $stream->get(0);

                if( !empty($stream) ) {
                                            
                    $stream->top_colleges = DB::table('college')
                                                                        ->where('stream_id', $stream->id)
                                                                        ->select('category')
                                                                        ->distinct('category')
                                                                        ->get();
                                            
                    $stream->exams = DB::table('exams')
                                                                ->where('exams.stream_id', $stream->id)
                                                                ->join('courses', 'courses.id', 'exams.course_id')
                                                                ->select('courses.name')
                                                                ->distinct('courses.name')
                                                                ->get();
                                    
                    $stream->previous_year_papers = DB::table('question_paper_subjects')
                                                                                ->where('question_paper_subjects.stream_id', $stream->id)
                                                                                ->join('courses', 'courses.id', 'question_paper_subjects.course_id')
                                                                                ->select('courses.name')
                                                                                ->distinct('courses.name')
                                                                                ->get();
                            
                    $stream->top_coachings = DB::table('coaching_courses')
                                                                        ->where('streams.id', $stream->id)
                                                                        ->join('courses', 'courses.name', 'coaching_courses.name')
                                                                        ->join('streams', 'streams.id', 'courses.stream_id')
                                                                        ->select('courses.name')
                                                                        ->distinct('courses.name')
                                                                        ->get();
                }  else {

                    $stream->top_colleges = collect();
                                            
                    $stream->exams = collect();
                                    
                    $stream->previous_year_papers = collect();
                            
                    $stream->top_coachings = collect();
                }
            }

        }
        
        return $top_streams_wise_things;
    }

    public function countries() {
        return DB::table('countries')
                ->select('id', 'name')
                ->get();        
    }

    public function blogs_category() {
        return DB::table('blogs_category')
                ->where('status', 'enable')
                ->get();
    }

    public function offers() {
        
        $currentdate = date('Y-m-d H:i:s');
        
        return (
            DB::table('offers')
                ->where('start_date','<=', $currentdate)
                ->where('expire_date','>=', $currentdate)
                ->where('is_shown', 'yes')
                ->where('status', 'enable')
                ->get()
        );

    }

    public function college_category() {

        return DB::table('college')
                ->join('college_category', 'college_category.name', 'college.category')
                ->whereNotNull('college.category')
                ->groupBy('college.category')
                ->where('college_category.status', 'enable')
                ->orderby('college_category.created_at', 'asc')
                ->get();
    }

    public function courses() {
        return DB::table('coaching_courses')
                ->where('status', 'enable')
                ->groupBy('name')
                ->get();
    }
    public function executiveExecutionCourses() {

        return DB::table('courses')
                ->join('streams', 'streams.id', 'courses.stream_id')
                 ->where('courses.status', 'enable')
                 ->where('streams.status', 'enable')
                 ->where('streams.name', 'Executive Education')
                 ->select('courses.*')
                ->orderby('streams.created_at', 'asc')
                ->orderby('courses.created_at', 'asc')
                ->get();
    }
    public function technlogyPatners() {
        $data= $this->executiveExecutionCourses();

        $coaching= array();
        foreach ($data as $value) {
            $coachingData= DB::table('coaching_courses')
                ->join('coaching', 'coaching.id', 'coaching_courses.coaching_id')
                ->where('coaching_courses.status', 'enable')
                ->where('coaching.status', 'enable')
                ->where('coaching_courses.name', $value->name)
                ->select('coaching.name')
                ->orderby('coaching_courses.created_at', 'asc')
                ->get();
            if(!empty($coachingData)){
                foreach($coachingData as $ch){
                    $coaching[]= $ch->name;
                }
            }
        }
        return array_unique($coaching);
    }
    public function colleges() {
        
        $colleges = DB::table('college')
                    ->select('courses_details')
                    ->where('status', 1)
                    ->orderby('college.created_at', 'asc')
                    ->get();

        if( !empty($colleges) ) {

            $array = array();
            
            foreach($colleges as $college) {

                $getcourse = json_decode($college->courses_details, true);

                if( !empty($getcourse) ) {
                    $array[] = array_values($getcourse);
                }

            }
        }
        
        $courses = array();
        foreach($array as $inner_array) {
                    
            foreach($inner_array as $inner_inner_array) {
                    
                foreach($inner_inner_array as $element) {

                    $courses[] = $element;
                }
            }

        }

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

        return DB::table('courses')
                ->join('streams', 'streams.id', 'courses.stream_id')
                ->whereIn('courses.id', $courses)
                ->whereIn('streams.id', $streams)
                ->select('streams.name', 'courses.name as course_name')
                ->distinct('courses.name')
                ->where('streams.status', 'enable')
                ->where('courses.status', 'enable')
                ->where('courses.type', 'college')
                ->orderby('streams.created_at', 'asc')
                ->orderby('courses.created_at', 'asc')
                ->get()
                ->groupBy(function ($query) {
                    return $query->name;
                });

    }
}
