<?php

namespace App\Http\Controllers\Website;

use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;
use Request;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Website\HeaderController;
use App\Http\Controllers\Website\FooterController;

class CoachingController extends Controller
{
    
    public function overview($coaching_name_slug, $branch_slug = '') {

        $coaching_name = str_replace('-', ' ', $coaching_name_slug);



        $coaching = DB::table('coaching')
                    ->where('name', $coaching_name)
                    ->where('status', 'enable')
                    ->first();


       

        if( !empty($coaching) ) {  
                       
            # increase a view
            $centers = DB::table('coaching_centers')
                    ->join('coaching_centers_branches', 'coaching_centers_branches.coaching_centers_id', 'coaching_centers.id')
                    ->where('coaching_centers.coaching_id', $coaching->id)
                    ->where('coaching_centers_branches.status', 'enable')
                    ->select('coaching_centers.*')
                    ->groupBy('coaching_centers.name')
                    ->get();
            $this->view($coaching->id);

            if( !empty($branch_slug) ) {
                
                 $branchname = DB::table('coaching_centers_branches')
                                        ->where('coaching_id', $coaching->id)
                                        ->where('status', 'enable')
                                        ->orderBy('created_at','asc')
                                        ->first();
                if(!empty($branchname)){
                    $branch_slug1= str_replace('.', '-', str_replace(' ', '-', $branchname->name) );
                        
                    if($branch_slug1 == $branch_slug){
                        return redirect()
                            ->action(
                                'Website\CoachingController@overview',
                                [
                                    $coaching_name_slug
                                ]
                            ); 
                    }
                }
                $total_branches = DB::table('coaching_centers')
                                    ->join('coaching_centers_branches', 'coaching_centers_branches.coaching_centers_id', 'coaching_centers.id')
                                    ->where('coaching_centers.coaching_id', $coaching->id)
                                    ->where('coaching_centers_branches.status', 'enable')
                                    ->count();
                if($total_branches >= 2) {

                } else {
                    return $this->redirect_to_correct_branch($coaching->id, $coaching_name_slug, '');
                }

                $is_correct_branch = $this->is_correct_branch($coaching->id, $coaching_name_slug, $branch_slug);
           
                if( $is_correct_branch ) {
                    $coaching->branch = $is_correct_branch;
                } 
                else {
                    return $this->redirect_to_correct_branch($coaching->id, $coaching_name_slug, $branch_slug);
                    
                }
                
                if( !empty($coaching->branch) ) {
                    $coaching->branches_in_same_center = DB::table('coaching_centers_branches')
                                                            ->where('coaching_centers_id', $coaching->branch->coaching_centers_id)
                                                            ->where('name', '!=', $coaching->branch->name)
                                                            ->where('status', 'enable')
                                                            ->select('name')
                                                            ->get();
                }

            } else {

                $centers = DB::table('coaching_centers')
                    ->join('coaching_centers_branches', 'coaching_centers_branches.coaching_centers_id', 'coaching_centers.id')
                    ->where('coaching_centers.coaching_id', $coaching->id)
                    ->where('coaching_centers_branches.status', 'enable')
                    ->select('coaching_centers.*')
                    ->groupBy('coaching_centers.name')
                    ->get();
                    
                    $coaching->branch =  DB::table('coaching_centers_branches')
                                        ->join('coaching_centers', 'coaching_centers.id', 'coaching_centers_branches.coaching_centers_id')
                                        ->where('coaching_centers_branches.coaching_id',  $coaching->id)
                                        ->select('coaching_centers_branches.*', 'coaching_centers.name as center_name')
                                        ->where('coaching_centers_branches.status', 'enable')
                                        ->first();
                    
                    if( !empty($coaching->branch) ) {
                        $coaching->branches_in_same_center = DB::table('coaching_centers_branches')
                                                                ->where('coaching_centers_id', $coaching->branch->coaching_centers_id)
                                                                ->where('name', '!=', $coaching->branch->name)
                                                                ->where('status', 'enable')
                                                                ->select('name')
                                                                ->get();

                    }
                    
            }

            $header = new HeaderController();
            $footer = new FooterController();

            $coaching->coaching_name_slug = $coaching_name_slug;

            $coaching->facility = DB::table('coaching_facility')
                                    ->join('facility', 'facility.name', 'coaching_facility.name')
                                    ->where('coaching_facility.coaching_id', $coaching->id)
                                    ->where('coaching_facility.status', 'enable')
                                    
                                    ->get();

            $coaching->faculty = DB::table('coaching_faculty')
                                    ->where('coaching_faculty.coaching_id', $coaching->id)
                                    ->where('coaching_faculty.status', 'enable')
                                    ->get();
                                    
            $coaching->results = DB::table('coaching_results')
                                    ->join('courses', 'courses.id', 'coaching_results.coaching_courses_id')
            
                                    ->where('coaching_results.coaching_id', $coaching->id)
                                    ->where('coaching_results.status', 'enable')
                                    ->select('coaching_results.*', 'courses.name as courses_name')
                                    ->get()
                                    ->groupBy(
                                        function($query) {
                                            return $query->courses_name;
                                        }
                                    );
            
            $coaching->testimonials = DB::table('coaching_testimonials')
                                    ->join('courses', 'courses.id', 'coaching_testimonials.coaching_courses_id')
                                    ->where('coaching_testimonials.coaching_id', $coaching->id)
                                    ->where('coaching_testimonials.status', 'enable')
                                    ->where('courses.status', 'enable')
                                    ->select('coaching_testimonials.*', 'courses.name as coaching_courses_name')
                                    ->get()
                                    ->groupBy(
                                        function($query) {
                                            return $query->coaching_courses_name;
                                        }
                                    );

            $coaching->photos = DB::table('coaching_photos')
                                    ->where('coaching_photos.coaching_id', $coaching->id)
                                    ->where('coaching_photos.status', 'enable')
                                    ->get();
                                    
            $coaching->videos = DB::table('coaching_videos')
                                    ->where('coaching_videos.coaching_id', $coaching->id)
                                    ->where('coaching_videos.status', 'enable')
                                    ->get();
            
            $coaching_logo_link = DB::table('coaching')
                                    ->where('status', 'enable')
                                    ->where('is_featured', 1)
                                    ->select('image','name')
                                    ->get();

            $coaching->courses = DB::table('coaching_courses_detail')
                                    ->join('coaching_courses', 'coaching_courses.id', 'coaching_courses_detail.coaching_courses_id')
                                    ->where('coaching_courses.coaching_id', $coaching->id)
                                    ->where('coaching_courses.status', 'enable')
                                    ->where('coaching_courses_detail.status', 'enable')
                                    ->select('coaching_courses_detail.*', 'coaching_courses.name as coaching_courses_name')
                                    ->get()
                                    ->groupBy(
                                        function($query) {
                                            return $query->coaching_courses_name;
                                        }
                                    );

            $coaching->courses_for_reviews = DB::table('coaching_courses')
                                                ->where('coaching_id', $coaching->id)
                                                ->where('status', 'enable')
                                                ->get();

            # favorite coaching
            $coaching->is_this_my_favorite = false;

            if( session()->has('student') ) {
                
                $favorite = array();
                $favorite['user_id'] = session()->get('student')->id;
                $favorite['coaching_id'] = $coaching->id;

                # is in my favorite list
                $has_already_favorite = DB::table('student_favorite_coaching')
                                        ->where('user_id', $favorite['user_id'])
                                        ->where('coaching_id', $favorite['coaching_id'])
                                        ->exists();

                $coaching->is_this_my_favorite = $has_already_favorite;

                # my review on this coaching
                $my_review = DB::table('coaching_reviews')
                                ->where('user_id', $favorite['user_id'])
                                ->where('coaching_id', $favorite['coaching_id'])
                                ->first();

                $coaching->my_review = $my_review;
                $coaching->all_my_reviews = $this->all_my_reviews($coaching->id,$favorite['user_id']);
            }
            
            # request callback
            $coaching->has_requested_for_callback = false;

            if( session()->has('student') ) {
                

                $request_callback = array();
                $request_callback['user_id'] = session()->get('student')->id;
                $request_callback['coaching_id'] = $coaching->id;

                # is in my request_callback list
                $has_requested_for_callback = DB::table('student_request_callback')
                                            ->where('user_id', $request_callback['user_id'])
                                            ->where('coaching_id', $request_callback['coaching_id'])
                                            ->exists();

                
                $coaching->has_requested_for_callback = $has_requested_for_callback;
            }

            $coaching->ratings = $this->ratings($coaching->id);
            
            $coaching->reviews = $this->all_reviews($coaching->id);
            
            $getStates = DB::table('states')->where('country_id', 101)->get();
            
            if( !empty($coaching->city) )
                $metatitle= "$coaching->name coaching centre near me - Fees, Courses, Offers, Reviews, Ranking ".date('Y')."";
            else
                $metatitle= "$coaching->name coaching centre near me - Fees, Courses, Offers, Reviews, Ranking ".date('Y')."";
            

            $metadescription= "$coaching->name Coaching Classes in India. Find ✓$coaching->name Institutes, ✓$coaching->name Coaching Centre, ✓$coaching->name Classes, ✓$coaching->name coaching centre near me. Get Phone Numbers, Address, Reviews, Photos, Maps for top $coaching->name Training near me in india on Coaching Select";
            $metakeywords="$coaching->name coaching centre near me, List of Institutes For $coaching->name in India, Reviews, Map, Address, Phone Number, Contact Number, local, popular Institutes For $coaching->name, Institutes For $coaching->name";
            
            // nearest coachings
            if( !empty($coaching->branch) ) {
                if( 
                    !empty($coaching->branch->latitude) and !empty($coaching->branch->longitude)
                ) {
                    
                    $latitude       =       $coaching->branch->latitude;
                    $longitude      =       $coaching->branch->longitude;
                    
                
                    $coaching_logo_link     =  DB::table('coaching_centers')
                                                ->join('coaching_centers_branches', 'coaching_centers_branches.coaching_centers_id', 'coaching_centers.id')
                                                ->join('coaching', 'coaching.id', 'coaching_centers.coaching_id')
                                                ->where('coaching_centers_branches.status', 'enable')
                                                ->where('coaching_centers.status', 'enable')
                                                ->where('coaching.status', 'enable')
                                                ->where('coaching.id', '!=', $coaching->id)
                                                ->groupBy('coaching.id');
                    
                    $coaching_logo_link     = $coaching_logo_link->select("coaching.image", "coaching.name", DB::raw("6367 * acos(cos(radians(" . $latitude . "))
                                            * cos(radians(coaching_centers_branches.latitude)) * cos(radians(coaching_centers_branches.longitude) - radians(" . $longitude . "))
                                            + sin(radians(" .$latitude. ")) * sin(radians(coaching_centers_branches.latitude))) AS distance"));
                    
                    $coaching_logo_link          =  $coaching_logo_link->having('distance', '<', 3000);
                    $coaching_logo_link          =  $coaching_logo_link->orderBy('distance', 'asc');
                    
                    $coaching_logo_link          =  $coaching_logo_link
                                                    ->get(); 
                }
                
            }

            return view('website.overview', compact('metatitle', 'header', 'footer', 'coaching', 'coaching_logo_link','centers','getStates','metadescription','metakeywords'));

        } else {
            abort(404);
        }

    }

    public function is_correct_branch($coaching_id, $coaching_name_slug, $branch_slug) {

        $branch_name = str_replace('-', ' ', $branch_slug);

        $branch = DB::table('coaching_centers_branches')
                    ->join('coaching_centers', 'coaching_centers.id', 'coaching_centers_branches.coaching_centers_id')
                    ->where('coaching_centers_branches.name', $branch_name)
                    ->where('coaching_centers.coaching_id', $coaching_id)
                    ->select('coaching_centers_branches.*', 'coaching_centers.name as center_name')
                    ->where('coaching_centers_branches.status', 'enable')
                    ->first();

        # its own branch
        if( !empty($branch) ) {
            return $branch;
        } 
    }

    public function redirect_to_correct_branch($coaching_id, $coaching_name_slug, $branch_slug) {

        $branch_name = str_replace('-', ' ', $branch_slug);

        $city = DB::table('coaching_centers')
                ->where('coaching_id', $coaching_id)
                ->where('name', $branch_name)
                ->first();

        if( !empty($city) ) {

            $first_branch = DB::table('coaching_centers_branches')
                                ->where('coaching_centers_id', $city->id)
                                ->where('status', 'enable')
                                ->first();

            if( !empty($first_branch) ) {

                $branch_slug = str_replace(' ', '-', $first_branch->name);

                return redirect()
                            ->action(
                                'Website\CoachingController@overview',
                                [
                                    $coaching_name_slug,
                                    $branch_slug
                                ]
                            );
            }
        }

        return redirect()
                    ->action(
                        'Website\CoachingController@overview',
                        [
                            $coaching_name_slug
                        ]
                    );
    }

    public function add_to_favorite($coaching_id) {
        
        if( session()->has('student') ) {
            
            $favorite = array();
            $favorite['user_id'] = session()->get('student')->id;
            $favorite['coaching_id'] = $coaching_id;

            $has_already_favorite = DB::table('student_favorite_coaching')
                                    ->where('user_id', $favorite['user_id'])
                                    ->where('coaching_id', $favorite['coaching_id'])
                                    ->exists();

            if($has_already_favorite) {
                DB::table('student_favorite_coaching')
                    ->where('user_id', $favorite['user_id'])
                    ->where('coaching_id', $favorite['coaching_id'])
                    ->delete();
            } else {
                DB::table('student_favorite_coaching')
                ->insert($favorite);
            }
             return redirect()
                        ->back()
                        ->with('success', 'Successfully added in favorite');
        }

       return redirect()
                    ->back();
    }

    public function student_review() {

        if( session()->has('student') ) {
            
            $review = array();
            $review = request()->except('_token');
            $review['user_id'] = session()->get('student')->id;

            if( 
                empty($review['user_id']) or                
                empty($review['coaching_id']) or                
                empty($review['faculty_stars']) or                
                empty($review['study_materials_stars']) or                
                empty($review['doubt_clearing_stars']) or                
                empty($review['mentorship_stars']) or                
                empty($review['tech_support_stars']) or                
                empty($review['description'])                 
            ) {
                return back()
                        ->with('error', 'Please fill out required fields');
            }

            $has_already_review = DB::table('coaching_reviews')
                                    ->where('user_id', $review['user_id'])
                                    ->where('coaching_id', $review['coaching_id'])
                                    ->select('status')->first();

            if(!empty($has_already_review)) {
                if($has_already_review->status=='enable'){
                    return redirect()
                            ->back()
                            ->with('danger', 'Your review is approved! So you can not udpate this review');
                }

                $review['is_seen']=0;
                DB::table('coaching_reviews')
                    ->where('user_id', $review['user_id'])
                    ->where('coaching_id', $review['coaching_id'])
                    ->update($review);

            } else {
                DB::table('coaching_reviews')
                ->insert($review);
            }
            
            try {
  
                // send mail
                $email = DB::table('students')
                        ->where('students.id', $review['user_id'])
                        ->value('students.email');
                        
                $student_name = DB::table('students')
                        ->where('students.id', $review['user_id'])
                        ->value('students.name');
                        
                $coaching_name = DB::table('coaching')
                                ->where('coaching.id', $review['coaching_id'])
                                ->value('coaching.name');
                 
                $review = $review['description'];
                
                $subject = $student_name.', Thank you for reviewing '.$coaching_name;
        
                if( !empty($email) ) {
                        
                    $datamessage['email']=$email;
            		$datamessage['subject']=$subject;
            		
            	    \Mail::send('mails.coaching_review', compact('student_name', 'coaching_name', 'review'), function ($m) use ($datamessage){
            			$m->from('support@coachingselect.com', 'CoachingSelect');
            			$m->to($datamessage['email'])->subject($datamessage['subject']);
            		});
            		
                }
                                
            } catch(\Exception $e) {
                // ignore mail error
            }
        
            return redirect()
                        ->back()
                        ->with('success', 'Review posted successfully and sent for approval');

        }

        return redirect()
                    ->back();
                    
    }

    public function team($coaching_name_slug) {

        $coaching_name = str_replace('-', ' ', $coaching_name_slug);

        $coaching = DB::table('coaching')
                    ->where('name', $coaching_name)
                    ->where('status', 'enable')
                    ->first();

        if( !empty($coaching) ) {

            # increase a view
            $this->view($coaching->id);

            $header = new HeaderController();
            $footer = new FooterController();
            
            $coaching->coaching_name_slug = $coaching_name_slug;

            $coaching->faculty = DB::table('coaching_faculty')
                                    ->where('coaching_faculty.coaching_id', $coaching->id)
                                    ->where('coaching_faculty.status', 'enable')
                                    ->get();

            $coaching->is_this_my_favorite = false;

            if( session()->has('student') ) {
                
                $favorite = array();
                $favorite['user_id'] = session()->get('student')->id;
                $favorite['coaching_id'] = $coaching->id;

                # is in my favorite list
                $has_already_favorite = DB::table('student_favorite_coaching')
                                        ->where('user_id', $favorite['user_id'])
                                        ->where('coaching_id', $favorite['coaching_id'])
                                        ->exists();

                $coaching->is_this_my_favorite = $has_already_favorite;

                # my review on this coaching
                $my_review = DB::table('coaching_reviews')
                                ->where('user_id', $favorite['user_id'])
                                ->where('coaching_id', $favorite['coaching_id'])
                                ->first();

                $coaching->my_review = $my_review;
            }
            
            # coaching ratings

            # request callback
            $coaching->has_requested_for_callback = false;

            if( session()->has('student') ) {
                

                $request_callback = array();
                $request_callback['user_id'] = session()->get('student')->id;
                $request_callback['coaching_id'] = $coaching->id;

                # is in my request_callback list
                $has_requested_for_callback = DB::table('student_request_callback')
                                            ->where('user_id', $request_callback['user_id'])
                                            ->where('coaching_id', $request_callback['coaching_id'])
                                            ->exists();

                
                $coaching->has_requested_for_callback = $has_requested_for_callback;
            }

            $coaching->ratings = $this->ratings($coaching->id);


            if( !empty($coaching->city) )
                $metatitle= "$coaching->name, $coaching->city ".date('Y').": Team, Mentors, Reviews, Experience, Strength & Teaching methodology";
            else
                $metatitle= "$coaching->name, India ".date('Y').": Team, Mentors, Reviews, Experience, Strength & Teaching methodology";
            

            return view('website.team', compact('metatitle', 'header', 'footer', 'coaching'));

        } else {
            abort(404);
        }

    }

    public function gallery($coaching_name_slug) {

        $coaching_name = str_replace('-', ' ', $coaching_name_slug);

        $coaching = DB::table('coaching')
                    ->where('name', $coaching_name)
                    ->where('status', 'enable')
                    ->first();

        if( !empty($coaching) ) {

            # increase a view
            $this->view($coaching->id);

            $header = new HeaderController();
            $footer = new FooterController();
            
            $coaching->coaching_name_slug = $coaching_name_slug;

            $coaching->photos = DB::table('coaching_photos')
                                    ->where('coaching_photos.coaching_id', $coaching->id)
                                    ->where('coaching_photos.status', 'enable')
                                    ->get();
                                    
            $coaching->videos = DB::table('coaching_videos')
                                    ->where('coaching_videos.coaching_id', $coaching->id)
                                    ->where('coaching_videos.status', 'enable')
                                    ->get();

            $coaching->is_this_my_favorite = false;

            if( session()->has('student') ) {
                
                $favorite = array();
                $favorite['user_id'] = session()->get('student')->id;
                $favorite['coaching_id'] = $coaching->id;

                # is in my favorite list
                $has_already_favorite = DB::table('student_favorite_coaching')
                                        ->where('user_id', $favorite['user_id'])
                                        ->where('coaching_id', $favorite['coaching_id'])
                                        ->exists();

                $coaching->is_this_my_favorite = $has_already_favorite;

                # my review on this coaching
                $my_review = DB::table('coaching_reviews')
                                ->where('user_id', $favorite['user_id'])
                                ->where('coaching_id', $favorite['coaching_id'])
                                ->first();

                $coaching->my_review = $my_review;                
            }

            # coaching ratings

            # request callback
            $coaching->has_requested_for_callback = false;

            if( session()->has('student') ) {
                

                $request_callback = array();
                $request_callback['user_id'] = session()->get('student')->id;
                $request_callback['coaching_id'] = $coaching->id;

                # is in my request_callback list
                $has_requested_for_callback = DB::table('student_request_callback')
                                            ->where('user_id', $request_callback['user_id'])
                                            ->where('coaching_id', $request_callback['coaching_id'])
                                            ->exists();

                
                $coaching->has_requested_for_callback = $has_requested_for_callback;
            }

            $coaching->ratings = $this->ratings($coaching->id);


            if( !empty($coaching->city) )
                $metatitle= "$coaching->name, $coaching->city ".date('Y').": Videos,Photos, Ambience of coaching";
            else
                $metatitle= "$coaching->name, India ".date('Y').": Videos,Photos, Ambience of coaching";
            

            return view('website.gallery', compact('metatitle', 'header', 'footer', 'coaching'));

        } else {
            abort(404);
        }

    }

    public function courses($coaching_name_slug) {

        $coaching_name = str_replace('-', ' ', $coaching_name_slug);

        $coaching = DB::table('coaching')
                    ->where('name', $coaching_name)
                    ->where('status', 'enable')
                    ->first();

        if( !empty($coaching) ) {

            # increase a view
            $this->view($coaching->id);

            $header = new HeaderController();
            $footer = new FooterController();
            
            $coaching->coaching_name_slug = $coaching_name_slug;

            $coaching->courses = DB::table('coaching_courses_detail')
                                    ->join('coaching_courses', 'coaching_courses.id', 'coaching_courses_detail.coaching_courses_id')
                                    ->where('coaching_courses.coaching_id', $coaching->id)
                                    ->where('coaching_courses.status', 'enable')
                                    ->where('coaching_courses_detail.status', 'enable')
                                    ->select('coaching_courses_detail.*', 'coaching_courses.name as coaching_courses_name')
                                    ->get()
                                    ->groupBy(
                                        function($query) {
                                            return $query->coaching_courses_name;
                                        }
                                    );

            $coaching->facility = DB::table('coaching_facility')
                                    ->join('facility', 'facility.name', 'coaching_facility.name')
                                    ->where('coaching_facility.coaching_id', $coaching->id)
                                    ->where('coaching_facility.status', 'enable')
                                    ->get();

            $coaching->is_this_my_favorite = false;

            if( session()->has('student') ) {
                
                $favorite = array();
                $favorite['user_id'] = session()->get('student')->id;
                $favorite['coaching_id'] = $coaching->id;

                # is in my favorite list
                $has_already_favorite = DB::table('student_favorite_coaching')
                                        ->where('user_id', $favorite['user_id'])
                                        ->where('coaching_id', $favorite['coaching_id'])
                                        ->exists();

                $coaching->is_this_my_favorite = $has_already_favorite;

                # my review on this coaching
                $my_review = DB::table('coaching_reviews')
                                ->where('user_id', $favorite['user_id'])
                                ->where('coaching_id', $favorite['coaching_id'])
                                ->first();

                $coaching->my_review = $my_review;                
            }

            # coaching ratings

            # request callback
            $coaching->has_requested_for_callback = false;

            if( session()->has('student') ) {
                

                $request_callback = array();
                $request_callback['user_id'] = session()->get('student')->id;
                $request_callback['coaching_id'] = $coaching->id;

                # is in my request_callback list
                $has_requested_for_callback = DB::table('student_request_callback')
                                            ->where('user_id', $request_callback['user_id'])
                                            ->where('coaching_id', $request_callback['coaching_id'])
                                            ->exists();

                
                $coaching->has_requested_for_callback = $has_requested_for_callback;
            }

            
            if( !empty($coaching->city) )
                $metatitle= "$coaching->name, $coaching->city ".date('Y').": Fees, Courses details, Offers, Batch details";
            else
                $metatitle= "$coaching->name, India ".date('Y').": Fees, Courses details, Offers, Batch details";
            

            $coaching->ratings = $this->ratings($coaching->id);
            
            $getStates = DB::table('states')->where('country_id', 101)->get();
            
            return view('website.courses', compact('metatitle', 'header', 'footer', 'coaching', 'getStates'));

        } else {
            abort(404);
        }

    }

    public function results($coaching_name_slug) {

        $coaching_name = str_replace('-', ' ', $coaching_name_slug);

        $coaching = DB::table('coaching')
                    ->where('name', $coaching_name)
                    ->where('status', 'enable')
                    ->first();

        if( !empty($coaching) ) {

            # increase a view
            $this->view($coaching->id);

            $header = new HeaderController();
            $footer = new FooterController();
            
            $coaching->coaching_name_slug = $coaching_name_slug;
                   
            $coaching->results = DB::table('coaching_results')
                                    ->join('courses', 'courses.id', 'coaching_results.coaching_courses_id')
            
                                    ->where('coaching_results.coaching_id', $coaching->id)
                                    ->where('coaching_results.status', 'enable')
                                    ->select('coaching_results.*', 'courses.name as courses_name')
                                    ->get()
                                    ->groupBy(
                                        function($query) {
                                            return $query->courses_name;
                                        }
                                    );
            
            $coaching->testimonials = DB::table('coaching_testimonials')
                                    ->join('courses', 'courses.id', 'coaching_testimonials.coaching_courses_id')
                                    ->where('coaching_testimonials.coaching_id', $coaching->id)
                                    ->where('coaching_testimonials.status', 'enable')
                                    ->where('courses.status', 'enable')
                                    ->select('coaching_testimonials.*', 'courses.name as coaching_courses_name')
                                    ->get()
                                    ->groupBy(
                                        function($query) {
                                            return $query->coaching_courses_name;
                                        }
                                    );
            
            $coaching->is_this_my_favorite = false;

            if( session()->has('student') ) {
                
                $favorite = array();
                $favorite['user_id'] = session()->get('student')->id;
                $favorite['coaching_id'] = $coaching->id;

                # is in my favorite list
                $has_already_favorite = DB::table('student_favorite_coaching')
                                        ->where('user_id', $favorite['user_id'])
                                        ->where('coaching_id', $favorite['coaching_id'])
                                        ->exists();

                $coaching->is_this_my_favorite = $has_already_favorite;

                # my review on this coaching
                $my_review = DB::table('coaching_reviews')
                                ->where('user_id', $favorite['user_id'])
                                ->where('coaching_id', $favorite['coaching_id'])
                                ->first();

                $coaching->my_review = $my_review;                
            }

            # coaching ratings

            # request callback
            $coaching->has_requested_for_callback = false;

            if( session()->has('student') ) {
                

                $request_callback = array();
                $request_callback['user_id'] = session()->get('student')->id;
                $request_callback['coaching_id'] = $coaching->id;

                # is in my request_callback list
                $has_requested_for_callback = DB::table('student_request_callback')
                                            ->where('user_id', $request_callback['user_id'])
                                            ->where('coaching_id', $request_callback['coaching_id'])
                                            ->exists();

                
                $coaching->has_requested_for_callback = $has_requested_for_callback;
            }

            $coaching->ratings = $this->ratings($coaching->id);


            if( !empty($coaching->city) )
                $metatitle= "$coaching->name, $coaching->city ".date('Y').": Toppers, Testimonials, Ranks, categories";
            else
                $metatitle= "$coaching->name, India ".date('Y').": Toppers, Testimonials, Ranks, categories";
            
            
            return view('website.results', compact('metatitle', 'header', 'footer', 'coaching'));

        } else {
            abort(404);
        }

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
    
    public function reviews($coaching_name_slug, $review='') {

        $coaching_name = str_replace('-', ' ', $coaching_name_slug);

        $coaching = DB::table('coaching')
                    ->where('name', $coaching_name)
                    ->where('status', 'enable')
                    ->first();

        if( !empty($coaching) ) {

            # increase a view
            $this->view($coaching->id);
            
            $header = new HeaderController();
            $footer = new FooterController();
            
            $coaching->coaching_name_slug = $coaching_name_slug;
                               
            $coaching->is_this_my_favorite = false;

            if( session()->has('student') ) {
                
                $favorite = array();
                $favorite['user_id'] = session()->get('student')->id;
                $favorite['coaching_id'] = $coaching->id;

                # is in my favorite list
                $has_already_favorite = DB::table('student_favorite_coaching')
                                        ->where('user_id', $favorite['user_id'])
                                        ->where('coaching_id', $favorite['coaching_id'])
                                        ->exists();

                $coaching->is_this_my_favorite = $has_already_favorite;

                # my review on this coaching
                $my_review = DB::table('coaching_reviews')
                                ->where('user_id', $favorite['user_id'])
                                ->where('coaching_id', $favorite['coaching_id'])
                                ->first();

                $coaching->my_review = $my_review;   
                $coaching->all_my_reviews = $this->all_my_reviews($coaching->id,$favorite['user_id']);             
            }

            # coaching ratings

            # request callback
            $coaching->has_requested_for_callback = false;

            if( session()->has('student') ) {
                

                $request_callback = array();
                $request_callback['user_id'] = session()->get('student')->id;
                $request_callback['coaching_id'] = $coaching->id;

                # is in my request_callback list
                $has_requested_for_callback = DB::table('student_request_callback')
                                            ->where('user_id', $request_callback['user_id'])
                                            ->where('coaching_id', $request_callback['coaching_id'])
                                            ->exists();

                
                $coaching->has_requested_for_callback = $has_requested_for_callback;
            }

            $coaching->courses_for_reviews = DB::table('coaching_courses')
                                                ->where('coaching_id', $coaching->id)
                                                ->where('status', 'enable')
                                                ->get();

            $coaching->ratings = $this->ratings($coaching->id);

            $coaching->reviews = $this->all_reviews($coaching->id);
           
            
            if( !empty($coaching->city) )
                $metatitle= "$coaching->name, $coaching->city ".date('Y').": Reviews on Faculties, study material, doubt clearing, teaching & tech support";
            else
                $metatitle= "$coaching->name, India ".date('Y').": Reviews on Faculties, study material, doubt clearing, teaching & tech support";
            

            return view('website.reviews', compact('metatitle', 'header', 'footer', 'coaching','review'));

        } else {
            abort(404);
        }

    }

    public function all_reviews($coaching_id) {
        
        $all_reviews = DB::table('coaching_reviews')
                        ->join('students', 'students.id', 'coaching_reviews.user_id')
                        ->where('coaching_id', $coaching_id)
                        ->where('coaching_reviews.status', 'enable')
                        ->select('coaching_reviews.*', 'students.name as student_name', 'students.image')
                        ->orderBy('coaching_reviews.created_at', 'desc')
                        ->get();
    
        if( !empty($all_reviews) ) {

            foreach($all_reviews as $review) {
                
                $faculty_stars = $review->faculty_stars;
                $study_materials_stars = $review->study_materials_stars;
                $doubt_clearing_stars = $review->doubt_clearing_stars;
                $mentorship_stars = $review->mentorship_stars;
                $tech_support_stars = $review->tech_support_stars;
                               
                $total_stars = ($faculty_stars + $study_materials_stars + $doubt_clearing_stars + $mentorship_stars + $tech_support_stars);
                
                $total_ratings = $total_stars / 1;

                $total_ratings = ($total_ratings / 5); # as total ratings mediums are 5

                $total_ratings = is_float($total_ratings) ? 
                                    number_format($total_ratings, 1, '.', '') :
                                    $total_ratings;

                
                $review->date = date('d F Y', strtotime($review->created_at) );

                if(! @GetImageSize($review->image) ) {
                    $review->image = asset('public/user.png');
                }

                $review->total_ratings = $total_ratings;
            }

        }

        return $all_reviews;
    }
    public function all_my_reviews($coaching_id,$userid) {
        
        $all_reviews = DB::table('coaching_reviews')
                        ->join('students', 'students.id', 'coaching_reviews.user_id')
                        ->where('coaching_id', $coaching_id)
                        ->where('coaching_reviews.user_id', $userid)
                        ->select('coaching_reviews.*', 'students.name as student_name', 'students.image')
                        ->orderBy('coaching_reviews.created_at', 'desc')
                        ->get();
    
        if( !empty($all_reviews) ) {

            foreach($all_reviews as $review) {
                
                $faculty_stars = $review->faculty_stars;
                $study_materials_stars = $review->study_materials_stars;
                $doubt_clearing_stars = $review->doubt_clearing_stars;
                $mentorship_stars = $review->mentorship_stars;
                $tech_support_stars = $review->tech_support_stars;
                               
                $total_stars = ($faculty_stars + $study_materials_stars + $doubt_clearing_stars + $mentorship_stars + $tech_support_stars);
                
                $total_ratings = $total_stars / 1;

                $total_ratings = ($total_ratings / 5); # as total ratings mediums are 5

                $total_ratings = is_float($total_ratings) ? 
                                    number_format($total_ratings, 1, '.', '') :
                                    $total_ratings;

                
                $review->date = date('d F Y', strtotime($review->created_at) );

                if(! @GetImageSize($review->image) ) {
                    $review->image = asset('public/user.png');
                }

                $review->total_ratings = $total_ratings;
            }

        }

        return $all_reviews;
    }

    public function completed_reviews($coaching_id) {
        
        $all_reviews = DB::table('coaching_reviews')
                        ->join('students', 'students.id', 'coaching_reviews.user_id')
                        ->where('coaching_id', $coaching_id)
                        ->select('coaching_reviews.*', 'students.name as student_name', 'students.image')
                        ->orderBy('coaching_reviews.created_at', 'desc')
                        ->get();
    
        if( !empty($all_reviews) ) {

            foreach($all_reviews as $review) {
                
                $faculty_stars = $review->faculty_stars;
                $study_materials_stars = $review->study_materials_stars;
                $doubt_clearing_stars = $review->doubt_clearing_stars;
                $mentorship_stars = $review->mentorship_stars;
                $tech_support_stars = $review->tech_support_stars;
                               
                $total_stars = ($faculty_stars + $study_materials_stars + $doubt_clearing_stars + $mentorship_stars + $tech_support_stars);
                
                $total_ratings = $total_stars / 1;

                $total_ratings = ($total_ratings / 5); # as total ratings mediums are 5

                $total_ratings = is_float($total_ratings) ? 
                                    number_format($total_ratings, 1, '.', '') :
                                    $total_ratings;

                
                $review->date = date('d F Y', strtotime($review->created_at) );

                if(! @GetImageSize($review->image) ) {
                    $review->image = asset('public/user.png');
                }

                $review->total_ratings = $total_ratings;
            }

        }

        return $all_reviews;
    }

    public function delete_student_review() {

        if( session()->has('student') ) {
            
            $review = array();
            $review = request()->except('_token');
            $review['user_id'] = session()->get('student')->id;

            if( 
                empty($review['user_id']) or                
                empty($review['coaching_id'])               
            ) {
                return back()
                        ->with('error', 'Please fill out required fields');
            }

            DB::table('coaching_reviews')
                ->where('user_id', $review['user_id'])
                ->where('coaching_id', $review['coaching_id'])
                ->delete();

            return redirect()
                        ->back()
                        ->with('success', 'Review deleted successfully');
        }

        return redirect()
                    ->back();
    }

    public function request_callback($coaching_id='') {
        
        if( session()->has('student') and request()->isMethod('post') ) {
            
            $request_callback = array();
            $request_callback['user_id'] = session()->get('student')->id;
            $request_callback['coaching_id'] = $coaching_id;

            $has_already_request_callback = DB::table('student_request_callback')
                                            ->where('user_id', $request_callback['user_id'])
                                            ->where('coaching_id', $request_callback['coaching_id'])
                                            ->exists();

            if(! $has_already_request_callback) {
                DB::table('student_request_callback')
                ->insert($request_callback);
            }

            return redirect()
                        ->back()
                        ->with('success', 'Request submitted successfully');
        }

        return redirect()
                    ->back();
    }

    public function view($coaching_id) {

        $is_exists = DB::table('coaching')
                        ->where('id', $coaching_id)
                        ->where('status', 'enable')
                        ->exists();
            
        if($is_exists) {
            $user_id = session()->get('student')->id ?? '';

            if($user_id) {
                    
                $my_views = DB::table('coaching_views')
                                ->where('coaching_id', $coaching_id)
                                ->where('user_id', $user_id)
                                ->first();

                $view = array();
                $view['coaching_id'] = $coaching_id;
                $view['user_id'] = $user_id;
                $view['view'] = 1;       
                
                $is_viewed = false;

                if( !empty($my_views) ) {

                    DB::table('coaching_views')
                        ->where('coaching_id', $coaching_id)
                        ->where('user_id', $user_id)
                        ->increment('view', 1);

                    $is_viewed = true;

                } else {
                    DB::table('coaching_views')
                    ->insert($view);
                
                    $is_viewed = true;
                }


                if($is_viewed) {
                    DB::table('coaching')
                        ->where('id', $coaching_id)
                        ->increment('views', 1);
                }

                $total_views = DB::table('coaching')
                                ->where('id', $coaching_id)
                                ->value('views');
                
                return [
                    'total_views' => $total_views
                ];
            }

            return 0;
        }

        return 0;
    }

    // purchase lead

    public function request_callback_purchase() {
        
        if( session()->has('student') ) {
            $request_callback = array();
            $request_callback['user_id'] = session()->get('student')->id;
            
            if( request()->has('coaching_id') ) {
                    
                $getOrderdata= session()->get('order');
                $request_callback['coaching_id'] = request()->get('coaching_id');
                    
                $request_callback['coaching_courses_detail_id'] = request()->get('coaching_courses_detail_id');
            } else {
                
                $getOrderdata= session()->get('order_counselling');
                
                $request_callback['counselling_id'] = request()->get('counselling_id');
                
                $request_callback['type'] = request()->get('type');
            }
            
            $request_callback['mobile'] = $getOrderdata['mobile'];
            $request_callback['name'] = $getOrderdata['name'];
            $request_callback['parent_name'] = $getOrderdata['parent_name'];
            $request_callback['email'] = $getOrderdata['email'];
            
            $request_callback['is_purchase_lead'] = 1;
            
            DB::table('student_request_callback')
                ->insert($request_callback);
            
            return 1;
        }

        return redirect()
                    ->back();
    }

}