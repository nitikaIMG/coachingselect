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

class ExamsController extends Controller
{
    
    public function exams() {

        $header = new HeaderController();
        $footer = new FooterController();

        $exams = DB::table('exams')
                    ->join('streams', 'streams.id', 'exams.stream_id')
                    ->join('courses', 'courses.id', 'exams.course_id')
                    ->where('exams.status', 'enable')
                    ->where('courses.status', 'enable')
                    ->where('streams.status', 'enable')
                    ->select(
                        'streams.name as stream_name',
                        'streams.image as stream_image',
                        'exams.title as exam_name'
                    )
                    ->get()
                    ->groupBy(
                        function($query) {
                            return $query->stream_name;
                        }
                    );

        $metatitle= "Top Exams In India ".date('Y').": Result Date, Details, Eligibility, Marks & Cut-Offs, Syllabus, Reservation, Centers, Mocks, FAQs";

        $metadescription= 'Coachingselect - Get the list of all entrance exams in India for X, XII,  UG & PG courses being conducted by various affiliated bodies in every domain including Engineering, Medical, Management, Law, Pharmacy, Computer Applications, Hotel management, Design and others';

        $metakeywords="coachingselect, education, colleges,universities, institutes,career, career options, career prospects,engineering, mba, medical, mbbs,study abroad, foreign education, college, university, institute,courses, coaching, technical education, higher education,forum, community, education career experts,ask experts, admissions,results, events,scholarships";

        return view('website.exams', compact('metatitle', 'header', 'footer', 'exams'
        ,'metadescription','metakeywords'
        ));
    }
    
    public function stream_wise_exams($stream) {
        
        $currentdate = date('Y-m-d H:i:s');

        
        $header = new HeaderController();
        
        $footer = new FooterController();
        
        $stream = str_replace('-', ' ', $stream);

        $exams = DB::table('exams')
                    ->join('streams', 'streams.id', 'exams.stream_id')
                    ->join('courses', 'courses.id', 'exams.course_id')
                    ->where('exams.status', 'enable')
                    ->where('streams.status', 'enable')
                    ->where('courses.status', 'enable')
                    ->select(
                        'streams.name as stream_name',
                        'streams.image as stream_image',
                        'exams.title as exam_name',
                        'exams.image',
                        'exams.short_description'
                    )
                    ->where('streams.name', $stream)
                    ->get();
                    
        if( empty($exams->toArray()) ) {
            abort(404);
        }
        
        $blogs = $this->blogs();

        $metatitle = "Top ". $stream;
   
        $metatitle .= " Entrance Exams in India ".date('Y')." - Coachingselect";
        
        $metadescription= "Coachingselect - Check the list of top 10 $stream entrance exams you must appear for in ".date('Y').". The list includes various National/State/University level $stream entrance exams in India.";

        $metakeywords="coachingselect, List of $stream  Exams, Top 10 $stream Entrance Exams, $stream Entrance Exams  for ".date('Y')."";
        

        return view('website.stream_wise_exams', compact('metatitle','header', 'footer', 'exams', 'blogs','metadescription','metakeywords'
        ));
    }

    
    public function blogs() {
        return DB::table('blogs')
                ->where('blogs.status', 'enable')
                ->take(3)
                ->orderBy('blogs.created_at', 'desc')
                ->join('blogs_category', 'blogs_category.id', 'blogs.blog_category_id')
                ->where('blogs.status', 'enable')
                ->where('blogs_category.status', 'enable')
                ->get();                
    }

    public function exam($title) {
        $header = new HeaderController();
        $footer = new FooterController();
        
        $title = str_replace('-', ' ', $title);

        $exam = DB::table('exams')
                    ->join('streams', 'streams.id', 'exams.stream_id')
                    ->join('courses', 'courses.id', 'exams.course_id')
                    ->where('exams.status', 'enable')
                    ->where('streams.status', 'enable')
                    ->where('courses.status', 'enable')
                    ->where('exams.title', $title)
                    ->select('exams.*')
                    ->first();

        if(! $exam) {
            abort(404);
        }

        $metatitle= "$exam->title Exam: Answer Key and Question Paper (Out), Admit Card, Syllabus";

        $metadescription= "Coachingselect - $exam->title exam information, $exam->title form filling , Check $exam->title exam dates, question papers, answer key, result, syllabus, pattern, registration, eligibility, and cutoff here";

        $metakeywords="coachingselect, $exam->title, $exam->title exam, $exam->title ".date('Y').", $exam->title exam ".date('Y').", $exam->title ".date('Y')." result,  $exam->title ".date('Y')." dates ,  $exam->title ".date('Y')." colleges ,  $exam->title ".date('Y')." jobs,  $exam->title ".date('Y')." form filling process";

        return view('website.exam', compact('metatitle','header', 'footer', 'exam'
        ,'metadescription','metakeywords'
        ));
    }

    public function clickcounter(Request $request){

       $clicks = $request->clicks;

       $id = $request->id;

       $data = DB::table('advertisement')->where('id',$id)->first();

       $totalcount = $data->clicks+ $clicks;

       DB::table('advertisement')->where('id',$id)->update(['clicks'=>$totalcount]);

       return true;

   }

}

