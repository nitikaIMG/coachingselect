<?php 
namespace App\Http\Controllers;


use Page;
use Sitemap;
use DB;

class SitemapsController extends Controller
{
    public function posts()
    {
        Sitemap::addTag(asset('aboutus/'));
        Sitemap::addTag(asset('careers/'));
        Sitemap::addTag(asset('contactus/'));
        Sitemap::addTag(asset('disclaimer/'));
        Sitemap::addTag(asset('faq/'));
        Sitemap::addTag(asset('terms-condition/'));
        Sitemap::addTag(asset('privacypolicy/'));
        Sitemap::addTag(asset('cookies/'));
        Sitemap::addTag(asset('thankyou/'));
        Sitemap::addTag(asset('requestcallback/'));

        // main page
        Sitemap::addTag(asset('/'));
        Sitemap::addTag(asset('blogs/'));

        // blogs
        $posts = DB::table('blogs')
                    ->where('status', 'enable')
                    ->get();

        foreach ($posts as $post) {
            $slug = str_replace(' ', '-', $post->title);
            Sitemap::addTag(asset('blog/'.$slug), $post->updated_at, 'daily', '0.6');
        }

        // qna
        Sitemap::addTag(asset('qna/'));

        $posts = DB::table('student_questions')
                    ->where('status', 'enable')
                    ->get();

        foreach ($posts as $post) {
            $slug = base64_encode($post->id);
            Sitemap::addTag(asset('qna/'.$slug), $post->updated_at, 'daily', '0.6');
        }

        // /student/profile
        Sitemap::addTag(asset('student/profile/'));

        // /study-material
        Sitemap::addTag(asset('study-material/'));

        $posts = DB::table('streams')
                    ->where('status', 'enable')
                    ->get();

        foreach ($posts as $post) {
            $slug = str_replace(' ', '-', $post->name);
            Sitemap::addTag(asset('study-material/'.$slug), $post->updated_at, 'daily', '0.6');
        }

        // coaching
        $posts = DB::table('coaching')
                    ->where('status', 'enable')
                    ->get();

        foreach ($posts as $post) {
            $slug = str_replace(' ', '-', $post->name);
            Sitemap::addTag(asset('coaching/'.$slug), $post->updated_at, 'daily', '0.6');
        }
        
        // /exams
        Sitemap::addTag(asset('exams/'));
        
        $posts = DB::table('streams')
                    ->where('status', 'enable')
                    ->get();

        foreach ($posts as $post) {
            $slug = str_replace(' ', '-', $post->name);
            Sitemap::addTag(asset('exams/'.$slug), $post->updated_at, 'daily', '0.6');
        }

        $posts = DB::table('exams')
                    ->where('status', 'enable')
                    ->get();

        foreach ($posts as $post) {
            $slug = str_replace(' ', '-', $post->title);
            Sitemap::addTag(asset('exam/'.$slug), $post->updated_at, 'daily', '0.6');
        }

        // /coaching-search
        Sitemap::addTag(asset('coaching-search/'));
        
        // /compare
        Sitemap::addTag(asset('compare/'));
        
        // /colleges
        Sitemap::addTag(asset('colleges/'));
        
        $posts = DB::table('college')
                    ->where('status', '1')
                    ->get();

        foreach ($posts as $post) {
            $slug = str_replace(' ', '-', $post->college_name);
            Sitemap::addTag(asset('college/'.$slug), $post->updated_at, 'daily', '0.6');
        }

        // /enterprise
        Sitemap::addTag(asset('enterprise/'));
        Sitemap::addTag(asset('enterprise/searchlead/'));
        Sitemap::addTag(asset('enterprise/pagelead/'));
        Sitemap::addTag(asset('enterprise/purchaselead/'));

        // /counselling
        Sitemap::addTag(asset('counselling/'));

        // news
        $posts = DB::table('trending_today')
                    ->where('status', 'enable')
                    ->get();

        foreach ($posts as $post) {
            $slug = str_replace(' ', '-', $post->title);
            Sitemap::addTag(asset('news/'.$slug), $post->updated_at, 'daily', '0.6');
        }

        // news direct
        $posts = DB::table('trending_today_direct')
                    ->where('status', 'enable')
                    ->get();

        foreach ($posts as $post) {
            $slug = str_replace(' ', '-', $post->title);
            Sitemap::addTag(asset('/'.$slug), $post->updated_at, 'daily', '0.6');
        }

        return Sitemap::render();
    }
}