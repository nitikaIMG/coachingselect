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

class CounsellingController extends Controller
{
    public function career_counselling() {

        $header = new HeaderController();
        $footer = new FooterController();
        
        $career_counselling = $this->all_career_counselling();

        $counselling_testimonials = $this->counselling_testimonials();
        $counselling_faq = $this->counselling_faq();

        $metatitle = 'Online Career Counselling | Best Career guidance platform in India - CoachingSelect';
        
        $metadescription = 'Get personalised guidance, career counselling online FREE for students from CoachingSelect India & most trusted counsellors who help you pick the right career path.';

        $metakeywords = 'CoachingSelect, Online career counselling, Best Online career counselling, Career counselling, Online career counselling in India, Trusted career counselling , Career counselling near me,careers after Class X,careers after Class XII, careers after graduation, immigration counselling, canada visa counselling, australia visa assistance, overseas education counselling, caeer guidance couselling, customize counselling';
        
        $getStates = DB::table('states')->where('country_id', 101)->get();
        
        return view('website.career_counselling', compact('metatitle',
        'metadescription', 'metakeywords',
        'header', 'footer', 'career_counselling', 'counselling_testimonials', 'counselling_faq','getStates'));
    }

    public function all_career_counselling() {
        
        $all_career_counselling =  DB::table('counselling')
                                    ->where('status', 'enable')
                                    ->whereIn('type', ["Career after X", "Career after XII", "Career after graduation", "Customize Counselling"])
                                    ->orderBy(DB::raw('FIELD(type, "Career after X", "Career after XII", "Career after graduation", "Customize Counselling")'))
                                    ->get()
                                    ->groupBy('type');

        if( !empty($all_career_counselling) ) {

            foreach ($all_career_counselling as $type => $counselling) {
                
                foreach ($counselling as $counselling_single) {
                    $counselling_single->specification = DB::table('counselling_specification')
                                                            ->where('counselling_id', $counselling_single->id)
                                                            ->get();
                }

            }

        }

        return $all_career_counselling;
    }
    
    public function counselling_testimonials() {
        return DB::table('counselling_testimonials')
                ->where('status', 'enable')
                ->orWhere('status', 1)
                ->get();
    }
    public function counselling_faq() {
        return DB::table('counselling_faq')
                ->where('status', 'enable')
                ->orWhere('status', 1)
                ->get();
    }
}

