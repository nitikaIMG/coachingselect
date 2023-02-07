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

class TrendingTodayController extends Controller
{

    public function news($news_name_slug) {

        $news_name = str_replace('-', ' ', $news_name_slug);
        $metatitle= $news_name;
        $news = DB::table('trending_today')
                    ->where('title', $news_name)
                    ->first();

        $metatitle = '';
        $metadescription = '';
        $metakeywords = '';
        
        if( !empty($news) ) {            

            $header = new HeaderController();
            $footer = new FooterController();

            $metatitle = $news->metatitle ?? $news->title;
            $metadescription = $news->metadescription ?? '';
            $metakeywords = $news->metakeywords ?? '';
            
            return view('website.news', 
                        compact(
                            'metatitle',
                            'metadescription',
                            'metakeywords',
                            'header',
                            'footer', 
                            'news'
                        )
            );

        } else {
            abort(404);
        }

    }

    public function all_news() {

        $metatitle= 'News and Articles';
        $news = DB::table('trending_today')
                    ->where('status', 'enable')
                    ->orderBy('created_at', 'DESC')
                    ->get();

        if( !empty($news) ) {            

            $header = new HeaderController();
            $footer = new FooterController();

            return view('website.all_news', 
                        compact('metatitle',
                            'header',
                            'footer'
                            , 
                            'news'
                        )
            );

        } else {
            abort(404);
        }

    }

}