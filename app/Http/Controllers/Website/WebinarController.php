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

class WebinarController extends Controller
{

    public function webinar($webinar_name_slug) {

        $webinar_name = str_replace('-', ' ', $webinar_name_slug);
        $metatitle= $webinar_name;
        $webinar = DB::table('webinar')
                    ->where('title', $webinar_name)
                    ->first();

        $metatitle = '';
        $metadescription = '';
        $metakeywords = '';
        
        if( !empty($webinar) ) {            

            $header = new HeaderController();
            $footer = new FooterController();

            $metatitle = $webinar->metatitle ?? $webinar->title;
            $metadescription = $webinar->metadescription ?? '';
            $metakeywords = $webinar->metakeywords ?? '';
            
            return view('website.webinar', 
                        compact(
                            'metatitle',
                            'metadescription',
                            'metakeywords',
                            'header',
                            'footer', 
                            'webinar'
                        )
            );

        } else {
            abort(404);
        }

    }

    public function all_webinar() {

        $metatitle = 'Free LIVE Webinars on JEE, NEET, CAT, UPSC etc. by the experts for Class V-XII, College students and more.';
        $metadescription = 'A single place where you can choose webinars of your interest from the wide range of LIVE Sessions going on with the help of CoachingSelect.';
        $metakeywords = 'live webinar, live Sessions, live webinar broadcast, free live webinar, join live webinar, webinar for JEE, NEET, School, Boards, Class V, VI , VII, VIII, IX, X, XI, XII, CAT, CLAT,  UPSC, IAS, CLAT, MBA, Executive Courses, College Students, Free study , free Classes, Free learning.';

        $webinar = DB::table('webinar')
                    ->where('status', 'enable')
                    ->whereDate('date', '>=', date('Y/m/d'))
                    // ->orderBy('date', 'ASC')
                    ->get()
                    ->sortBy('date')
                    ->groupBy('date')
                    ->slice(0, 7);

        // dd($webinar);

        if( !empty($webinar) ) {            

            $header = new HeaderController();
            $footer = new FooterController();

            return view('website.all_webinar', 
                        compact(
                            'metatitle',
                            'metadescription',
                            'metakeywords',
                            'header',
                            'footer'
                            , 
                            'webinar'
                        )
            );

        } else {
            abort(404);
        }

    }

}