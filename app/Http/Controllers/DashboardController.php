<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helpers\Helpers;
use App\User;
use Hash;
use Mpdf;
class DashboardController extends Controller
{

    public function home() {

        $total_streams = DB::table('streams')->count();
        $total_courses = DB::table('courses')->count();
        $total_facility = DB::table('facility')->count();
        $total_blogs = DB::table('blogs')->count();
        $total_exams = DB::table('exams')->count();
        $total_testimonials = DB::table('testimonials')->count();
        $total_question_paper_subjects = DB::table('question_paper_subjects')->count();
        $total_question_answer = DB::table('question_answer')->count();
        $total_coaching = DB::table('coaching')->whereIn('status', ['enable', 'disable'])->count();
        $total_college = DB::table('college')->count();
        $total_advertisement = DB::table('advertisement')->count();
        $total_counselling = DB::table('counselling')->count();
        $total_counselling_testimonials = DB::table('counselling_testimonials')->count();
        $total_counselling_faq = DB::table('counselling_faq')->count();
        
        $total_enterprise = DB::table('enterprise')->count();
        $request_callback = DB::table('request_callback')->count();
        $student_request_callback = DB::table('student_request_callback')->count();
        $contactus = DB::table('contactus')->count();
        $ttl_generals= $request_callback+$contactus+$student_request_callback;
        $total_plan = DB::table('plan')->count();
        $total_students = DB::table('students')->count();
        
        $q1 = DB::table('student_questions');
        $q2 = DB::table('student_answers')
              ->join('student_questions', 'student_questions.id', 'student_answers.student_question_id')
              ->select('student_answers.*');

        $total_qna = $q1->union($q2)->count();

        return view('home', compact('total_streams', 'total_courses', 'total_facility', 'total_blogs', 'total_exams', 'total_testimonials', 'total_question_paper_subjects', 'total_question_answer', 'total_coaching', 'total_college',
        'total_advertisement', 'total_counselling', 'total_counselling_testimonials', 'total_counselling_faq', 'total_enterprise', 'total_plan','total_students','ttl_generals', 'total_qna'));
    }
    public function website_mail2(){
        $mpdf = new \Mpdf\Mpdf();
        $content= view('mails/website_mail2');
        $mpdf->WriteHTML($content);
        $mpdf->Output('MyBat11.pdf','D');
    }
    public function website_mail3(){
        return view('mails/website_mail2');
    }
}