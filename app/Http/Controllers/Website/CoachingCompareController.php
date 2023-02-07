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

class CoachingCompareController extends Controller
{

    public function compare() {

        $coachings = request()->get('coachings') ?? [];

        $header = new HeaderController();
        $footer = new FooterController();
        
        $coaching_search_autocomplete = $this->coaching_search_autocomplete();

        $coachings = $this->coachings($coachings);  

        $facilitys = $this->facilitys($coachings);
    
        $metatitle= "Compare Coachings- Coaching Comparison based on Courses, Scholarships, Rank, Fee, Reviews and Facilities";

        $metadescription = 'Compare Coachings based on its Courses, Facilities, Faculties, Centers, Reviews and Know More..';
        
        $metakeywords = 'CoachingSelect, coaching, education, colleges, universities, institutes,career, career options, career prospects, engineering, mba, medical, mbbs, study abroad, foreign education, college, university, institute,courses, coaching, technical education, higher education, forum, community, education career experts, ask experts, admissions, results, events, scholarships';

        return view('website.compare', compact(
            'metatitle',
            'metadescription',
            'metakeywords',
            'header', 'footer', 'coaching_search_autocomplete', 'coachings', 'facilitys'));
    }  
        
    public function coaching_search_autocomplete() {
        
        $coaching = DB::table('coaching')
                    ->where('status', 'enable')
                    ->pluck('name')
                    ->toArray();

        return $coaching;
    }

    public function coachings($coachings) {

        if( !empty($coachings) ) {

            $coachings = array_map('strtolower', $coachings);

            $coachings = array_unique($coachings);

            foreach ($coachings as $index => $coaching_name) {
                
                $coaching = DB::table('coaching')
                            ->where('name', $coaching_name)
                            ->first();

                if( !empty($coaching) ) {
                        
                    $coachings[$index] = array();

                    $coachings[$index]['name'] = $coaching_name;
                    $coachings[$index]['image'] = $coaching->image;

                    $coachings[$index]['details'] = $coaching;

                    $coachings[$index]['branch'] = DB::table('coaching_centers_branches')
                                                    ->where('coaching_id', $coaching->id)
                                                    ->where('status', 'enable')
                                                    ->first();
                                                    
                    $coachings[$index]['courses'] = DB::table('coaching_courses_detail')
                                                    ->join('coaching_courses', 'coaching_courses.id', 'coaching_courses_detail.coaching_courses_id')
                                                    ->where('coaching_courses.coaching_id', $coaching->id)
                                                    ->where('coaching_courses.status', 'enable')
                                                    ->select('coaching_courses_detail.*', 'coaching_courses.name as coaching_courses_name')
                                                    ->get()
                                                    ->groupBy(
                                                        function($query) {
                                                            return $query->coaching_courses_name;
                                                        }
                                                    );
                                                    
                    $coachings[$index]['faculty'] = DB::table('coaching_faculty')
                                                    ->where('coaching_faculty.coaching_id', $coaching->id)
                                                    ->where('coaching_faculty.status', 'enable')
                                                    ->select('coaching_faculty.id')
                                                    ->get()
                                                    ->count();
                                                    
                    $coachings[$index]['total_ratings'] = $this->ratings($coaching->id);
                    
                    $coachings[$index]['centers'] = DB::table('coaching_centers_branches')
                                                    ->join('coaching_centers', 'coaching_centers.id', 'coaching_centers_branches.coaching_centers_id')
                                                    ->where('coaching_centers.coaching_id', $coaching->id)
                                                    ->where('coaching_centers.status', 'enable')
                                                    ->select('coaching_centers_branches.*', 'coaching_centers.name as coaching_centers_name')
                                                    ->get()
                                                    ->groupBy(
                                                        function($query) {
                                                            return $query->coaching_centers_name;
                                                        }
                                                    );
                                                    
                    $coachings[$index]['facility'] = DB::table('coaching_facility')
                                                    ->join('facility', 'facility.name', 'coaching_facility.name')
                                                    ->where('coaching_facility.coaching_id', $coaching->id)
                                                    ->where('coaching_facility.status', 'enable')
                                                    ->groupBy('facility.name')
                                                    ->pluck('facility.name')
                                                    ->toArray();

                }
            }
        }

        return $coachings;

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

    public function facilitys($coachings) {
        
        $facilitys = DB::table('coaching_facility')
                    ->join('facility', 'facility.name', 'coaching_facility.name')
                    ->where('coaching_facility.status', 'enable')
                    ->groupBy('facility.name');

        $coaching_ids = array();

        if( !empty($coachings) ) {

            foreach ($coachings as $index => $coaching_name) {

                if( !empty($coachings[$index]['details']) ) {
                    $coaching_ids[] = $coachings[$index]['details']->id;
                }
            }
        }


        $facilitys = $facilitys  
                    ->whereIn('coaching_facility.coaching_id', $coaching_ids)            
                    ->get();

        return $facilitys;

    }

}

