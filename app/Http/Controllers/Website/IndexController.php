<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;
use Cookie;
use PDF;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Website\HeaderController;
use App\Http\Controllers\Website\FooterController;

class IndexController extends Controller
{

    public function index() {

        $header = new HeaderController();
        $footer = new FooterController();
        
        $searching = $this->searching();

        $cities_group_by_state = $this->cities_group_by_state();
        
        $trending_today = $this->trending_today();
        $colleges = $this->featured_colleges();

        $blogs = $this->blogs();
        $stream_wise_coachings = $this->stream_wise_coachings();
        $stream_wise_colleges = $this->stream_wise_colleges();
        $stream_wise_exams = $this->stream_wise_exams();
        $courses = $this->courses();
        
        $total = $this->total();
        $testimonials = $this->testimonials();
        $coaching_logo_link = $this->coaching_logo_link();
        
        $online_coachings = $this->online_coachings();
        $exams_data = $this->exams_data();
        
        $metatitle= 'Top Online Coachings, Courses, Explore Colleges, Exams and Education News';
        $metadescription= 'CoachingSelect is a resource on the coaching scenario in India. Top online IIT JEE coaching institutes. Best coaching institute for medical entrance exam in India. Listing of MBA Coaching Classes in India. Information of CLAT Coaching Classes. Top IAS and IPS Coaching Centres in Delhi & States. Top 10 online coaching institutes.';
        $metakeywords= 'best coaching for neet, coaching centre near me, ielts coaching centre near me, best online coaching for iit jee, Top Medical colleges in india, best online coaching for cat, Best Clat coaching in india, best iit coaching in kota, jee coaching near me, online tuition classes, best coaching classes, bank coaching near me';

        return view('website.index', compact('header', 'footer', 'searching', 'cities_group_by_state', 'trending_today', 'colleges', 'blogs', 'stream_wise_coachings', 'stream_wise_colleges', 'stream_wise_exams', 'courses', 'total', 'testimonials', 'coaching_logo_link', 'online_coachings','exams_data','metatitle','metadescription','metakeywords'));
    }


    public function exams_data() {
        return DB::table('exams')
                ->join(
                    'streams',
                    'streams.id',
                    'exams.stream_id'
                )
                ->where('exams.status', 'enable')
                ->where('streams.status', 'enable')
                ->take(35)
                ->distinct('streams.id')
                ->select('exams.title')
                ->orderBy('exams.created_at', 'desc')
                ->get();
    }
    public function searching() {
        $searching = array();

        $searching['online'] = DB::table('coaching')
                                ->join('coaching_courses', 'coaching_courses.coaching_id', 'coaching.id')
                                ->join('courses', 'courses.name', 'coaching_courses.name')
                                ->distinct('coaching_courses.name')
                                ->select('coaching_courses.name')
                                ->where('coaching.offering', 'LIKE', '%'.'online'.'%')
                                ->where('coaching.status', 'enable')
                                ->where('courses.status', 'enable')
                                ->where('coaching_courses.status', 'enable')
                                ->where('courses.type', 'coaching')
                                ->get();
                                
        $searching['classroom'] = DB::table('coaching')
                                ->join('coaching_courses', 'coaching_courses.coaching_id', 'coaching.id')
                                ->join('courses', 'courses.name', 'coaching_courses.name')
                                ->distinct('coaching_courses.name')
                                ->select('coaching_courses.name')
                                ->where('coaching.offering', 'LIKE', '%'.'classroom'.'%')
                                ->where('coaching.status', 'enable')
                                ->where('courses.status', 'enable')
                                ->where('coaching_courses.status', 'enable')
                                ->where('courses.type', 'coaching')
                                ->get();
                                
        $searching['tutor'] = DB::table('coaching')
                                ->join('coaching_courses', 'coaching_courses.coaching_id', 'coaching.id')
                                ->join('courses', 'courses.name', 'coaching_courses.name')
                                ->distinct('coaching_courses.name')
                                ->select('coaching_courses.name')
                                ->where('coaching.offering', 'LIKE', '%'.'tutor'.'%')
                                ->where('coaching.status', 'enable')
                                ->where('courses.status', 'enable')
                                ->where('coaching_courses.status', 'enable')
                                ->where('courses.type', 'coaching')
                                ->get();
                                
        $searching['all'] = DB::table('coaching')
                                ->join('coaching_courses', 'coaching_courses.coaching_id', 'coaching.id')
                                ->join('courses', 'courses.name', 'coaching_courses.name')
                                ->distinct('coaching_courses.name')
                                ->select('coaching_courses.name')
                                ->where('coaching.status', 'enable')
                                ->where('courses.status', 'enable')
                                ->where('coaching_courses.status', 'enable')
                                ->where('courses.type', 'coaching')
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
                ->where('states.country_id', 101)
                ->groupBy('cities.name')
                ->select('states.name as state', 'cities.name as name')
                ->get()
                ->groupBy('state');
    }

    public function trending_today() {
        return DB::table('trending_today')
                ->where('status', 'enable')
                ->orderBy('created_at','desc')
                ->limit(6)
                ->get();
    }

    public function colleges() {
        $colleges = DB::table('college')
                    ->join('states', 'states.id', 'college.state_id')
                    ->join('cities', 'cities.id', 'college.city_id')
                    ->where('college.status', 1)
                    ->select('college.college_name', 'states.name as state', 'cities.name as city', 'college.images', 'college.ranking', 'college.landing_page_highlight_course'
                    , 'college.courses_details'
                    , 'college.course_fee'
                    , 'college.background_image'
                    , 'college.image'
                    )
                    ->take(6)
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
    
            }
        }

        return $colleges;
    }
    public function featured_colleges() {
        $colleges = DB::table('college')
                    ->leftjoin('states', 'states.id', 'college.state_id')
                    ->leftjoin('cities', 'cities.id', 'college.city_id')
                    ->where('college.status', 1)
                    ->where('college.featured', 1)
                    ->select('college.college_name', 'states.name as state', 'cities.name as city', 'college.images', 'college.ranking', 'college.landing_page_highlight_course'
                    , 'college.courses_details'
                    , 'college.course_fee'
                    , 'college.background_image'
                    , 'college.image'
                    , 'college.stream_id',
                    'college.reviews_ratings'
                    )
                    ->take(6)
                    ->get();
                    
                    
        if( !empty($colleges) ) {
            foreach($colleges as $key => $college) {

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

                $total_stream_enabled = DB::table('streams')
                                        ->whereIn('id', explode(',', $college->stream_id))
                                        ->where('status', 'enable')
                                        ->count();

            }
        }

        return $colleges;
    }

    public function blogs() {
        return DB::table('blogs')
                ->where('blogs.status', 'enable')
                ->take(3)
                ->orderBy('blogs.id', 'desc')                
                ->join('blogs_category', 'blogs_category.id', 'blogs.blog_category_id')
                ->where('blogs.status', 'enable')
                ->where('blogs_category.status', 'enable')
                ->select('blogs.*')
                ->get();                
    }

    public function stream_wise_coachings() {
        $coachings =  DB::table('coaching')
                        ->join('coaching_courses', 'coaching_courses.coaching_id', 'coaching.id')
                        ->join('coaching_courses_detail', 'coaching_courses_detail.coaching_courses_id', 'coaching_courses.id')
                        ->join('courses', 'courses.name', 'coaching_courses.name')
                        ->join('streams', 'streams.id', 'courses.stream_id')
                        ->select(
                            'streams.name',
                            'coaching.name as cname',
                            'coaching_courses.name as ccname',
                            DB::raw('count(coaching.id) as total_coachings'),
                            'streams.image'
                        )
                        ->distinct('coaching.id')
                        ->groupBy('name')
                        ->where('streams.status', 'enable')
                        ->where('coaching.status', 'enable')
                        ->where('courses.type', 'coaching')
                        ->get();

        if( !empty($coachings) ) {
            foreach ($coachings as $coaching) {
                $coaching->total_coachings = DB::table('coaching')
                                            ->join('coaching_courses', 'coaching_courses.coaching_id', 'coaching.id')
                                            ->join('coaching_courses_detail', 'coaching_courses_detail.coaching_courses_id', 'coaching_courses.id')
                                            ->join('courses', 'courses.name', 'coaching_courses.name')
                                            ->join('streams', 'streams.id', 'courses.stream_id')
                                            ->distinct('coaching.id')
                                            ->groupBy('coaching.id')
                                            ->where('streams.status', 'enable')
                                            ->where('coaching.status', 'enable')
                                            ->where('coaching_courses.status', 'enable')
                                            ->where('coaching_courses_detail.status', 'enable')
                                            ->where('streams.name', $coaching->name)
                                            ->where('courses.type', 'coaching')
                                            ->get()
                                            ->count();

                
            }
        }

        $coachings = $coachings->filter(function($item) {
            return $item->total_coachings != 0;
        });

        return $coachings;
    }

    public function stream_wise_colleges() {
        $colleges = DB::table('college')
                        ->select('stream_id')
                        ->where('status', 1)
                        ->get();

        $streams_array = array();

        if( !empty($colleges) ) {
            foreach($colleges as $college) {
                $streams = explode(',', $college->stream_id);

                if( !empty($streams) ) {
                    foreach($streams as $stream) {

                        $is_enabled = DB::table('streams')
                                        ->where('id', $stream)
                                        ->where('status', 'enable')
                                        ->first();

                        if( !empty($is_enabled) ) {
                            $streams_array[$stream]['count'] = isset($streams_array[$stream]['count']) ?
                                                                $streams_array[$stream]['count'] + 1 :
                                                                1 ;
                        }
                    }
                }
            }
        }

        $streams_ids = array_keys($streams_array);

        $streams = DB::table('streams')
                    ->whereIn('id', $streams_ids)
                    ->where('status', 'enable')
                    ->get()
                    ->toArray();
            
        if( !empty($streams) ) {
            foreach($streams as $stream) {
                $streams_array[$stream->id]['name'] = $stream->name;
                $streams_array[$stream->id]['image'] = $stream->image;
            }
        }

        return $streams_array;
    }

    public function stream_wise_exams() {
        return DB::table('exams')
                ->join('streams', 'streams.id', 'exams.stream_id')
                ->select(DB::raw('count(exams.id) as total_exams'), 'streams.name', 'streams.image')
                ->where('streams.status', 'enable')
                ->groupBy('streams.name')
                ->get();
    }

    public function courses() {
        return DB::table('courses')                
                ->join('coaching_courses', 'courses.name', 'coaching_courses.name')
                ->join('coaching', 'coaching_courses.coaching_id', 'coaching.id')
                ->where('coaching_courses.status', 'enable')
                ->where('coaching.status', 'enable')
                ->select('courses.name')
                ->groupBy('courses.name')
                ->get();
    }

    public function total() {
        $total = array();

        $total['coaching'] = DB::table('coaching')
                                ->where('status', 'enable')
                                ->orWhere('status', 1)
                                ->count();
                                
        $total['college'] = DB::table('college')
                                ->where('status', 'enable')
                                ->orWhere('status', 1)
                                ->count();
                                
        $total['courses'] = DB::table('courses')
                                ->where('status', 'enable')
                                ->orWhere('status', 1)
                                ->count();
                                
        $total['exams'] = DB::table('exams')
                                ->where('status', 'enable')
                                ->orWhere('status', 1)
                                ->count();
        
        $q1 = DB::table('student_questions');
        $q2 = DB::table('student_answers')
              ->join('student_questions', 'student_questions.id', 'student_answers.student_question_id')
              ->select('student_answers.*');

              
        $total['q_and_a'] = $q1->union($q2)->count();
                                
        return $total;
    }

    public function testimonials() {
        return DB::table('testimonials')
                ->where('status', 'enable')
                ->orWhere('status', 1)
                ->get();
    }
    
    public function coaching_logo_link() {
        return DB::table('coaching')
                    ->where('coaching.status', 'enable')
                    ->where('coaching.is_featured', 1)
                    ->select('coaching.image','coaching.name')
                    ->get();
    }

    public function online_coachings() {

        $coachings = DB::table('coaching')
                    ->join(
                        'coaching_courses_detail', 
                        'coaching_courses_detail.coaching_id',
                        'coaching.id'
                    )
                    ->where('coaching.status', 'enable')
                    ->where('coaching_courses_detail.status', 'enable')
                    ->where('coaching_courses_detail.is_featured', 1)
                    ->orderBy('coaching_courses_detail.offer_percentage', 'desc')
                    ->take(6)
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
                                ->where('status', 'enable')
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
                                                ->where('status', 'enable')
                                                ->count();
                                                        
                    $coaching->ratings = $this->ratings($coaching->id);
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

    public function about_us(){
        $header = new HeaderController();
        $footer = new FooterController();

        $metatitle = "Best  NEET, JEE & IIT Coaching All Over India, 40+ Exams Preparation";
        $metadescription = "Online help portal to select the most excellent coaching for exam preparation and an extensive search engine for the students, parents, and education industry players who are seeking information on the coaching sector in India. ";

        $metakeywords = "Best JEE and NEET Coaching, JEE Advance preparation at home,NEET Coaching Near me, find best coaching near me, Online Coaching for SSC CGL";

        return view('website.about-us',compact('metatitle'
        , 'metadescription', 'metakeywords'
        ,'header','footer'));
    }
    public function careers(){
         $header = new HeaderController();
        $footer = new FooterController();

        $metatitle= "Careers in CoachingSelect - Jobs in CoachingSelect - Current openings in CoachingSelect";

        $metadescription = 'Find latest jobs, current openings and walk-in interviews at CoachingSelect. Click to apply online';
        
        $metakeywords = 'CoachingSelect, latest jobs, walk-in interviews';

        return view('website.careers',compact(
            'metatitle',
            'metadescription',
            'metakeywords','header','footer'));
    }
   public function contact_us(Request $request){
        
        $header = new HeaderController();
        $footer = new FooterController();
       
        if(request()->isMethod('post')){
       
           $contact['fullname']=$request->fullname;
           $contact['phone']=$request->phone;
           $contact['email']=$request->email;
           $contact['franchise']=$request->franchise;
           $contact['message']=$request->message;

           if( 
               preg_match('/^[6-9]\d{9}$/', $request->phone)
           ) {
               DB::table('contactus')->insert($contact);
           } else {
               return redirect()
                        ->back()
                        ->with('danger', 'Please enter valid mobile number');
           }
           
           try {
  
                // send mail
                $email = $contact['email'];
                        
                $subject = 'Your CoachingSelect Contact form submission';
        
                if( !empty($email) ) {
                        
                    $datamessage['email']=$email;
            		$datamessage['subject']=$subject;
            		
            	    \Mail::send('mails.contact_us', [], function ($m) use ($datamessage){
            			$m->from('support@coachingselect.com', 'CoachingSelect');
            			$m->to($datamessage['email'])->subject($datamessage['subject']);
            		});
            		
                }
                                
            } catch(\Exception $e) {
                // ignore mail error
            }
           
           return back()->with('success', 'Thank you for contact with coachingselect');
       } else{
        
        $metatitle = "Contact Us - CoachingSelect";

        $metadescription = 'CoachingSelect - Contact Us.';
        
        $metakeywords = 'CoachingSelect - Contact Us';

        return view('website.contact-us',compact(
            'metatitle',
            'metadescription',
            'metakeywords',
            'header','footer'));
       }
   }
    public function disclaimer(){
         $header = new HeaderController();
        $footer = new FooterController();

        $metatitle = "Disclaimer - CoachingSelect";

        return view('website.disclaimer',compact('metatitle','header','footer'));
    }
    public function faq(){
         $header = new HeaderController();
        $footer = new FooterController();

        $metatitle = "FAQ (Frequently Asked Questions)  - CoachingSelect";

        $metadescription = 'FAQ (Frequently Asked Questions) - Coachings, Scholarships, Offers, askus, Expert Opinion Career Counselling | CoachingSelect';

        $metakeywords = 'FAQ, Frequently Asked Questions, Coachings, Scholarships, Offers, askus, Expert Opinion Career Counselling';

        return view('website.faq',compact('metatitle',
        'metadescription',
        'metakeywords',
        'header','footer'));
    }
    public function terms_condition(){
         $header = new HeaderController();
        $footer = new FooterController();

        $metatitle = "Terms & Conditions - CoachingSelect";

        $metadescription = 'Terms & Conditions - CoachingSelect';

        $metakeywords = 'Terms & Conditions - CoachingSelect';

        return view('website.terms&conditions',compact(
            'metatitle',
            'metadescription',
            'metakeywords',
            'header','footer'));
    }
    public function privacy_policy(){
         $header = new HeaderController();
        $footer = new FooterController();

        $metatitle = "Privacy Policy - CoachingSelect";

        $metadescription = 'Privacy Policy - CoachingSelect.';

        $metakeywords = 'Privacy Policy - CoachingSelect';

        return view('website.privacy-policy',compact(
            'metatitle',
            'metadescription',
            'metakeywords',
            'header','footer'));
    }
    public function cookies(){
         $header = new HeaderController();
        $footer = new FooterController();

        $metatitle = "Cookies - CoachingSelect";

        return view('website.cookies',compact('metatitle','header','footer'));
    }
    
    public function thank_you(){
         $header = new HeaderController();
        $footer = new FooterController();

        $metatitle = "Thank You - CoachingSelect";

        return view('website.thank_you',compact('metatitle','header','footer'));
    }
    public function requestcallback(Request $request){
        
        $callback = array();
        $callback=$request->all();

        if(!empty($request->coaching_id)){
            $callback['coaching_id']=$request->coaching_id;
            $coaching_name=$request->coaching_name;
             $callback['name'] = $request->name;
              unset($callback['coaching_name']);
            $msg= 'Thank You for showing interest in ‘'.$coaching_name.'’';
        }else{
             $msg= 'Thank You for showing interest';
        }
       unset($callback['_token']);

       DB::table('request_callback')->insert($callback);
       return redirect()->action('Website\IndexController@thank_you_2', $msg);
       
   }
   public function thank_you_2($msg){
         $header = new HeaderController();
        $footer = new FooterController();

        $metatitle = "Thank You - CoachingSelect";

        return view('website.thank_you_2',compact('metatitle','header','footer','msg'));
    }

    
    public function authors(){

        // try {
  
        //     $email = 'vedantsain53@gmail.com';
                    
        //     $subject = 'Test';
    
        //     if( !empty($email) ) {
                    
        //         $datamessage['email']=$email;
        //         $datamessage['subject']=$subject;
                
        //         \Mail::send('mails.contact_us1', [], function ($m) use ($datamessage){
        //             $m->from('support@coachingselect.com', 'CoachingSelect');
        //             $m->to($datamessage['email'])->subject($datamessage['subject']);
        //         });
                
        //     }
                            
        // } catch(\Exception $e) {

        //     // dd($e->getMessage());
        //     // ignore mail error
        // }

        $header = new HeaderController();
        $footer = new FooterController();

        $metatitle = "Management Team - CoachingSelect";

        return view('website.authors',compact('metatitle','header','footer'));
    }
    public function Community_Guidelines(){
        $header = new HeaderController();
        $footer = new FooterController();

        $metatitle = "Community Guidelines - CoachingSelect";

        return view('website.community_guidelines',compact('metatitle','header','footer'));
    }
    
    public function cancel_signup($student_or_enterprise) {
        if($student_or_enterprise == 'student') {
            session()->forget('tempstudent');
        }
        
        if($student_or_enterprise == 'enterprise') {
            session()->forget('tempenterprise');
        }
        
        return redirect()->back();
    }
}

